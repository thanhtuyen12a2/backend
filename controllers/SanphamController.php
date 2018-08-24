<?php
namespace backend\controllers;

use backend\models\Sanpham;

use Aabc;
use aabc\web\Controller;
use aabc\web\NotFoundHttpException;
use aabc\filters\VerbFilter;


use aabc\db\Transaction;
use aabc\base\Exception;
use aabc\base\ErrorException;
use aabc\base\ErrorHandler;

use aabc\web\ForbiddenHttpException;
use aabc\filters\AccessControl;

use backend\models\Ngonngu;
use backend\models\Sanphamngonngu;
use backend\models\Danhmuc;

use backend\models\SanphamDanhmuc;

use backend\models\SanphamngonnguSearch;
use aabc\widgets\ActiveForm;
use aabc\widgets\FragmentCache;

use aabc\data\ActiveDataProvider;


class SanphamController extends Controller
{
    
    public function behaviors()
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        // ob_start('ob_gzhandler');   
        return [

            // [
            //     'class' => 'aabc\filters\PageCache',
            //     'only' => ['i'],
            //     'duration' => 0,
            //     'variations' => [
            //         \Aabc::$app->language,
            //     ],
            // ],

            // 'access' => [
            //     'class' => AccessControl::className(),
            //     //'only' => ['create'],
            //     'rules' => [
            //         [
            //             'allow' => true,
            //             //'actions' => ['index','create'],
            //             'roles' => ['@'],
            //             'matchCallback' => function ($rule, $action){
            //                 $control = Aabc::$app->controller->id;
            //                 $action = Aabc::$app->controller->action->id;
            //                 $role = 'backend-'.$control . '-' . $action;
            //                 if(Aabc::$app->user->can($role)){
            //                     return true;
            //                 }
            //             }
            //         ],
            //     ],
            // ],


            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'rec' => ['POST'],                    
                    'reca' => ['POST'],
                    'res' => ['POST'],
                    'd' => ['POST'],
                    'da' => ['POST'],
                    'c' => ['GET','POST'],
                    'u' => ['GET','POST'],
                    'ut' => ['GET','POST'],
                    'i' => ['POST'],
                    'ir' => ['POST'],
                    'search' => ['POST'], //search
                    'addspdm' => ['POST'], 
                ],
            ],
        ];
    }


    public function actionThaydoichuyenmuc()
    {
        $_Danhmuc = Aabc::$app->_model->Danhmuc;
        return self::thaydoi_danhmuc($_Danhmuc::BAIVIET);
    }

    public function actionThaydoidanhmuc()
    {
        $_Danhmuc = Aabc::$app->_model->Danhmuc;
        return self::thaydoi_danhmuc($_Danhmuc::SANPHAM);
    }


    protected function thaydoi_danhmuc($type)
    {
        $_Danhmuc = Aabc::$app->_model->Danhmuc;
        $session = Aabc::$app->session;
        if(!$session['selects']) $session['selects'] = Aabc::$app->request->post('selects');        
        $Sanpham = Sanpham::M;
        $model = new $Sanpham(); 
        if ($model->load(Aabc::$app->request->post()) ) {
            $datajson = 0;
            if($session['selects']){                
                $transaction = \Aabc::$app->db->beginTransaction(); 
                try { 
                    foreach ($session['selects'] as $id_sp) {
                        self::save_sanpham_danhmuc($type,  $id_sp, $model[Sanpham::sp_id_danhmuc], $transaction );
                    }
                    $transaction->commit();
                    $datajson = 1;
                    
                } catch (Exception $e) {  
                    Aabc::error($model->errors);
                    $transaction->rollback();
                    $datajson = 0;
                }
                $session['selects'] = null;                
            }
            return $datajson;
        }else{            
            if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                $data = Aabc::$app->request->post('selects');

                $view_ajax = [
                    $_Danhmuc::SANPHAM => '_thaydoi_danhmuc',
                    $_Danhmuc::BAIVIET => '_thaydoi_chuyenmuc',
                ];

                $kq = $this->renderAjax($view_ajax[$type], [
                    'model' => $model,
                ]);
                $kq = Aabc::$app->d->decodeview($kq);
                return $kq;
            }
        }
    }


    public function actionAddphienban(){
        if(isset($_GET['option'])){
            return $this->renderAjax('add-phienban-option');
        }else{
            return $this->renderAjax('add-phienban');
        }        
    }


    public function actionAddalbum(){
        return $this->renderAjax('add-album');
    }

    public function actionSearch($dm = '',$t = 1) //dm: danh mục
    {
        Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON; 
        $return = ['results' => ['id' => '', 'text' => '']];        
        $q = (Aabc::$app->request->post('q') !== NULL)?Aabc::$app->request->post('q'):''; 
        
        $search = [
            '1' => Sanpham::getOptionsFind($q, $dm, Sanpham::SANPHAM),
            '2' => Sanpham::getOptionsFind($q, $dm, Sanpham::BAIVIET),
            

            '3' => Danhmuc::getOptionsFind($q, Danhmuc::SANPHAM),
            '4' => Sanpham::getOptionsFind($q, $dm, Sanpham::SANPHAM),
            '5' => Danhmuc::getOptionsFind($q, Danhmuc::BAIVIET),
            '6' => Sanpham::getOptionsFind($q, $dm, Sanpham::BAIVIET),            
            '8' => Danhmuc::getOptionsFind($q, Danhmuc::TINHNANG), //Thông số
        ];
        $return['results'] = $search[$t];        

        return $return;
    }


    public function actionAddspdm() //add sản phẩm vào danh mục nổi bật
    {   
        Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON; 
        
        if(!empty(Aabc::$app->request->post('sp')) && !empty(Aabc::$app->request->post('dm'))){   
            $san_pham = Aabc::$app->request->post('sp');
            $danh_muc = Aabc::$app->request->post('dm');
            $danh_muc = \backend\models\Danhmuc::find()->where(['dm_id' => $danh_muc])->one();
            

            $_Sanphamdanhmuc = Aabc::$app->_model->Sanphamdanhmuc;
                        
            $spdm = $_Sanphamdanhmuc::find()
                                        ->andWhere(['spdm_id_sp' => $san_pham])
                                        ->andWhere(['spdm_id_danhmuc' => $danh_muc->dm_id])
                                        ->one();
            if(!$spdm){
                $spdm = new $_Sanphamdanhmuc();
                $spdm->spdm_id_sp = $san_pham;
                $spdm->spdm_id_danhmuc = $danh_muc->dm_id;
                $spdm->spdm_type = $danh_muc->dm_type;                
                if(!$spdm->save()) Aabc::error($spdm->errors);
            }

            $kq = $this->renderAjax('addspdm', [                
                'iddanhmuc' => $danh_muc->dm_id,
            ]);
            // $kq = Aabc::$app->d->decodeview($kq);
            return $kq;

        }
        return '';
    }

     public function actionRemovespdmnb() //remove sản phẩm vào danh mục nổi bật
    {   
        Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON; 
        
        if(!empty(Aabc::$app->request->post('sp')) && !empty(Aabc::$app->request->post('dm'))){   
            $san_pham = Aabc::$app->request->post('sp');
            $danh_muc = Aabc::$app->request->post('dm');
            $danh_muc = \backend\models\Danhmuc::find()->where(['dm_id' => $danh_muc])->one();
            
            $_Sanphamdanhmuc = Aabc::$app->_model->Sanphamdanhmuc;            
            
            $_Sanphamdanhmuc::xoatatca(['spdm_id_sp' => $san_pham, 'spdm_id_danhmuc' => $danh_muc->dm_id]);
           
            $kq = $this->renderAjax('addspdm', [                
                'iddanhmuc' => $danh_muc->dm_id,
            ]);
            // $kq = Aabc::$app->d->decodeview($kq);
            return $kq;

        }
        return '';
    }


    public function actionFristspdmnb() //sản phẩm lên vị trí frist
    {   
        Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON; 
        
        if(!empty(Aabc::$app->request->post('sp')) && !empty(Aabc::$app->request->post('dm'))){   
            $san_pham = Aabc::$app->request->post('sp');
            $danh_muc = Aabc::$app->request->post('dm');
            $danh_muc = \backend\models\Danhmuc::find()->where(['dm_id' => $danh_muc])->one();
            

            $_Sanphamdanhmuc = Aabc::$app->_model->Sanphamdanhmuc;
                        
            $spdm = $_Sanphamdanhmuc::find()
                                        ->andWhere(['spdm_id_sp' => $san_pham])
                                        ->andWhere(['spdm_id_danhmuc' => $danh_muc->dm_id])
                                        ->one();
            if($spdm){          
                $spdm->spdm_sothutu = (string)time();                      
                if(!$spdm->save()) Aabc::error($spdm->errors);
            }

            $kq = $this->renderAjax('addspdm', [                
                'iddanhmuc' => $danh_muc->dm_id,
            ]);
            // $kq = Aabc::$app->d->decodeview($kq);
            return $kq;

        }
        return '';
    }


    public function actionI_b($t = 10,$tp = 2, $k = '')
    {       

        return  $this->index($t,$tp);
    }


    public function actionI($t = 10,$tp = 1, $k = '')
    {           
        // return Aabc::$app->runAction('sanpham/i_b');
        // return Aabc::$app->response->redirect(['sanpham/i_b', 'tempData' => $tempData]);        
        return $this->index($t,$tp,$k);
    }

    protected function index($t = 10,$tp = 1,$k = '')
    {        
        if(empty($t)) $t = 20;
        // echo 'k: '.$_GET['k'].'<br/>';
        // echo 't: '.$_GET['t'].'<br/>';
        // die;

        // $cache = Aabc::$app->dulieu;

        // for ($i=0; $i < 2; $i++) { 
        //     $data = $cache->get('cache_'.$i);
        //     if ($data === false){
        //         $data = '1-'.$i;
        //         $cache->set('cache_'.$i, $data);
        //     }            
        // }        

        $t = addslashes($t);
        $tp = addslashes($tp);
        // $role = 'backend-sanpham-index';
        // if(!Aabc::$app->user->can($role)){             
        //     return 'nacc';die;
        // }

        //$searchModel = new Dskh2Search(
        //    ['tencongty' => 'thanh']
        //);        

        // echo '<pre>';
        // print_r(Aabc::$app->request->get(Sanpham::sp_conhang));
        // die;

        $Sanpham = Sanpham::S;
        $searchModel = new $Sanpham(
            [
                'sp_conhang' => Aabc::$app->request->get(Sanpham::sp_conhang),
                // Sanpham::sp_id_thuonghieu => Aabc::$app->request->get(Sanpham::sp_id_thuonghieu),  
                'sp_status' => Aabc::$app->request->get(Sanpham::sp_status),
                'sp_recycle' => '2',
                'sp_type' => $tp,
            ]
        );

        // $searchModel->(Sanpham::sp_status) = Aabc::$app->request->get('status');

        $dataProvider = $searchModel->search(Aabc::$app->request->queryParams);
        //$dataProvider->setSort([
        //    'defaultOrder' => ['id'=>SORT_DESC]        
        //]);

         

        // $query = (Sanpham::M)::find()
        //             // ->andWhere(['sp_conhang' => Aabc::$app->request->get(Sanpham::sp_conhang)])
        //             ->andWhere(['sp_type' => $tp])
        //             // ->andWhere(['sp_status' => Aabc::$app->request->get(Sanpham::sp_status)])
        //             ->andWhere(['sp_recycle' => '2']);

        // $dataProvider = new ActiveDataProvider([
        //         'query' => $query,
        //     ]);


        $dataProvider->pagination->pageSize=$t;
      

        
        Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;  


        // $Sanpham = Aabc::$app->_model->Sanpham;
        // $query = $Sanpham::find()->where([Sanpham::sp_recycle => '2']);
        // $dataProvider = new \aabc\data\ActiveDataProvider([
        //     'query' => $query,
        //     'pagination' => [
        //         'pageSize' => 10,
        //     ],           
        // ]);




        // $control = Aabc::$app->controller->id;
        // $action = Aabc::$app->controller->action->id;
        // $role = 'backend-'.$control . '-' . $action;
        // if(Aabc::$app->user->can($role)){           
             $kq = $this->renderAjax('index'.$tp, [
                'k' => $k,
                // 'searchModel' => $searchModel,
                't' => $t,
                'dataProvider' => $dataProvider,            
            ]);

             $kq = Aabc::$app->d->decodeview($kq);
         return $kq;

        // }else{
        //     // Aabc::$app->response->statusCode = 200;            
        //     return 'nacc';
        // }

    }



    public function actionIr_b()
    {        
        return $this->indexrecycle($tp = 2);
    }
    public function actionIr(){
        return $this->indexrecycle($tp = 1);
    }
    protected function indexrecycle($tp)
    {
        $tp = addslashes($tp);
        // $role = 'backend-sanpham-indexrecycle';
        // if(!Aabc::$app->user->can($role)){             
        //     return 'nacc';die;
        // }

        $_SanphamSearch = Sanpham::S;
        $searchModel = new $_SanphamSearch([
            'sp_recycle' => '1',
            'sp_type' => $tp,
        ]);        
        $dataProvider = $searchModel->search(Aabc::$app->request->queryParams);       

        $dataProvider->pagination->pageSize = 9999 ; 
        $kq = '';
        $kq = $this->renderAjax('indexrecycle'.$tp, [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
         $kq = Aabc::$app->d->decodeview($kq);
         return $kq;
    }



    //  public function actionTab()
    // {
    //     return $this->render('tab');
    // }



    
    // public function actionView($id)
    // {
    //     return $this->render('view', [
    //         'model' => $this->findModel($id),
    //     ]);
    // }
    public function actionC_b()
    {        
        return $this->create($tp = 2);
    }     
    public function actionC(){
        return $this->create($tp = 1);
    }
    protected function create($tp)
    {
        Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;
        $tp = addslashes($tp);
        // $role = 'backend-sanpham-create';
        // if(!Aabc::$app->user->can($role)){             
        //     return 'nacc';die;
        // }
        $Sanpham = Sanpham::M;

            // $model = new $Sanpham();          
            // if(Aabc::$app->request->post('check') !== NULL){                
            //     Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;  
            //     // return SanphamController::checkmasp();
            //     return $this->checkmasp();
            //     die;
            // }
        // if(Aabc::$app->request->isAjax && $model->load(Aabc::$app->request->post())){
        //     Aabc::$app->response->format = 'json';            
        //     return ActiveForm::validate($model); 
        // }

        $model = new $Sanpham(); 

        if ($model->load(Aabc::$app->request->post())) { 
            //Xử lý ajax check MaSP
            if(Aabc::$app->request->post('ajax')) return ActiveForm::validate($model);
            
            $model[Sanpham::sp_id_danhmuc] = null;

            
           

            //Thông số
            $tss = Aabc::$app->request->post('Ts');


            $postimg = Aabc::$app->request->post(Aabc::$app->d->postimg);
            if($postimg != ''){
                $postimg = implode("-",$postimg);            
            }
            $model[Sanpham::sp_images] = $postimg;


            //Mang Danh muc
            $arr_sp_id_danhmuc = NULL;
            if($tp == 2){
                if( is_array($model[Sanpham::sp_id_danhmuc])){                
                    $arr_sp_id_danhmuc = array_unique($model[Sanpham::sp_id_danhmuc]); 
                } 
            }

            if($tp == 1){
                $arr_sp_id_danhmuc[] = $model[Sanpham::sp_id_danhmuc];
            }
            

            $model[Sanpham::sp_type] = $tp;

            //Tim sp_ma max tuong ung type hien tai
            $ma_max = $Sanpham::find()
                            ->andWhere(['sp_type' => $tp])
                            ->max('sp_ma');
            $model[Sanpham::sp_ma] = $ma_max + 1;
            $data = Aabc::$app->request->post(Sanphamngonngu::T);                
            $model[Sanpham::sp_tensp] = $data[0][Sanphamngonngu::spnn_ten];  
            $model[Sanpham::sp_motaseo] = $data[0][Sanphamngonngu::spnn_gioithieu];  

            // $model[Sanpham::sp_id] = null;
            $transaction = \Aabc::$app->db->beginTransaction(); 
            try { 
                // echo '<pre>';
                // print_r($model);die;
                if($model->save(false)){                     
                    $model[Sanpham::sp_id] =  $model->sp_id; 
                    $datajson = 1;   
                    $id = $model[Sanpham::sp_id];                    
                    
                    //Save thông số
                    $ts_exist = [];
                    $_Sanphamdanhmuc = Aabc::$app->_model->Sanphamdanhmuc;
                    if(is_array($tss)) foreach ($tss as $k_ts1 => $ts_group) {
                        
                        if(isset(($ts_group['i']))){
                        if(is_array($ts_group['i'])){
                        foreach ($ts_group['i'] as $k_ts2 => $ts) {                           
                            $new_sp_dm = $_Sanphamdanhmuc::find()
                                                ->andWhere(['spdm_id_sp' => $id])
                                                ->andWhere(['spdm_id_danhmuc' => $ts])
                                                // ->andWhere(['spdm_type' => 5])
                                                ->one();
                            $ts_exist[] = (int)$ts;
                            if(!$new_sp_dm){
                                $new_sp_dm = new $_Sanphamdanhmuc();
                                $new_sp_dm->spdm_id_sp = $id;
                                $new_sp_dm->spdm_id_danhmuc = $ts;                            
                            }
                            $new_sp_dm->spdm_info = addslashes($ts_group['l']);
                            $new_sp_dm->spdm_type = 5;
                            if(!$new_sp_dm->save()) Aabc::error($new_sp_dm->errors);
                            
                        }}}
                    }     
                    $_Sanphamdanhmuc::xoatatca(['and',
                        ['spdm_id_sp' => $id],
                        ['spdm_type' => 5],
                        ['NOT IN','spdm_id_danhmuc',$ts_exist],
                    ]);



                    //Save danh mục nổi bật
                    $noibat_exist = [];
                    $noibats = $model[Sanpham::sp_noibat];

                
                    if(is_array($noibats)) foreach ($noibats as $k_nb => $noibat) { 
                        $new_sp_dm = $_Sanphamdanhmuc::find()
                                            ->andWhere(['spdm_id_sp' => $id])
                                            ->andWhere(['spdm_id_danhmuc' => $noibat])
                                            // ->andWhere(['spdm_type' => 5])
                                            ->one();
                        $noibat_exist[] = (int)$noibat;
                        if(!$new_sp_dm){
                            $new_sp_dm = new $_Sanphamdanhmuc();
                            $new_sp_dm->spdm_id_sp = $id;
                            $new_sp_dm->spdm_id_danhmuc = $noibat;                            
                        }                    
                        $new_sp_dm->spdm_type = 4;
                        if(!$new_sp_dm->save()) Aabc::error($new_sp_dm->errors);
                    }     
                    $_Sanphamdanhmuc::xoatatca(['and',
                        ['spdm_id_sp' => $id],
                        ['spdm_type' => 4],
                        ['NOT IN','spdm_id_danhmuc',$noibat_exist],
                    ]);


                    
                    // $data = Aabc::$app->request->post(Sanphamngonngu::T);                 
                    if(!empty($data)){
                        foreach ($data as $key => $value) {                        
                            $modelspnn = (Sanphamngonngu::M)::find()
                                        ->andWhere(['spnn_idsanpham' => $value[Sanphamngonngu::spnn_idsanpham]])
                                        ->andWhere(['spnn_idngonngu' => $value[Sanphamngonngu::spnn_idngonngu]])
                                        ->one();
                            //Xu ly link anh trong bai truoc khi luu
                            // $value[Sanphamngonngu::spnn_noidung] = $this->encodelinkanh($value[Sanphamngonngu::spnn_noidung]);

                            if($modelspnn == NULL){                            
                            //Chưa có, nên tạo mới
                                $Sanphamngonngu = Sanphamngonngu::M; 
                                $modelspnn = new $Sanphamngonngu();        
                            }else{
                            //Đã có, update                    
                            }

                            $modelspnn->attributes = $value;

                            if($modelspnn->save()){              
                                $datajson = 1;                    
                            }else{
                                $transaction->rollback();                    
                                $datajson = 0; 
                                echo '<pre>';
                                print_r($modelspnn->errors);die;
                            }     
                                                           
                        }  
                    }   

                    $model[Sanpham::sp_id_chinhsach] = null;
                    $model[Sanpham::sp_id_danhmuc] = null;


                    if($model->save()){ 
                        $transaction->commit();
                        $datajson = 1;                   
                    }else{
                        $transaction->rollback();                    
                        $datajson = 0; 
                        echo '<pre>';
                        print_r($model->errors);die;
                    }               
                
                }else{
                    
                    // var_dump($model->errors);
                    $transaction->rollback();                    
                    $datajson = 0; 
                    echo '<pre>';
                    print_r($model->errors);die;
                } 

            } catch (Exception $e) {  
                Aabc::error($model->errors);
                $transaction->rollback();
                $datajson = 0;
            }
            Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;
            return $datajson;
            /* Binh thuong */
            /*
            $model->save();
       
            */
        }
        $data = NULL;
        // $ngonngu = new Ngonngu();        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            //Tìm các chính sách (All)
            $_Chinhsach  = Aabc::$app->_model->Chinhsach;                
            $chinhsach = $_Chinhsach::find()
                               ->andWhere([Aabc::$app->_chinhsach->cs_status => '1'])
                               ->andWhere([Aabc::$app->_chinhsach->cs_recycle => '2'])
                               ->andWhere([Aabc::$app->_chinhsach->cs_apdungcho => '1'])
                               ->all();
            $idcstatca = array_column($chinhsach, Aabc::$app->_chinhsach->cs_id); 
            $model[Sanpham::sp_id_chinhsach] = $idcstatca;


            $kq = $this->renderAjax('create'.$tp, [
                'model' => $model,
                // 'ngonngu' => $ngonngu->getAllNgonngu(),
                'data' => $data,
            ]);
            $kq = Aabc::$app->d->decodeview($kq);
            return $kq;
        }

        // Aabc::$app->MyComponent->dangonngu();

        die;
    }

    


    public function actionUt_b($id)
    {        
        return $this->updatestatus($id,$tp = 2);
    } 
    public function actionUt($id) //Updatestatus
    {
        return $this->updatestatus($id,$tp = 1);
    }

    protected function updatestatus($id, $tp) //Updatestatus
    {       
        $id = addslashes($id);
        $tp = addslashes($tp);
       
        $model = $this->findModel($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if($model[Sanpham::sp_status] == '1'){                
                $model[Sanpham::sp_status] = '2';                
            }else{                
                $model[Sanpham::sp_status] = '1';                
            }
            Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;
            if($model->save()){
                self::capnhat_cache_danhmuc($id);
                return 1;
            }
        } 
        die;
    }





    public function actionU_b($id){        
        return $this->update($id,$tp = 2);
    }   
    public function actionU($id = ''){      
        return $this->update($id,$tp = 1);
    }

    protected function update($id, $tp)
    {
        Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;
        // echo Aabc::$app->request->post('modal');
        // die;
        $id = addslashes($id);
        $tp = addslashes($tp);
        // $role = 'backend-sanpham-update';
        // if(!Aabc::$app->user->can($role)){             
        //     return 'nacc';die;
        // }
        $Sanphamdanhmuc = Aabc::$app->_model->Sanphamdanhmuc;
        $Sanphamchinhsach = Aabc::$app->_model->Sanphamchinhsach;
        $_Danhmuc  = Aabc::$app->_model->Danhmuc;

        $model = $this->findModel($id);

        // $model = new Sanpham;
        // $model->attributes = Sanpham::one($id);


        // $t = Aabc::$app->settings;
        // $tuyen = $t->get('sp_1');
        // $tuyen = json_decode($tuyen, true);
        // $model->attributes = $tuyen;


            // $data = Aabc::$app->dulieu->get('get_sp_1');
            // if ($data === false) {
            //     // $t = Aabc::$app->settings;
            //     // $tuyen = $t->get('sp_1');
            //     // $data = json_decode($tuyen, true);   
            //     $data = $Sanpham::find()->andWhere(['sp_id' => $id])->asArray()->one();        
            //     Aabc::$app->dulieu->set('get_sp_1', $data);
            // }
            // $model->attributes = $data;


        // print_r($model);
        // die;

        $datajson = 0;
        // Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;    
        // if(Aabc::$app->request->post('check') !== NULL){                
        //     return $this->checkmasp($id,$model[Sanpham::sp_masp]);
        //     die;
        // }

        if ($model->load(Aabc::$app->request->post()) ) {
            $model[Sanpham::sp_masp] = strtoupper($model[Sanpham::sp_masp]);
            $model['sp_masp'] = $model[Sanpham::sp_masp];
           

            if(Aabc::$app->request->post('ajax')){
                $errors = ActiveForm::validate($model); 
                if(!empty($errors[Sanpham::t.'-sp_masp'])){
                    $thaythe = $errors[Sanpham::t.'-sp_masp'];
                    unset($errors[Sanpham::t.'-sp_masp']);
                    $errors += [
                        Sanpham::t.'-'.Sanpham::sp_masp => $thaythe,
                    ];
                }
                return $errors;
                // return ActiveForm::validate($model);
            }

            //Album ảnh
            if(Aabc::$app->request->post('Al'))
                $model[Sanpham::sp_album] = Aabc::$app->request->post('Al');

            //Phiên bản giá
            if(Aabc::$app->request->post('Pb'))
                $model[Sanpham::sp_phienban] = Aabc::$app->request->post('Pb');


            //Thông số
            $tss = Aabc::$app->request->post('Ts');


            $postimg = Aabc::$app->request->post(Aabc::$app->d->postimg);
            if($postimg != ''){
                $postimg = implode("-",$postimg);            
            }
            $model[Sanpham::sp_images] = $postimg;


            //Mang Danh muc
            $arr_sp_id_danhmuc = NULL;
            $arr_sp_id_chuyenmuc = NULL;
            if($tp == 2){
                if( is_array($model[Sanpham::sp_id_danhmuc])){                
                    $arr_sp_id_danhmuc = array_unique($model[Sanpham::sp_id_danhmuc]); 
                }
                if( is_array($model[Sanpham::sp_id_chuyenmuc])){                
                    $arr_sp_id_chuyenmuc = array_unique($model[Sanpham::sp_id_chuyenmuc]); 
                }
            }

            if($tp == 1){
                $arr_sp_id_danhmuc[] = $model[Sanpham::sp_id_danhmuc];
            }

            // echo '<pre>';
            // print_r($arr_sp_id_danhmuc);
            // echo '</pre>';
            // die;


            //Mang Chinh sach
            $arr_sp_id_chinhsach = NULL;
            if( is_array($model[Sanpham::sp_id_chinhsach])){                
                $arr_sp_id_chinhsach = array_unique($model[Sanpham::sp_id_chinhsach]); 
            } 

            $data = Aabc::$app->request->post(Sanphamngonngu::T);                
            $model[Sanpham::sp_tensp] = $data[0][Sanphamngonngu::spnn_ten];  
            $model[Sanpham::sp_motaseo] = $data[0][Sanphamngonngu::spnn_gioithieu];  

            $transaction = \Aabc::$app->db->beginTransaction(); 
            try { 

                //Save thông số
                $ts_exist = [];
                $_Sanphamdanhmuc = Aabc::$app->_model->Sanphamdanhmuc;

                // echo '<pre>';
                // print_r($tss);
                // echo '</pre>';
                // die;

                if(is_array($tss)) foreach ($tss as $k_ts1 => $ts_group) {
                    
                    if(isset(($ts_group['i']))){
                    if(is_array($ts_group['i'])){

                    // echo '<pre>';
                    // print_r($ts_group);
                    // echo '</pre>';
                    // die;

                    foreach ($ts_group['i'] as $k_ts2 => $ts) {                           
                        $new_sp_dm = $_Sanphamdanhmuc::find()
                                            ->andWhere(['spdm_id_sp' => $id])
                                            ->andWhere(['spdm_id_danhmuc' => $ts])
                                            // ->andWhere(['spdm_type' => 5])
                                            ->one();
                        $ts_exist[] = (int)$ts;
                        if(!$new_sp_dm){
                            $new_sp_dm = new $_Sanphamdanhmuc();
                            $new_sp_dm->spdm_id_sp = $id;
                            $new_sp_dm->spdm_id_danhmuc = $ts;                            
                        }
                        $more_info = $ts_group['ii'][$ts];
                        $new_sp_dm->spdm_info = addslashes($more_info);

                        $new_sp_dm->spdm_type = 5;
                        if(!$new_sp_dm->save()) Aabc::error($new_sp_dm->errors);
                        
                    }}}
                }     
                $_Sanphamdanhmuc::xoatatca(['and',
                    ['spdm_id_sp' => $id],
                    ['spdm_type' => 5],
                    ['NOT IN','spdm_id_danhmuc',$ts_exist],
                ]);



                //Save danh mục nổi bật
                $noibat_exist = [];
                $noibats = $model[Sanpham::sp_noibat];

            
                if(is_array($noibats)) foreach ($noibats as $k_nb => $noibat) { 
                    $new_sp_dm = $_Sanphamdanhmuc::find()
                                        ->andWhere(['spdm_id_sp' => $id])
                                        ->andWhere(['spdm_id_danhmuc' => $noibat])
                                        // ->andWhere(['spdm_type' => 5])
                                        ->one();
                    $noibat_exist[] = (int)$noibat;
                    if(!$new_sp_dm){
                        $new_sp_dm = new $_Sanphamdanhmuc();
                        $new_sp_dm->spdm_id_sp = $id;
                        $new_sp_dm->spdm_id_danhmuc = $noibat;                            
                    }                    
                    $new_sp_dm->spdm_type = 4;
                    if(!$new_sp_dm->save()) Aabc::error($new_sp_dm->errors);
                }    

                //Xử lý xóa và afterdelete
                
                $_Sanphamdanhmuc::xoatatca(['and',
                    ['spdm_id_sp' => $id],
                    ['spdm_type' => 4],
                    ['NOT IN','spdm_id_danhmuc',$noibat_exist],
                ]);
                
                //End


                
                // $data = Aabc::$app->request->post(Sanphamngonngu::T);                 
                if(!empty($data)){
                    foreach ($data as $key => $value) {                        
                        $modelspnn = (Sanphamngonngu::M)::find()
                                    ->andWhere(['spnn_idsanpham' => $value[Sanphamngonngu::spnn_idsanpham]])
                                    ->andWhere(['spnn_idngonngu' => $value[Sanphamngonngu::spnn_idngonngu]])
                                    ->one();
                        //Xu ly link anh trong bai truoc khi luu
                        // $value[Sanphamngonngu::spnn_noidung] = $this->encodelinkanh($value[Sanphamngonngu::spnn_noidung]);

                        if($modelspnn == NULL){                            
                        //Chưa có, nên tạo mới
                            $Sanphamngonngu = Sanphamngonngu::M; 
                            $modelspnn = new $Sanphamngonngu();        
                        }else{
                        //Đã có, update                    
                        }

                        $modelspnn->attributes = $value;

                        if($modelspnn->save()){              
                            $datajson = 1;                    
                        }else{
                            $transaction->rollback();                    
                            $datajson = 0; 
                            echo '<pre>';
                            print_r($modelspnn->errors);die;
                        }     
                                                       
                    }  
                }    


        //         echo 'tuyen'.$id;
        // die;

                // Add Sanpham-Danhmuc;
                // $countspdm = $Sanphamdanhmuc::find()
                //                     ->andWhere(['spdm_id_sp' => $model[Sanpham::sp_id]])
                //                     ->count();                
                // if($countspdm > 0){
                //     if($Sanphamdanhmuc::deleteAll([Aabc::$app->Sanphamdanhmuc->spdm_id_sp => $model[Sanpham::sp_id]])){                        
                //     }
                // }


                ///Danh muc
                self::save_sanpham_danhmuc($_Danhmuc::SANPHAM, $model[Sanpham::sp_id], $arr_sp_id_danhmuc, $transaction );

                self::save_sanpham_danhmuc($_Danhmuc::BAIVIET, $model[Sanpham::sp_id], $arr_sp_id_chuyenmuc, $transaction );

               


                $model[Sanpham::sp_id_danhmuc] = null;




                // Add Sanpham-chinhsach; 
                if(!empty($arr_sp_id_chinhsach)){ 
                     $Sanphamchinhsach::deleteAll(['and',
                                        ['spcs_id_sp' => $model[Sanpham::sp_id]],
                                        ['NOT IN','spcs_id_chinhsach',$arr_sp_id_chinhsach],
                                ]);

                    foreach ($arr_sp_id_chinhsach as $key => $value) {  
                        $value = addslashes($value); 

                        $spcs = $Sanphamchinhsach::find()
                                    ->andWhere(['spcs_id_sp' => $model[Sanpham::sp_id]])
                                    ->andWhere(['spcs_id_chinhsach' => $value])
                                    ->one();
                        if(!$spcs){
                           
                            $spcs = new $Sanphamchinhsach();

                            $spcs['spcs_id_sp'] = $model[Sanpham::sp_id];
                            $spcs['spcs_id_chinhsach'] = $value;

                            if($spcs->save()){              
                                $datajson = 1;                    
                            }else{
                                $transaction->rollback();                    
                                $datajson = 0; 
                                // echo '<pre>';
                                // print_r($model->errors);die;
                            }
                        } 

                    }
                }else{
                    $Sanphamchinhsach::deleteAll(['and',
                                        ['spcs_id_sp' => $model[Sanpham::sp_id]],
                                ]);
                }
                $model[Sanpham::sp_id_chinhsach] = null;
               
                // print_r($model);
                // die;

                if($model->save(false)){ 
                    $transaction->commit();
                    $datajson = 1;                      
                    // FragmentCache::clear('sp-'.$model->sp_id);                 
                }else{                    
                    Aabc::error($model->errors);                    
                    $transaction->rollback();                    
                    $datajson = 0; 
                } 

            } catch (Exception $e) {            
                $transaction->rollback();
                $datajson = 0;
                print_r($e);
                die;
            }
            Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;
            return $datajson;
        } 
         // $id
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $Sanphamngonngu = Aabc::$app->_model->Sanphamngonngu;

            // $data = $Sanphamngonngu::find()
            //             ->joinWith('spnnIdngonngu', false, 'INNER JOIN')                    
            //             ->andWhere([Aabc::$app->_ngonngu->ngonngu_trangthai => '1'])
            //             ->andWhere(['spnn_idsanpham' => $id])
            //             ->all();

            // $data = $model->getSanphamNgonngus()->all();
            $data = Sanpham::getSanphamNgonngus($model)->all();
            

            $id_dmsp = Sanpham::getSpdmIdDanhmucs($model)->select(['dm_id'])->one();
            if($id_dmsp){
                $id_dmsp = $id_dmsp->dm_id;
            }
            

            $ts = Sanpham::getSpdmIdDanhmucsThongso($model)->select(['dm_id'])->column();

            if($id_dmsp && $tp == 1){       
                $html_ts = self::actionThongso($id_dmsp, $ts, $id);
                $html_ts = $html_ts['html'];
            }else{
                $html_ts = '';
            }


            // $data = Sanpham::getSpnnIdngonngus($model)->all();
            // $data = $model->getSpnnIdngonngus()->all();
            // echo '<pre>';
            // print_r($data);
            // die;


            //Xử lý link ảnh trước khi hiển thị
            foreach ($data as $key => $value) {
                $data[$key]['spnn_noidung'] = $this->decodelinkanh($data[$key]['spnn_noidung']);
            }


            // //Tìm danh sách các danh mục (1) của sản phẩm.
            // $model[Sanpham::sp_id_danhmuc] = $Sanphamdanhmuc::find()
            //                     ->select(['spdm_id_danhmuc'])
            //                     ->andWhere(['spdm_id_sp' => $id])
            //                     ->andWhere(['spdm_type' => 1])
            //                     ->column();       
            

            // //Tìm danh sách các chuyên mục (2) của sản phẩm.
            // $model[Sanpham::sp_id_chuyenmuc] = $Sanphamdanhmuc::find()
            //                     ->select(['spdm_id_danhmuc'])
            //                     ->andWhere(['spdm_id_sp' => $id])
            //                     ->andWhere(['spdm_type' => 2])
            //                     ->column();                   
            

            // //Tìm danh sách các danh mục (4) của sản phẩm.
            // $model[Sanpham::sp_noibat] = $Sanphamdanhmuc::find()
            //                     ->select(['spdm_id_danhmuc'])
            //                     ->andWhere(['spdm_id_sp' => $id])
            //                     ->andWhere(['spdm_type' => 4])
            //                     ->column();       
            






            //Tìm các chính sách (All, hoặc theo chứa nhóm, hoặc chứa sản phẩm này)
            $_Chinhsach  = Aabc::$app->_model->Chinhsach;                
            $idcstatca = $_Chinhsach::find()
                               ->select(['cs_id'])
                               ->andWhere([Aabc::$app->_chinhsach->cs_status => '1'])
                               ->andWhere([Aabc::$app->_chinhsach->cs_recycle => '2'])
                               ->andWhere([Aabc::$app->_chinhsach->cs_apdungcho => '1'])
                               ->column();
            
            $modeldanhmuc = $Sanphamdanhmuc::find()
                                ->joinWith('spdmIdDanhmuc',false,'INNER JOIN')    
                                ->andWhere([Aabc::$app->_danhmuc->dm_type => '1'])
                                ->andWhere([Aabc::$app->_danhmuc->dm_recycle => '2'])
                                ->andWhere([Aabc::$app->_danhmuc->dm_status => '1'])
                                ->andWhere(['spdm_id_sp' => $id])
                                ->all(); 
            foreach ($modeldanhmuc as $keydm => $valuedm) {
                $_Danhmucchinhsach  = Aabc::$app->_model->Danhmucchinhsach;                
                $danhmucchinhsach = $_Danhmucchinhsach::find()
                           ->joinWith('dmcsIdChinhsach','false','INNER JOIN')
                           ->andWhere([Aabc::$app->_chinhsach->cs_status => '1'])
                           ->andWhere([Aabc::$app->_chinhsach->cs_recycle => '2'])
                           ->andWhere([Aabc::$app->_danhmucchinhsach->dmcs_id_danhmuc => $valuedm['spdm_id_danhmuc']])
                           ->all();  
                foreach ($danhmucchinhsach as $keycs => $valuecs) {
                    array_push($idcstatca,$valuecs[Aabc::$app->_danhmucchinhsach->dmcs_id_chinhsach]);
                } 
            }   
            $sanphamchinhsach = $Sanphamchinhsach::find()
                                    ->joinWith('spcsIdChinhsach','false','INNER JOIN')
                                    ->andWhere([Aabc::$app->_chinhsach->cs_status => '1'])
                                    ->andWhere([Aabc::$app->_chinhsach->cs_recycle => '2'])
                                    ->andWhere(['spcs_id_sp'  => $id])
                                    ->all();
            foreach ($sanphamchinhsach as $keyspcs => $valuespcs) {
                array_push($idcstatca,$valuespcs['spcs_id_chinhsach']);
            }
            $model[Sanpham::sp_id_chinhsach] = $idcstatca;

        
            // Hợp 2 mảng
            // array_unique(array_merge($a,$b))


            // echo '<pre>';
            // print_r($model[Sanpham::sp_id_danhmuc]);die;

         
            $kq = $this->renderAjax('update'.$tp, [
                'model' => $model,
                'data' => $data,
                'html_ts' => $html_ts,
                // 'ngonngu' => $ngonngu->getAllNgonngu(),
            ]);
            $kq = Aabc::$app->d->decodeview($kq);
            return $kq;
        }
        
        die;
        // return $this->render('update', [
        //         'model' => $model,
        //     ]);        
    }


   

    protected function save_sanpham_danhmuc($type, $id_sp = '', $arr_sp_id_danhmuc = [], $transaction )
    {
        $Sanphamdanhmuc = Aabc::$app->_model->Sanphamdanhmuc;
        $_Danhmuc = Aabc::$app->_model->Danhmuc;

        $dieukien = ['and',
                            ['spdm_id_sp' => $id_sp],
                            ['spdm_type' => $type],
                        ];
        $all_sanphamdanhmuc = $Sanphamdanhmuc::find()
                                    ->select(['spdm_id_danhmuc'])
                                    ->where($dieukien)
                                    ->column();

        if(!empty($arr_sp_id_danhmuc)){ 
            $Sanphamdanhmuc::deleteAll(['and',
                                ['spdm_id_sp' => $id_sp],
                                ['spdm_type' => $type],
                                ['NOT IN','spdm_id_danhmuc',$arr_sp_id_danhmuc],
                        ]);
            foreach ($arr_sp_id_danhmuc as $key => $value) {  
                $value = addslashes($value);
                if(!empty($value)){
                    $spdm = $Sanphamdanhmuc::find()
                                ->andWhere(['spdm_id_sp' => $id_sp])
                                ->andWhere(['spdm_id_danhmuc' => $value])
                                ->one();
                    if(!$spdm){
                        $spdm = new $Sanphamdanhmuc();
                        $spdm['spdm_id_sp'] = $id_sp;
                        $spdm['spdm_id_danhmuc'] = $value;                            
                    }      
                    $spdm['spdm_type'] = $type;
                    if($spdm->save()){              
                        $datajson = 1;                    
                    }else{
                        $transaction->rollback();                        
                        return 0;
                    } 
                }                  
            } 
        }else{
            $Sanphamdanhmuc::deleteAll($dieukien);                    
        }
        foreach ($all_sanphamdanhmuc as $id_dm) {
            $danhmuc = $_Danhmuc::findOne(['dm_id' => $id_dm]);
            $_Danhmuc::cache($danhmuc);
            
        }
    }


     protected function capnhat_cache_danhmuc($id_sp) //Có thể 1 hoặc mảng
    {
        $Sanphamdanhmuc = Aabc::$app->_model->Sanphamdanhmuc;
        $_Danhmuc = Aabc::$app->_model->Danhmuc;

        $dieukien = ['and',
                        ['spdm_id_sp' => $id_sp],
                    ];
        $all_sanphamdanhmuc = $Sanphamdanhmuc::find()
                                    ->select(['spdm_id_danhmuc'])
                                    ->where($dieukien)
                                    ->column();
        
        foreach ($all_sanphamdanhmuc as $id_dm) {
            $danhmuc = $_Danhmuc::findOne(['dm_id' => $id_dm]);
            $_Danhmuc::cache($danhmuc);
        }
    }
    


    public function actionRes_b($id){
        return $this->restore($id, $tp = 2);
    }     
    public function actionRes($id){
        return $this->restore($id, $tp = 1);
    }
    protected function restore($id, $tp)
    {
        $id = addslashes($id);
        $tp = addslashes($tp);
        // $role = 'backend-sanpham-restore';
        // if(!Aabc::$app->user->can($role)){             
        //     return 'nacc';die;
        // }

        $datajson = 'thatbai'; 
        $model = $this->findModel($id);
        $model[Sanpham::sp_recycle] = '2';
        
        Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;
        return (1 && $model->save());
    }











    public function actionRec_b($id)
    {
        return $this->recycle($id, $tp = 2);
    }
    public function actionRec($id){
        return $this->recycle($id, $tp = 1);
    }   
     protected function recycle($id,$tp)
    {
        $id = addslashes($id);
        $tp = addslashes($tp);
        // $role = 'backend-sanpham-recycle';
        // if(!Aabc::$app->user->can($role)){             
        //     return 'nacc';die;
        // }

        $model = $this->findModel($id);
        $model[Sanpham::sp_recycle] = '1';
        
        Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;

        if($model->save()){
            return 1;
        }else{
            // print_r($model);
            // print_r($model->errors);
            // die;
            return 0;
        }

        // return (1 && $model->save());
    }











    public function actionReca_b()
    {
        return $this->recycleall($tp = 2);
    } 
    public function actionReca(){
        return $this->recycleall($tp = 1);
    }   
    protected function recycleall($tp)
    {
        $tp = addslashes($tp);
        // $role = 'backend-sanpham-recycleall';
        // if(!Aabc::$app->user->can($role)){             
        //     return 'nacc';die;
        // }
        Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;
        $data = Aabc::$app->request->post('selects');
        $typ = Aabc::$app->request->post('typ');
        $valu = Aabc::$app->request->post('valu');
       
        $transaction = \Aabc::$app->db->beginTransaction();
        try {
            foreach ($data as $key => $value) {                    
                $model = $this->findModel($value);
                
                if($typ == '3'){
                    $model[Sanpham::sp_recycle] = '1';
                }

                if($typ == '1' OR $typ == '2'){
                    $model[Sanpham::sp_status] = $valu;
                } 

                if($model->save()){    
                    self::capnhat_cache_danhmuc($value);                                        
                }else{
                    Aabc::error($model->sp_id);
                    Aabc::error($model->attributes);
                    Aabc::error($model->errors);
                    $transaction->rollback();
                    return 0;
                }
            } 
            $transaction->commit();
            return 1;
        } catch (Exception $e) {            
            $transaction->rollback();
            return 0;
        }

        

    }












    public function actionD_b($id)
    {
        return $this->delete($id,$tp = 2);
    } 
    public function actionD($id){
        return $this->delete($id,$tp = 1);
    }
    protected function delete($id, $tp)
    {
        $tp = addslashes($tp);
        $id = addslashes($id);
        // $role = 'backend-sanpham-delete';
        // if(!Aabc::$app->user->can($role)){             
        //     return 'nacc';die;
        // }
        $datajson = 'thatbai';  
        $model =  $this->findModel($id);   
            
        Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;        
        return (1 && ($model['sp_recycle'] == '1')  && $model->delete());
    }
    









    public function actionDa_b()
    {
        return $this->deleteall($tp = 2);
    }
    public function actionDa($tp = 1){
        return $this->deleteall($tp = 1);
    }     

    protected function deleteall($tp)
    {        
        $tp = addslashes($tp);
        // $role = 'backend-sanpham-deleteall';
        // if(!Aabc::$app->user->can($role)){             
        //     return 'nacc';die;
        // }

        $datajson = 'thatbai';
        
        Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;
        $Sanpham = Aabc::$app->_model->Sanpham;
        return ($Sanpham::deleteAll(['sp_recycle' => '1']) > 0? 1 : 0);
    }
   


    public function actionThongso($id = '',$ts_check = [],$id_sp = '')
    {           
        Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;   

        if(empty($id)){
            $id = Aabc::$app->request->post('dm'); //id danh muc san pham
        }

        $_Danhmuc  = Aabc::$app->_model->Danhmuc;
        $html = '';

        $nhomthongso = $_Danhmuc::find()
                                ->andWhere(['dm_dmsp' => $id])
                                ->andWhere(['in','dm_level',[0]])                                
                                ->all();

        foreach ($nhomthongso as $k_nts => $nts) {            
            $html .= '<fieldset>';
            $html .= '<legend>Nhóm thông số: '.$nts->dm_ten.'</legend>';  


            $thongso = $_Danhmuc::find()
                                    ->andWhere(['dm_idcha' => $nts->dm_id])
                                    ->andWhere(['in','dm_level',[1]])                                
                                    ->all();
            
            foreach ($thongso as $k => $ts) {  
                if($k%4 == 0) $html .= '<div class="clearfix"></div>';

                $html .= '<div id="tssp'.$ts->dm_id.'" class="col-md-3"><h4>'.$ts->dm_ten.'</h4>';
                $html .= '<span class="glyphicon glyphicon-pencil pjbm" d-m="2" id="menu00" d-u="ip_tn?ts='.$ts->dm_id.'&sp='.$id_sp.'&stt='.$k.'" d-i="danhmuc"></span>';
                $html .= '<div class="'.($ts->dm_multi == $_Danhmuc::MULTI?'ts-c':'ts-r').'" style="padding: 0 50px 0 0;">';                
                foreach ($ts->danhmuccon as $k_gt => $gt) {
                    $info = '';
                    if(in_array($gt->dm_id,$ts_check)){
                        $a = $gt->getSanphamDanhmucs()->andWhere(['spdm_id_sp' => $id_sp])->one();
                        if($a){
                            $info = $a->spdm_info;
                        }
                    }
                    $html .= '<label><input class="c_ts" '.(in_array($gt->dm_id,$ts_check)?'checked':'').' type="'.($ts->dm_multi == $_Danhmuc::MULTI?'checkbox':'radio').'" name="Ts['.$k_nts.$k.'][i][]" value="'.$gt->dm_id.'" />'.$gt->dm_ten;

                    $html .= '<input type="input" class="form-control '.(in_array($gt->dm_id,$ts_check)?'':'hide').' ts_more" name="Ts['.$k_nts.$k.'][ii]['.$gt->dm_id.']" value="'.$info.'" placeholder="Thông tin thêm">';

                    $html .= '</label>';
                }
                // $html .= '<input type="input" class="form-control" name="Ts['.$k.'][l]" value="'.$info.'" placeholder="Thông tin thêm">';
                $html .= '</div>';
                $html .= '</div>';
            }


            $html .= '</fieldset>';
        }//End nhomthongso
        
        $return['html'] = $html;
        // die;
        return $return;       
    }










    protected function checkmasp($id = 0,$maspconstan = '') {
        $data = 'ok';
        if(Aabc::$app->request->post('check') == '') return 'ok';            
        $masp = Aabc::$app->request->post('check');  
        $Sanpham = Aabc::$app->_model->Sanpham;
        $checkmasp = $Sanpham::find()->andWhere(['sp_masp' => $masp])->all();            
        if(count($checkmasp)){                
            $data = 'tontai';                               
            if($maspconstan != '' && $maspconstan == $masp){
                $data = 'ok';
            }
        }else{                
            $data = 'ok';                                
        }  
        return $data;
    }


    protected function encodelinkanh($html = '')
    {
        @$dom = new \DOMDocument();
        @$dom->loadHTML($html); // $html is HTML content
        $dom->preserveWhiteSpace = false;
        $tags_img = $dom->getElementsByTagName('img');
        $images = array();
        foreach($tags_img as $img)
        {    
            $url = $img->getAttribute('src');                                
            $pathinfo = pathinfo($url);
            $filename = $pathinfo['filename']; //Tìm ra tên ảnh
            // $images[] = $filename;
            $tachname = explode("-", $filename);
            $images[] = end($tachname);//Tìm ra id của ảnh
            $html = str_replace($filename, end($tachname), $html); //Thay thế tên ảnh bằng id ảnh            
        }
        return $html;
    }


    protected function decodelinkanh($html = '')
    {
        @$dom = new \DOMDocument();
        @$dom->loadHTML($html); // $html is HTML content
        $dom->preserveWhiteSpace = false;
        $tags_img = $dom->getElementsByTagName('img');
        $images = array();
        foreach($tags_img as $img)
        {    
            $url = $img->getAttribute('src');                                
            $pathinfo = pathinfo($url);
            $filename = $pathinfo['filename']; //Tìm ra tên ảnh
            // $images[] = $filename;            
            $images[] = $filename;//Tìm ra id của ảnh

            $_Image = Aabc::$app->_model->Image;
            $img = $_Image::find()
                        ->andWhere([Aabc::$app->_image->image_id  =>  $filename])
                        ->one();
            $filenamemoi = $img[Aabc::$app->_image->image_tenfile] . '-' . $img[Aabc::$app->_image->image_id];
            $html = str_replace($filename, $filenamemoi, $html); //Thay thế tên ảnh bằng id ảnh            
        }        
        return $html;
    }


    
    protected function findModel($id)
    {
        // $Sanpham = Aabc::$app->_model->Sanpham;
        if (($model = (Sanpham::M)::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
