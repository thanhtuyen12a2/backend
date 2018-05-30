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
                    's' => ['POST'], //search
                ],
            ],
        ];
    }


    public function actionS()
    {   
        Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON; 
        $return = ['results' => ['id' => '', 'text' => '']];
        if(Aabc::$app->request->post('q')){   
            $q = Aabc::$app->request->post('q');
            if (!empty($q)) {            
                $return['results'] = Sanpham::getOptionsFind($q);
            }            
        }
        return $return;
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

            $arr_sp_id_danhmuc = NULL;
            if( is_array($model[Sanpham::sp_id_danhmuc])){
                $arr_sp_id_danhmuc = array_unique($model[Sanpham::sp_id_danhmuc]); 
            } 
            $model[Sanpham::sp_id_danhmuc] = null;

            if($tp == 2 ){
                $model[Sanpham::sp_gia] = '0';
                $model[Sanpham::sp_giakhuyenmai] = '0';
            }

            if($model[Sanpham::sp_ngaytao] == null){
                $model[Sanpham::sp_ngaytao] = date("Y-m-d H:i");
            }

            $postimg = Aabc::$app->request->post(Aabc::$app->d->postimg);
            if($postimg != ''){
                $postimg = implode("-",$postimg);            
            }
            $model[Sanpham::sp_images] = $postimg;
            
            $model[Sanpham::sp_masp] = strtoupper($model[Sanpham::sp_masp]);

            if($model[Sanpham::sp_status] == NULL) $model[Sanpham::sp_status] = '1';
            if($model[Sanpham::sp_recycle] == NULL) $model[Sanpham::sp_recycle] = '2';
            if($model[Sanpham::sp_conhang] == NULL) $model[Sanpham::sp_conhang] = '1';
            if($model[Sanpham::sp_gia] == NULL) $model[Sanpham::sp_gia] = 0;

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
                   if(!empty($data)){
                        foreach ($data as $key => $value) {
                            $value[Sanphamngonngu::spnn_idsanpham]  = $id;                            
                            $modelspnn = (Sanphamngonngu::M)::find()
                                        ->andWhere(['spnn_idsanpham' => $value[Sanphamngonngu::spnn_idsanpham]])
                                        ->andWhere(['spnn_idngonngu' => $value[Sanphamngonngu::spnn_idngonngu]])
                                        ->one();
                            //Xu ly link anh trong bai truoc khi luu
                            $value[Sanphamngonngu::spnn_noidung] = $this->encodelinkanh($value[Sanphamngonngu::spnn_noidung]);
                            if($modelspnn == NULL){                            
                            //Chưa có, nên tạo mới
                                $Sanphamngonngu = Sanphamngonngu::M; 
                                $modelspnn = new $Sanphamngonngu();                           
                                
                                $modelspnn->attributes = $value;
                               
                                if($modelspnn->save()){              
                                    $datajson = 1;                    
                                }else{
                                    $transaction->rollback();                    
                                    $datajson = 0; 
                                    echo '<pre>';
                                    print_r($modelspnn->errors);die;
                                }                        
                            }else{
                            //Đã có, update
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
                //var_dump($model->errors);          
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
        // $role = 'backend-sanpham-updatestatus';
        // if(!Aabc::$app->user->can($role)){             
        //     return 'nacc';die;
        // }

        $model = $this->findModel($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if($model[Sanpham::sp_status] == '1'){                
                $model[Sanpham::sp_status] = '2';                
            }else{                
                $model[Sanpham::sp_status] = '1';                
            }
             /* Json */
            Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;
            return (1 && $model->save());
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

            $postimg = Aabc::$app->request->post(Aabc::$app->d->postimg);
            if($postimg != ''){
                $postimg = implode("-",$postimg);            
            }
            $model[Sanpham::sp_images] = $postimg;


            //Mang Danh muc
            $arr_sp_id_danhmuc = NULL;
            if( is_array($model[Sanpham::sp_id_danhmuc])){                
                $arr_sp_id_danhmuc = array_unique($model[Sanpham::sp_id_danhmuc]); 
            } 

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
                  // echo 'tuyen2-'.$id;
        // die;
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

                if(!empty($arr_sp_id_danhmuc)){ 
                    $Sanphamdanhmuc::deleteAll(['and',
                                        ['spdm_id_sp' => $model[Sanpham::sp_id]],
                                        ['NOT IN','spdm_id_danhmuc',$arr_sp_id_danhmuc],
                                ]);


                    foreach ($arr_sp_id_danhmuc as $key => $value) {  
                        $value = addslashes($value);
                        $spdm = $Sanphamdanhmuc::find()
                                    ->andWhere(['spdm_id_sp' => $model[Sanpham::sp_id]])
                                    ->andWhere(['spdm_id_danhmuc' => $value])
                                    ->one();
                        if(!$spdm){
                            $spdm = new $Sanphamdanhmuc();

                            $spdm['spdm_id_sp'] = $model[Sanpham::sp_id];
                            $spdm['spdm_id_danhmuc'] = $value;

                            if($spdm->save()){              
                                $datajson = 1;                    
                            }else{
                                $transaction->rollback();                    
                                $datajson = 0; 
                                // echo '<pre>';
                                // print_r($model->errors);die;
                            }
                        }                         
                    }
                }
                $model[Sanpham::sp_id_danhmuc] = null;




                // Add Sanpham-chinhsach;              
                //  $Sanphamchinhsach::deleteAll(['and',
                //                         ['spcs_id_sp' => $model[Sanpham::sp_id]],
                //                         ['NOT IN','spcs_id_chinhsach',$arr_sp_id_chinhsach],
                //                 ]);
                // if(isset($arr_sp_id_chinhsach)){ 
                //     foreach ($arr_sp_id_chinhsach as $key => $value) {  
                //         $value = addslashes($value); 

                //         $spcs = $Sanphamchinhsach::find()
                //                     ->andWhere(['spcs_id_sp' => $model[Sanpham::sp_id]])
                //                     ->andWhere(['spcs_id_chinhsach' => $value])
                //                     ->one();
                //         if(!$spcs){
                           
                //             $spcs = new $Sanphamchinhsach();

                //             $spcs['spcs_id_sp'] = $model[Sanpham::sp_id];
                //             $spcs['spcs_id_chinhsach'] = $value;

                //             if($spcs->save()){              
                //                 $datajson = 1;                    
                //             }else{
                //                 $transaction->rollback();                    
                //                 $datajson = 0; 
                //                 // echo '<pre>';
                //                 // print_r($model->errors);die;
                //             }
                //         } 

                //     }
                // }
                $model[Sanpham::sp_id_chinhsach] = null;
               
                // print_r($model);
                // die;

                if($model->save(false)){ 
                    $transaction->commit();
                    $datajson = 1;                      
                    // FragmentCache::clear('sp-'.$model->sp_id);                 
                }else{
                    echo '<pre>';
                    print_r($model->errors);die;
                    
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
            
            // $data = Sanpham::getSpnnIdngonngus($model)->all();
            // $data = $model->getSpnnIdngonngus()->all();
            // echo '<pre>';
            // print_r($data);
            // die;


            //Xử lý link ảnh trước khi hiển thị
            foreach ($data as $key => $value) {
                $data[$key]['spnn_noidung'] = $this->decodelinkanh($data[$key]['spnn_noidung']);
            }


            //Tìm danh sách các danh mục của sản phẩm.
            $modeldanhmuc = $Sanphamdanhmuc::find()
                                ->andWhere(['spdm_id_sp' => $id])
                                ->all();       
            $datadanhmuc = array_column($modeldanhmuc, 'spdm_id_danhmuc');
            $model[Sanpham::sp_id_danhmuc] = $datadanhmuc;




            //Tìm các chính sách (All, hoặc theo chứa nhóm, hoặc chứa sản phẩm này)
            $_Chinhsach  = Aabc::$app->_model->Chinhsach;                
            $chinhsach = $_Chinhsach::find()
                               ->andWhere([Aabc::$app->_chinhsach->cs_status => '1'])
                               ->andWhere([Aabc::$app->_chinhsach->cs_recycle => '2'])
                               ->andWhere([Aabc::$app->_chinhsach->cs_apdungcho => '1'])
                               ->all();
            $idcstatca = array_column($chinhsach, Aabc::$app->_chinhsach->cs_id); 

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
                    }else{
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
        return (1 && ($model[Sanpham::sp_recycle] == '1')  && $model->delete());
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
   


    public function actionThongso()
    {      
        Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;   
        $id = Aabc::$app->request->post('dm'); //id danh muc san pham

        $_Danhmuc  = Aabc::$app->_model->Danhmuc;

        $thongso = $_Danhmuc::find()
                                ->andWhere(['dm_dmsp' => $id])
                                ->andWhere(['in','dm_level',[1]])                                
                                ->all();
        $html = '';
        foreach ($thongso as $k => $ts) {  
            if($k%4 == 0) $html .= '<div class="clearfix"></div>';

            $html .= '<div class="col-md-3"><h4>'.$ts->dm_ten.'</h4>';
            $html .= '<div>';
            foreach ($ts->danhmuccon as $k_gt => $gt) {
                $html .= '<label><input type="'.($ts->dm_multi == $_Danhmuc::MULTI?'checkbox':'radio').'" name="thongso['.$k.'][]" value="'.$gt->dm_id.'" />'.$gt->dm_ten.'</label>';
            }
            $html .= '</div>';
            $html .= '</div>';
        }

        
        $return['html'] = $html;
        return $return;
        die;


        $model = (Sanpham::M)::find()->andWhere(['<','sp_id',1000])->joinWith('sanphamDanhmucs')->all();
       
        // $a = Sanpham::getSanphamDanhmucs($model)->all();

        echo '<pre>';
        print_r($model);
        echo '</pre>';
        die;
        
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
