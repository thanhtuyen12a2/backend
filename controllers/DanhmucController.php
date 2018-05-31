<?php
namespace backend\controllers;
use Aabc;

use backend\models\Danhmuc;
//use backend\models\DanhmucSearch;
use aabc\web\Controller;
use aabc\web\NotFoundHttpException;
use aabc\filters\VerbFilter;


use aabc\db\Transaction;
use aabc\base\Exception;
use aabc\base\ErrorException;
use aabc\base\ErrorHandler;

use aabc\web\ForbiddenHttpException;
use aabc\filters\AccessControl;
//use aabc\widgets\ActiveForm;


class DanhmucController extends Controller
{
    public function behaviors()
    {
        return [
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
            //                 $role = $action . '-' . $control;
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
                    // 'i' => ['POST'], //index
                    'ip' => ['POST'], //index popup
                    'ir' => ['POST'], //indexrecycle
                    'rec' => ['POST'], //recycle
                    'reca' => ['POST'], //recycleall
                    'res' => ['POST'], //restore
                    'd' => ['POST'], //delete
                    'da' => ['POST'], //
                    'c' => ['POST'], //create
                    'u' => ['POST'], //update
                    'ut' => ['POST'], //updatethutu
                    'us' => ['POST'], //updatestatus
                    'pja' => ['POST'], //Pjax element
                ],
            ],
        ];
    }
    
 
    //tp - type (1 san pham, 2 bai viet, 3 dmsp hotnhat moinhat, 4 menu )
    // public function actionI($t = 10) 
    // {
    //     //$role = 'backend-danhmuc-index2';
    //     //if(!Aabc::$app->user->can($role)){ return 'nacc';die;} 
    //     $_DanhmucSearch = Aabc::$app->_model->DanhmucSearch;
    //     $searchModel = new $_DanhmucSearch(
    //         [Aabc::$app->_danhmuc->dm_recycle => '2']            
    //     );

    //     //$searchModel = new DanhmucSearch(
    //     //    [Aabc::$app->_danhmuc->dm_recycle => '2']
    //     //);
    //     $dataProvider = $searchModel->search(Aabc::$app->request->queryParams);
    //     //$dataProvider->setSort([
    //     //    'defaultOrder' => ['id'=>SORT_DESC]        
    //     //]);
    //     $dataProvider->pagination->pageSize=$t;        
    //     $kq = $this->renderAjax('index', [        
    //         'searchModel' => $searchModel,
    //         'dataProvider' => $dataProvider,
    //     ]);
    //     $kq = Aabc::$app->d->decodeview($kq);
    //         return $kq;
    // }

    public function actionI_cm($t = 100)
    {
        return $this->index($t,$tp = 2);
    }

    public function actionI_dm($t = 100)
    {
        return $this->index($t,$tp = 3);
    }

    public function actionI_mn($t = 100)
    {        
        return $this->index($t,$tp = 4);
    }
    public function actionI_tn($t = 100)
    {    
        return $this->index($t,$tp = 5);
    }
    public function actionI($t = 100){
        return $this->index($t, $tp = 1);
    }

    protected function index($t, $tp)
    {
        //$role = 'backend-danhmuc-index';
        //if(!Aabc::$app->user->can($role)){ return 'nacc';die;}

        $dmsp = '';
        $thongso = '';
        if($tp == 5){
            if(isset($_GET['dmsp'])){
                $dmsp = $_GET['dmsp'];
            }
            if(empty($dmsp)){
                $_Danhmuc = Aabc::$app->_model->Danhmuc;
                $all = $_Danhmuc::getDanhmucOption(1);                
                reset($all);
                $first_key = key($all);
                $dmsp = $first_key;
            }
            if(isset($_GET['ts'])){
                $thongso = $_GET['ts'];
            }
        }
        

        $tp = addslashes($tp);
        // echo $tp;die;
        $_DanhmucSearch = Aabc::$app->_model->DanhmucSearch;
        $searchModel = new $_DanhmucSearch([
            Aabc::$app->_danhmuc->dm_recycle => '2',
            Aabc::$app->_danhmuc->dm_type => $tp,
            'dm_dmsp' => $dmsp,
            'dm_thongso' => $thongso,
        ]);
        
        $dataProvider = $searchModel->search(Aabc::$app->request->queryParams);
        $dataProvider->setSort([
           'defaultOrder' => [Aabc::$app->_danhmuc->dm_sothutu => SORT_ASC]        
        ]);
        $dataProvider->pagination->pageSize=$t;        
        $kq = $this->renderAjax('index'.$tp, [        
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        $kq = Aabc::$app->d->decodeview($kq);
            return $kq;
    }





    public function actionIp_cm($t = 100)
    {
        return $this->indexpopup($t,$tp = 2);
    }

    public function actionIp_dm($t = 100)
    {
        return $this->indexpopup($t,$tp = 3);
    }

    public function actionIp_mn($t = 100,$g = '',$l='')
    {        
        return $this->indexpopup($t,$tp = 4,$g,$l);
    }
    public function actionIp_tn($t = 100)
    {        
        return $this->indexpopup($t,$tp = 5);
    }
    public function actionIp($t = 100){
        return $this->indexpopup($t, $tp = 1);
    }

    protected function indexpopup($t, $tp, $g = '',$l = '')
    {
        //$role = 'backend-danhmuc-index';
        //if(!Aabc::$app->user->can($role)){ return 'nacc';die;}
        $dmsp = '';
        $thongso = '';
        if($tp == 5){
            if(isset($_GET['dmsp'])){
                $dmsp = $_GET['dmsp'];
            }
            if(empty($dmsp)){
                $_Danhmuc = Aabc::$app->_model->Danhmuc;
                $all = $_Danhmuc::getDanhmucOption(1);                
                reset($all);
                $first_key = key($all);
                $dmsp = $first_key;
            }
            if(isset($_GET['ts'])){
                $thongso = $_GET['ts'];
            }
        }
    


        $tp = addslashes($tp);
        // echo $tp;die;
        $_DanhmucSearch = Aabc::$app->_model->DanhmucSearch;
        $searchModel = new $_DanhmucSearch([
            Aabc::$app->_danhmuc->dm_recycle => '2',
            Aabc::$app->_danhmuc->dm_type => $tp,
            // empty($g)? : 'dm_groupmenu' => $g,
            'dm_dmsp' => $dmsp,
            'dm_thongso' => $thongso,
            'dm_groupmenu' => $g,
        ]);
        
        $dataProvider = $searchModel->search(Aabc::$app->request->queryParams);
        $dataProvider->setSort([
           'defaultOrder' => [Aabc::$app->_danhmuc->dm_sothutu => SORT_ASC]        
        ]);
        $dataProvider->pagination->pageSize=$t;        
        $kq = $this->renderAjax('indexpopup'.$tp, [        
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'groupmenu' => $g,
            'title' => $l,
        ]);
        $kq = Aabc::$app->d->decodeview($kq);
            return $kq;
    }







    public function actionIr_cm()
    {
        return $this->indexrecycle($tp = 2);
    }

    public function actionIr_dm()
    {
        return $this->indexrecycle($tp = 3);
    }

    public function actionIr_mn()
    {
        return $this->indexrecycle($tp = 4);
    }
    public function actionIr_tn()
    {
        return $this->indexrecycle($tp = 5);
    }
    public function actionIr() //Indexrecycle
    {
        return $this->indexrecycle($tp = 1);
    }

    protected function indexrecycle($tp) //Indexrecycle
    {
        //$role = 'backend-danhmuc-indexrecycle';
        //if(!Aabc::$app->user->can($role)){ return 'nacc';die;}
        $tp = addslashes($tp);
        
        $_DanhmucSearch = Aabc::$app->_model->DanhmucSearch;
        $searchModel = new $_DanhmucSearch([
            Aabc::$app->_danhmuc->dm_recycle => '1',
            Aabc::$app->_danhmuc->dm_type => $tp
        ]);
        
        $dataProvider = $searchModel->search(Aabc::$app->request->queryParams);
        
        $kq = $this->renderAjax('indexrecycle'.$tp, [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        $kq = Aabc::$app->d->decodeview($kq);
            return $kq;
    }

    



    public function actionPja_cm()
    {
        return $this->pjaelement($tp = 2);
    }

    public function actionPja_dm()
    {
        return $this->pjaelement($tp = 3);
    }

    public function actionPja_mn()
    {
        return $this->pjaelement($tp = 4);
    }
    public function actionPja_tn()
    {
        return $this->pjaelement($tp = 5);
    }
    // public function actionPja() //Pjax element{
    // {
    //     return $this->pjaelement($tp = 1);
    // }  

    public function actionPja() //Pjax element{
    {
        $tp = '1';
        $_Danhmuc = new Aabc::$app->_model->Danhmuc();        
        $model = $_Danhmuc::find()
                    ->andWhere([Aabc::$app->_danhmuc->dm_type => $tp])
                    ->andWhere([Aabc::$app->_danhmuc->dm_recycle => '2'])                        
                    ->andWhere([Aabc::$app->_danhmuc->dm_status => '1'])
                    ->orderBy([Aabc::$app->_danhmuc->dm_sothutu=>SORT_ASC])
                    ->all();
        Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;
        
        if(isset($model)){
            $kq = '';
            foreach ($model as $key => $value) {
                $_Danhmucchinhsach = Aabc::$app->_model->Danhmucchinhsach; 
                $dmcs = $_Danhmucchinhsach::find()
                            ->joinWith('dmcsIdChinhsach', false, 'INNER JOIN')                    
                            ->andWhere([Aabc::$app->_chinhsach->cs_status => '1'])
                            ->andWhere([Aabc::$app->_chinhsach->cs_recycle => '2'])
                            ->andWhere([Aabc::$app->_danhmucchinhsach->dmcs_id_danhmuc => $value[Aabc::$app->_danhmuc->dm_id]])
                            ->all();
                $list_chinhsach = '';
                foreach ($dmcs as $keydmcs => $valuedmcs) {
                    $list_chinhsach .= '#@' . $valuedmcs[Aabc::$app->_danhmucchinhsach->dmcs_id_chinhsach];
                }
                if($list_chinhsach == '') $list_chinhsach = '#@';

                $kq .= $value[Aabc::$app->_danhmuc->dm_id] .'@abcd#'. $value[Aabc::$app->_danhmuc->dm_char] . $list_chinhsach . '@aabc#';
            }
            $kq = Aabc::$app->d->decodeview($kq);
            return $kq;
        }        
        die;
    }


    protected function pjaelement($tp) //Pjax element
    {
        $tp = addslashes($tp);
        $_Danhmuc = new Aabc::$app->_model->Danhmuc();
       
        $model = $_Danhmuc::find()
                    ->andWhere([Aabc::$app->_danhmuc->dm_type => $tp])
                    ->andWhere([Aabc::$app->_danhmuc->dm_recycle => '2'])                        
                    ->andWhere([Aabc::$app->_danhmuc->dm_status => '1'])
                    ->orderBy([Aabc::$app->_danhmuc->dm_sothutu=>SORT_ASC])
                    ->all();

        Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;
        // $kq = serialize($kq);
        if(isset($model)){
            $kq = '';
            foreach ($model as $key => $value) {
                 $kq .= $value[Aabc::$app->_danhmuc->dm_id] .'@abcd#'. $value[Aabc::$app->_danhmuc->dm_char] . '@aabc#';
            }
            $kq = Aabc::$app->d->decodeview($kq);
            return $kq;
        }        
        die;
    }


    //public function actionView($id)
    //{
    //    die;
    //    return $this->render('view', [
    //        'model' => $this->findModel($id),
    //    ]);
    //}

    


    public function actionC_cm()
    {
        return $this->create($tp = 2);
    }

    public function actionC_dm()
    {
        return $this->create($tp = 3);
    }

    public function actionC_mn($g = '',$pa = '')
    {
        return $this->create($tp = 4,$g,$pa);
    }
    public function actionC_tn()
    {
        return $this->create($tp = 5);
    }
    public function actionC() //Create
    {
        return $this->create($tp = 1);
    }

    protected function create($tp, $g = '',$pa = '') //Create
    {
        $tp = addslashes($tp);

        $_Danhmuc = Aabc::$app->_model->Danhmuc;
        $model = new $_Danhmuc();
        $datajson = '0';
        if ($model->load(Aabc::$app->request->post())) {  

            if($tp == 4){
                $model->dm_status = '1';
                // $model->dm_groupmenu = $g;
            }

            $model[Aabc::$app->_danhmuc->dm_type] = $tp;

            if($model[Aabc::$app->_danhmuc->dm_thutu] == NULL) $model[Aabc::$app->_danhmuc->dm_thutu] = 1;
            
            if($model[Aabc::$app->_danhmuc->dm_idcha] == NULL) $model[Aabc::$app->_danhmuc->dm_idcha] = NULL; 
            $model2 = $_Danhmuc::find() 
                        ->andWhere([Aabc::$app->_danhmuc->dm_idcha => $model[Aabc::$app->_danhmuc->dm_idcha]])
                        ->orderBy([Aabc::$app->_danhmuc->dm_thutu => SORT_DESC])
                        ->one();
            if(isset($model2)){
                $model[Aabc::$app->_danhmuc->dm_thutu] = (int)$model2[Aabc::$app->_danhmuc->dm_thutu] + 1;
            }

            $transaction = \Aabc::$app->db->beginTransaction();             
            try {   
                $model->removenull(Aabc::$app->request->post('Kc'));
                              
                if($model->save()){ 
                    // $data = Aabc::$app->request->post('Nhomsanphamngonngu');
                    // if($data !== NULL){
                        // foreach ($data as $key => $value) { 
                        //     //tạo mới trong ngonngu
                        //     $modelnspnn = new Nhomsanphamngonngu();
                        //     $modelnspnn->attributes = $value;
                        //     $modelnspnn->nspnn_idnhomsanpham = $model->nsp_id; //Gán id nsp vừa create
                        //     if($modelnspnn->save()){              
                        //         $datajson = 'thanhcong';                    
                        //     }else{
                        //         $transaction->rollback();                    
                        //         $datajson = 'thatbai'; 
                        //     }                          
                        // }  
                    // }

                    $_SESSION["dem"] = 0 ;
                    $_Danhmuc = $_Danhmuc::find()
                           ->andWhere([Aabc::$app->_danhmuc->dm_recycle => '2'])
                           ->andWhere([Aabc::$app->_danhmuc->dm_type => $model[Aabc::$app->_danhmuc->dm_type]]) 
                           ->orderBy([Aabc::$app->_danhmuc->dm_thutu=>SORT_ASC])
                           ->all();

                        Aabc::$app->MyComponent->sothutudanhmuc($_Danhmuc, $model[Aabc::$app->_danhmuc->dm_type], $model[Aabc::$app->_danhmuc->dm_groupmenu]);

                    $transaction->commit();
                    $datajson = '1';                   
                }else{
                    // print_r($model->errors);
                    // die;
                    Aabc::error($model->errors);
                    $transaction->rollback();                    
                    $datajson = '0'; 
                } 
            } catch (Exception $e) {   
                Aabc::error($e);
                $transaction->rollback();
                $datajson = '0';
            }
            Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;               
            // $datajson = array('data' => $datajson,'tuyen'=>$_Danhmuc::getAllStatus1());
            // $datajson = 'thanhcong';  
            return $datajson;          
            
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {


            //Tìm các chính sách (All)
            $_Chinhsach  = Aabc::$app->_model->Chinhsach;                
            $chinhsach = $_Chinhsach::find()
                               ->andWhere([Aabc::$app->_chinhsach->cs_status => '1'])
                               ->andWhere([Aabc::$app->_chinhsach->cs_recycle => '2'])
                               ->andWhere([Aabc::$app->_chinhsach->cs_apdungcho => '1'])
                               ->all();
            $idcstatca = array_column($chinhsach, Aabc::$app->_chinhsach->cs_id); 
            $model[Aabc::$app->_danhmuc->dm_id_chinhsach] = $idcstatca;





            // $allngonngu = new Ngonngu();
            $kq = $this->renderAjax('create'.$tp, [
                'model' => $model,
                'groupmenu' => $g,
                'pa' => $pa,
                // 'allngonngu' => $allngonngu->getAllNgonngu(),
            ]);
            $kq = Aabc::$app->d->decodeview($kq);
            return $kq;
        }
        
        die;
    }

    





    public function actionU_cm($id)
    {
        return $this->update($id, $tp = 2);
    }

    public function actionU_dm($id)
    {
        return $this->update($id, $tp = 3);
    }

    public function actionU_mn($id)
    {
        return $this->update($id, $tp = 4);
    }
    public function actionU_tn($id)
    {
        return $this->update($id, $tp = 5);
    }
    public function actionU($id) //Update
    {
        return $this->update($id, $tp = 1);
    }


    protected function update($id, $tp) //Update
    {
        $id = addslashes($id);
        $tp = addslashes($tp);

        $_Danhmuc = Aabc::$app->_model->Danhmuc;
        $_Chinhsach  = Aabc::$app->_model->Chinhsach;             
        $_Danhmucchinhsach = Aabc::$app->_model->Danhmucchinhsach;


        $model = $this->findModel($id);
        $datajson = 0; 
        if ($model->load(Aabc::$app->request->post()) ) {
                       

            $arr_dm_id_chinhsach = NULL;
            if( is_array($model[Aabc::$app->_danhmuc->dm_id_chinhsach])){
                $arr_dm_id_chinhsach = array_unique($model[Aabc::$app->_danhmuc->dm_id_chinhsach]);
            } 
            
            $transaction = \Aabc::$app->db->beginTransaction(); 

            try {                 
                
                    // Add Danhmuc - Chinh sach; 
                    $countdmcs = $_Danhmucchinhsach::find()
                                ->andWhere([Aabc::$app->_danhmucchinhsach->dmcs_id_danhmuc => $model[Aabc::$app->_danhmuc->dm_id]])
                                ->count();
                    if($countdmcs > 0){
                        if($_Danhmucchinhsach::deleteAll([Aabc::$app->_danhmucchinhsach->dmcs_id_danhmuc => $model[Aabc::$app->_danhmuc->dm_id]])){                        
                        }                        
                    }                    
                    if(isset($arr_dm_id_chinhsach)){
                        foreach ($arr_dm_id_chinhsach as $key => $value) {
                            $value = addslashes($value);                            
                            $dmcs = new $_Danhmucchinhsach();
                            $dmcs[Aabc::$app->_danhmucchinhsach->dmcs_id_danhmuc] = $model[Aabc::$app->_danhmuc->dm_id];
                            $dmcs[Aabc::$app->_danhmucchinhsach->dmcs_id_chinhsach] = $value;

                            if($dmcs->save()){              
                                $datajson = 1;                    
                            }else{
                                Aabc::error($model->errors);
                                $transaction->rollback();                    
                                $datajson = 0; 
                            }                            
                        }
                    }
                    $model[Aabc::$app->_danhmuc->dm_id_chinhsach] = null;

                    $model->removenull(Aabc::$app->request->post('Kc'));

                    if($model->save(false)){ 
                        $_SESSION["dem"] = 0 ;
                        $_Danhmuc = $_Danhmuc::find()
                           ->andWhere([Aabc::$app->_danhmuc->dm_recycle => '2'])
                           ->andWhere([Aabc::$app->_danhmuc->dm_type => $model[Aabc::$app->_danhmuc->dm_type]]) 
                           ->orderBy([Aabc::$app->_danhmuc->dm_thutu=>SORT_ASC])
                           ->all();
                                               
                        Aabc::$app->MyComponent->sothutudanhmuc($_Danhmuc, $model[Aabc::$app->_danhmuc->dm_type], $model[Aabc::$app->_danhmuc->dm_groupmenu]);
                       
                        $transaction->commit();
                        $datajson = 1;                   
                    }else{
                        // echo '<pre>';
                        // print_r($model->errors);die;

                        $transaction->rollback();                    
                        $datajson = 0; 
                    } 
            } catch (Exception $e) {            
                $transaction->rollback();
                $datajson = 0;
            }

            Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;

            // $datajson = array('data' => $datajson);
            // $datajson = 'thanhcong';  
            return $datajson; 

        } 

         if ($_SERVER['REQUEST_METHOD'] === 'POST') {            
            

            $chinhsach = $_Chinhsach::find()
                               ->andWhere([Aabc::$app->_chinhsach->cs_status => '1'])
                               ->andWhere([Aabc::$app->_chinhsach->cs_recycle => '2'])
                               ->andWhere([Aabc::$app->_chinhsach->cs_apdungcho => '1'])
                               ->all();
            $idcstatca = array_column($chinhsach, Aabc::$app->_chinhsach->cs_id); 
 
            $danhmucchinhsach = $_Danhmucchinhsach::find()
                                    ->joinWith('dmcsIdChinhsach','false','INNER JOIN')
                                    ->andWhere([Aabc::$app->_chinhsach->cs_status => '1'])
                                    ->andWhere([Aabc::$app->_chinhsach->cs_recycle => '2'])
                                    ->andWhere([Aabc::$app->_danhmucchinhsach->dmcs_id_danhmuc  => $id])
                                    ->all();
            foreach ($danhmucchinhsach as $keydmcs => $valuedmcs) {
                array_push($idcstatca,$valuedmcs[Aabc::$app->_danhmucchinhsach->dmcs_id_chinhsach]);
            }
            $model[Aabc::$app->_danhmuc->dm_id_chinhsach] = $idcstatca;





            // $allngonngu = new Ngonngu();           
            $kq = $this->renderAjax('update'.$tp, [
                'model' => $model,
                 // 'allngonngu' => $allngonngu->getAllNgonngu(),
            ]);
            $kq = Aabc::$app->d->decodeview($kq);
            return $kq;
        }
        die;
    }









    public function actionUs_cm($id)
    {
        return $this->updatestatus($id,$tp = 2);
    }

    public function actionUs_dm($id)
    {
        return $this->updatestatus($id,$tp = 3);
    }
    public function actionUs_mn($id)
    {
        return $this->updatestatus($id,$tp = 4);
    }
    public function actionUs_tn($id)
    {
        return $this->updatestatus($id,$tp = 5);
    }
    public function actionUs($id) //Updatestatus
    {
        return $this->updatestatus($id,$tp = 1);
    }

    protected function updatestatus($id,$tp) //Updatestatus
    {       
        $id = addslashes($id);
        $tp = addslashes($tp);
        //$role = 'backend-danhmuc-updatestatus';
        //if(!Aabc::$app->user->can($role)){ return 'nacc';die;}

        $model = $this->findModel($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if($model[Aabc::$app->_danhmuc->dm_status] == '2'){
                $model[Aabc::$app->_danhmuc->dm_status] = '1';
            }else{
                $model[Aabc::$app->_danhmuc->dm_status] = '2';
            }
             /* Json */
            Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;
            return (1 && $model->save());
        } 
        die;
    }







    public function actionUt_cm($id,$t = '')
    {
        return $this->updatethuthu($id,$t,$tp = 2);
    }

    public function actionUt_dm($id,$t = '')
    {
        return $this->updatethuthu($id,$t,$tp = 3);
    }
    public function actionUt_mn($id,$t = '')
    {
        return $this->updatethuthu($id,$t,$tp = 4);
    }
    public function actionUt_tn($id,$t = '')
    {
        return $this->updatethuthu($id,$t,$tp = 5);
    }
    public function actionUt($id,$t = '')
    {
        return $this->updatethuthu($id,$t,$tp = 1);
    }

    protected function updatethuthu($id,$t,$tp)
    {       
        $id = addslashes($id);
        $t = addslashes($t);
        $tp = addslashes($tp);

        $_Danhmuc = Aabc::$app->_model->Danhmuc;
        // [Aabc::$app->_danhmuc

        $model = $this->findModel($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $sothututhaydoi = 0;
            $model2 = NULL;
            if($t == 'u'){
                $model2 = $_Danhmuc::find() 
                        ->andWhere([Aabc::$app->_danhmuc->dm_idcha => $model[Aabc::$app->_danhmuc->dm_idcha]])
                        ->andWhere(['<' , Aabc::$app->_danhmuc->dm_thutu , $model[Aabc::$app->_danhmuc->dm_thutu]])
                        ->andWhere([Aabc::$app->_danhmuc->dm_type => $model[Aabc::$app->_danhmuc->dm_type]])
                        ->andWhere([Aabc::$app->_danhmuc->dm_recycle => '2'])
                        ->orderBy([Aabc::$app->_danhmuc->dm_thutu => SORT_DESC])
                        ->one();                
            }else{
                $model2 = $_Danhmuc::find() 
                        ->andWhere([Aabc::$app->_danhmuc->dm_idcha => $model[Aabc::$app->_danhmuc->dm_idcha]])
                        ->andWhere(['>' , Aabc::$app->_danhmuc->dm_thutu , $model[Aabc::$app->_danhmuc->dm_thutu]])
                        ->andWhere([Aabc::$app->_danhmuc->dm_type => $model[Aabc::$app->_danhmuc->dm_type]])
                        ->andWhere([Aabc::$app->_danhmuc->dm_recycle => '2'])
                        ->orderBy([Aabc::$app->_danhmuc->dm_thutu => SORT_ASC])
                        ->one();                
            } 

            $data = 1;
            if(isset($model2)){
                $sothututhaydoi =  $model2[Aabc::$app->_danhmuc->dm_thutu];                
                $model2[Aabc::$app->_danhmuc->dm_thutu] = $model[Aabc::$app->_danhmuc->dm_thutu];
                $model[Aabc::$app->_danhmuc->dm_thutu] = $sothututhaydoi;                

                Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;

                $transaction = \Aabc::$app->db->beginTransaction();
                $data = 0;
                try {
                    if($model->save()){ 
                        if(isset($model2)){
                            $model2->save(); 
                        }    
                        $_SESSION["dem"] = 0 ;

                        $_Danhmuc = $_Danhmuc::find()
                           ->andWhere([Aabc::$app->_danhmuc->dm_recycle => '2'])
                           ->andWhere([Aabc::$app->_danhmuc->dm_type => $model[Aabc::$app->_danhmuc->dm_type]]) 
                           ->orderBy([Aabc::$app->_danhmuc->dm_thutu=>SORT_ASC])
                           ->all();

                        
                        Aabc::$app->MyComponent->sothutudanhmuc($_Danhmuc, $model[Aabc::$app->_danhmuc->dm_type], $model[Aabc::$app->_danhmuc->dm_groupmenu]);

                        $transaction->commit();                 
                        $data = 1;                                
                    }else{
                        Aabc::error($model->errors);
                        $transaction->rollback();
                        $data = 0; 
                    }
                } catch (Exception $e) {            
                    $transaction->rollback();
                    $data = 0;
                }
            }

            return $data;
        } 
        die;
    }



    public function actionRes_cm($id)
    {
        return $this->restore($id,$tp = 2);
    }

    public function actionRes_dm($id)
    {
        return $this->restore($id,$tp = 3);
    }
    public function actionRes_mn($id)
    {
        return $this->restore($id,$tp = 4);
    }
    public function actionRes_tn($id)
    {
        return $this->restore($id,$tp = 5);
    }
    public function actionRes($id) //Restore
    {
        return $this->restore($id,$tp = 1);
    }

    protected function restore($id, $tp) //Restore
    {
        $id = addslashes($id);
        $tp = addslashes($tp);
        //$role = 'backend-danhmuc-restore';
        //if(!Aabc::$app->user->can($role)){ return 'nacc';die;}

        $datajson = 'thatbai'; 
        $model = $this->findModel($id);
        $model[Aabc::$app->_danhmuc->dm_recycle] = '2';

        $_Danhmuc = Aabc::$app->_model->Danhmuc;
        $model2 = $_Danhmuc::find() 
                    ->andWhere([Aabc::$app->_danhmuc->dm_idcha => $model[Aabc::$app->_danhmuc->dm_idcha]])
                    ->andWhere([Aabc::$app->_danhmuc->dm_type => $model[Aabc::$app->_danhmuc->dm_type]]) 
                    ->orderBy([Aabc::$app->_danhmuc->dm_sothutu => SORT_DESC])
                    ->one();
        if(isset($model2)){
            $model[Aabc::$app->_danhmuc->dm_thutu] = (int)$model2[Aabc::$app->_danhmuc->dm_thutu] + 1;
            $model[Aabc::$app->_danhmuc->dm_sothutu] = $model2[Aabc::$app->_danhmuc->dm_sothutu];
        }


        Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;
            return (1 && $model->save());
    }










    public function actionRec_cm($id)
    {
        return $this->recycle($id,$tp = 2);
    }

    public function actionRec_dm($id)
    {
        return $this->recycle($id,$tp = 3);
    }
    public function actionRec_mn($id)
    {
        return $this->recycle($id,$tp = 4);
    }
    public function actionRec_tn($id)
    {
        return $this->recycle($id,$tp = 5);
    }
    public function actionRec($id) //Recycle
    {
        return $this->recycle($id,$tp = 1);
    }
     
    protected function recycle($id, $tp) //Recycle
    {
        $id = addslashes($id);
        $tp = addslashes($tp);
        //$role = 'backend-danhmuc-recycle';
        //if(!Aabc::$app->user->can($role)){ return 'nacc';die;}

        $datajson = 'thatbai'; 
        $model = $this->findModel($id);

        if(empty($model->dm_link)) $model->dm_link = 'link';

        $model['dm_recycle'] = '1';
        
        Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;

        if($model->save()){
            return 1;
        }else{
            Aabc::error($model->errors);
            // print_r($model);
            // print_r($model->errors);
            // die;
            return 0;
        }

    }







    public function actionReca_cm()
    {
        return $this->recycleall($tp = 2);
    }

    public function actionReca_dm()
    {
        return $this->recycleall($tp = 3);
    }
    public function actionReca_mn()
    {
        return $this->recycleall($tp = 4);
    }
    public function actionReca_tn()
    {
        return $this->recycleall($tp = 5);
    }
    public function actionReca() //Recycleall
    {
        return $this->recycleall($tp = 1);
    }

    protected function recycleall($tp) //Recycleall
    {
        $tp = addslashes($tp);
        //$role = 'backend-danhmuc-recycleall';
        //if(!Aabc::$app->user->can($role)){ return 'nacc';die;}

        $data = Aabc::$app->request->post('selects');
        $typ = Aabc::$app->request->post('typ');
        $valu = Aabc::$app->request->post('valu');

        $datajson = 0;

        $transaction = \Aabc::$app->db->beginTransaction();
        try {
                foreach ($data as $key => $value) {                    
                    $model = $this->findModel($value);
                    
                    if($typ == '3'){
                        $model[Aabc::$app->_danhmuc->dm_recycle] = '1';
                    }

                    if($typ == '1' OR $typ == '2'){
                        $model[Aabc::$app->_danhmuc->dm_status] = $valu;
                    } 

                    if($model->save()){                        
                    }else{
                        Aabc::error($model->errors);
                        $transaction->rollback();
                        $datajson = 0;
                        Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;
                        return $datajson;
                    }
                } 
            $transaction->commit();
            $datajson = 1;
        } catch (Exception $e) {            
            $transaction->rollback();
            $datajson = 0;
        }

        Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;
        return $datajson;


    }




    public function actionD_cm($id)
    {
        return $this->delete($id, $tp = 2);
    }

    public function actionD_dm($id)
    {
        return $this->delete($id, $tp = 3);
    }
    public function actionD_mn($id)
    {
        return $this->delete($id, $tp = 4);
    }
    public function actionD_tn($id)
    {
        return $this->delete($id, $tp = 5);
    }
    public function actionD($id) //Delete
    {
        return $this->delete($id, $tp = 1);
    }

    protected function delete($id, $tp) //Delete
    {
        $id = addslashes($id);
        $tp = addslashes($tp);
        //$role = 'backend-danhmuc-delete';
        //if(!Aabc::$app->user->can($role)){ return 'nacc';die;}              
        $model =  $this->findModel($id);   
        
        Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;
        return (1 && ($model[Aabc::$app->_danhmuc->dm_recycle] == '1')  && $model->delete());
        
    }







    public function actionDa_cm()
    {
        return $this->deleteall($tp = 2);
    }

    public function actionDa_dm()
    {
        return $this->deleteall($tp = 3);
    }
    public function actionDa_mn()
    {
        return $this->deleteall($tp = 4);
    }
    public function actionDa_tn()
    {
        return $this->deleteall($tp = 5);
    }
    public function actionDa() //Deleteall
    {
        return $this->deleteall($tp = 1);
    }

    public function deleteall($tp) //Deleteall
    {        
        $tp = addslashes($tp);
        //$role = 'backend-danhmuc-deleteall';
        //if(!Aabc::$app->user->can($role)){ return 'nacc';die;}

        
        Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;
        $_Danhmuc = Aabc::$app->_model->Danhmuc;
        return (1 && ($_Danhmuc::deleteAll([Aabc::$app->_danhmuc->dm_recycle => '1']) ) );
        
    }

    
    protected function findModel($id)
    {
        $_Danhmuc = Aabc::$app->_model->Danhmuc;
        if (($model = $_Danhmuc::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
