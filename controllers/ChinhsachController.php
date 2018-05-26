<?php
namespace backend\controllers;
use Aabc;

//use backend\models\Chinhsach;
//use backend\models\ChinhsachSearch;
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


class ChinhsachController extends Controller
{
    public function behaviors()
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
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
                    'i' => ['POST'], //index
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
                    'pja' => ['POST'], //Pjax element all
                ],
            ],
        ];
    }
    
    
    

    public function actionI_km($t = 10){
        return $this->index($t, $tp = 1);
    } 
    public function actionI_bh($t = 10){
        return $this->index($t, $tp = 2);
    }
    public function actionI_gh($t = 10){
        return $this->index($t, $tp = 3);
    }  

    protected function index($t,$tp)
    {
        //$role = 'backend-chinhsach-index2';
        //if(!Aabc::$app->user->can($role)){ return 'nacc';die;}   

        $_ChinhsachSearch = Aabc::$app->_model->ChinhsachSearch;
        // $searchModel = new $_ChinhsachSearch();

        $searchModel = new $_ChinhsachSearch([
            Aabc::$app->_chinhsach->cs_recycle => '2',
            Aabc::$app->_chinhsach->cs_type => $tp,
        ]);
        $dataProvider = $searchModel->search(Aabc::$app->request->queryParams);
        //$dataProvider->setSort([
        //    'defaultOrder' => ['id'=>SORT_DESC]        
        //]);
        $dataProvider->pagination->pageSize=$t;        
        $kq = $this->renderAjax('index'.$tp, [        
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        $kq = Aabc::$app->d->decodeview($kq);
            return $kq;
    }





    public function actionIp_km($t = 10)
    {
        return $this->indexpopup($t,$tp = 1);
    }
    public function actionIp_bh($t = 10)
    {
        return $this->indexpopup($t,$tp = 2);
    }
    public function actionIp_gh($t = 10)
    {
        return $this->indexpopup($t,$tp = 3);
    }
    protected function indexpopup($t = 10,$tp)
    {
        //$role = 'backend-chinhsach-index';
        //if(!Aabc::$app->user->can($role)){ return 'nacc';die;}
   
        $_ChinhsachSearch = Aabc::$app->_model->ChinhsachSearch;
        // $searchModel = new $_ChinhsachSearch();

        $searchModel = new $_ChinhsachSearch(
           [Aabc::$app->_chinhsach->cs_recycle => '2']
        );
        $dataProvider = $searchModel->search(Aabc::$app->request->queryParams);
        //$dataProvider->setSort([
        //    'defaultOrder' => ['id'=>SORT_DESC]        
        //]);
        $dataProvider->pagination->pageSize=$t;        
        $kq = $this->renderAjax('indexpopup'.$tp, [        
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        $kq = Aabc::$app->d->decodeview($kq);
            return $kq;
    }



    public function actionIr() //Indexrecycle
    {
        return $this->indexrecycle($tp = 1);
    }
    public function actionIr_km() //Indexrecycle
    {
        return $this->indexrecycle($tp = 1);
    }
    public function actionIr_bh() //Indexrecycle
    {
        return $this->indexrecycle($tp = 2);
    }
    public function actionIr_gh() //Indexrecycle
    {
        return $this->indexrecycle($tp = 3);
    }

    protected function indexrecycle($tp) //Indexrecycle
    {
        //$role = 'backend-chinhsach-indexrecycle';
        //if(!Aabc::$app->user->can($role)){ return 'nacc';die;}

        
        $_ChinhsachSearch = Aabc::$app->_model->ChinhsachSearch;
        $searchModel = new $_ChinhsachSearch(
            [Aabc::$app->_chinhsach->cs_recycle => '1']
        );
        
        $dataProvider = $searchModel->search(Aabc::$app->request->queryParams);
        
        $kq = $this->renderAjax('indexrecycle'.$tp, [        
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        $kq = Aabc::$app->d->decodeview($kq);
            return $kq;
    }








    public function actionPja_km()
    {
        return $this->pjax($tp = 1);
    }
    public function actionPja_bh()
    {
        return $this->pjax($tp = 2);
    }
    public function actionPja_gh()
    {
        return $this->pjax($tp = 3);
    }
    protected function pjax($tp)
    {       
        $_Chinhsach = Aabc::$app->_model->Chinhsach;
        $model = new $_Chinhsach();
        if($tp == 1){
            $model = $model->getAll1_1();
        }elseif ($tp == 2) {
            $model = $model->getAll1_2();
        }elseif ($tp == 3) {
            $model = $model->getAll1_3();
        }

        Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;
        // $kq = serialize($kq);
        if(isset($model)){
            $kq = '';
            foreach ($model as $key => $value) {
                 $kq .= $value[Aabc::$app->_chinhsach->cs_id] .'@abcd#'. $value[Aabc::$app->_chinhsach->cs_ten] . '@aabc#';
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

    public function actionC_km() //Create
    {
        return $this->create($tp = 1);
    }     
    public function actionC_bh() //Create
    {
        return $this->create($tp = 2);
    }     
    public function actionC_gh() //Create
    {
        return $this->create($tp = 3);
    }     

    protected function create($tp) //Create
    {
        //$role = 'backend-chinhsach-create';
        //if(!Aabc::$app->user->can($role)){ return 'nacc';die;}

        $_Chinhsach = Aabc::$app->_model->Chinhsach;
        $_Danhmucchinhsach = Aabc::$app->_model->Danhmucchinhsach;
        $_Sanphamchinhsach = Aabc::$app->_model->Sanphamchinhsach;

        $model = new $_Chinhsach();  
        $datajson = 0;
        if ($model->load(Aabc::$app->request->post())) {   

            $model[Aabc::$app->_chinhsach->cs_recycle] = '2';
            $model[Aabc::$app->_chinhsach->cs_status] = '1';
            $model[Aabc::$app->_chinhsach->cs_type] = (string)$tp;



            $arr_cs_id_danhmuc = NULL;
            if($model[Aabc::$app->_chinhsach->cs_apdungcho] == 2){
                if( is_array($model[Aabc::$app->_chinhsach->cs_id_danhmuc])){
                    $arr_cs_id_danhmuc = array_unique($model[Aabc::$app->_chinhsach->cs_id_danhmuc]); 
                }
            }

            $arr_cs_id_sp = NULL;
            if($model[Aabc::$app->_chinhsach->cs_apdungcho] == 3){
                if( is_array($model[Aabc::$app->_chinhsach->cs_id_sp])){
                    $arr_cs_id_sp = array_unique($model[Aabc::$app->_chinhsach->cs_id_sp]); 
                }
            }
            $transaction = \Aabc::$app->db->beginTransaction();
            try {
                $model[Aabc::$app->_chinhsach->cs_id_danhmuc] = null;
                $model[Aabc::$app->_chinhsach->cs_id_sp] = null;
                if($model->save()){

                    // Add Chinhsach-n-n-Danhmuc;
                    $countdmcs = $_Danhmucchinhsach::find()
                                        ->andWhere([Aabc::$app->_danhmucchinhsach->dmcs_id_chinhsach => $model[Aabc::$app->_chinhsach->cs_id]])
                                        ->count();
                    if($countdmcs > 0){
                        if($_Danhmucchinhsach::deleteAll([Aabc::$app->_danhmucchinhsach->dmcs_id_chinhsach => $model[Aabc::$app->_chinhsach->cs_id]])){                        
                        }
                        else{
                            $transaction->rollback();                    
                            $datajson = 0;
                        }
                    }
                    if(isset($arr_cs_id_danhmuc)){ 
                        foreach ($arr_cs_id_danhmuc as $key => $value) {                        
                            $dmcs = new $_Danhmucchinhsach();
                            $dmcs[Aabc::$app->_danhmucchinhsach->dmcs_id_chinhsach] = $model[Aabc::$app->_chinhsach->cs_id];
                            $dmcs[Aabc::$app->_danhmucchinhsach->dmcs_id_danhmuc] = $value;

                            if($dmcs->save()){              
                                $datajson = 1;                    
                            }else{
                                $transaction->rollback();                    
                                $datajson = 0; 
                            } 
                        }
                    }
                    




                    // Add Chinhsach-n-n-Danpham;
                    $countspcs = $_Sanphamchinhsach::find()
                                        ->andWhere([Aabc::$app->_sanphamchinhsach->spcs_id_chinhsach => $model[Aabc::$app->_chinhsach->cs_id]])
                                        ->count();
                    if($countspcs > 0){
                        if($_Sanphamchinhsach::deleteAll([Aabc::$app->_sanphamchinhsach->spcs_id_chinhsach => $model[Aabc::$app->_chinhsach->cs_id]])){                        
                        }
                        else{
                            $transaction->rollback();                    
                            $datajson = 0;
                        }
                    }
                    if(isset($arr_cs_id_sp)){ 
                        foreach ($arr_cs_id_sp as $key => $value) {                        
                            $spcs = new $_Sanphamchinhsach();
                            $spcs[Aabc::$app->_sanphamchinhsach->spcs_id_chinhsach] = $model[Aabc::$app->_chinhsach->cs_id];
                            $spcs[Aabc::$app->_sanphamchinhsach->spcs_id_sp] = $value;

                            if($spcs->save()){              
                                $datajson = 1;                    
                            }else{
                                $transaction->rollback();                    
                                $datajson = 0; 
                            } 
                        }
                    }
                    

                
                    $transaction->commit();
                    $datajson = 1;
                }else{
                    // var_dump($model->errors);die;
                    $transaction->rollback();
                    $datajson = 0;
                }                
            } catch (Exception $e) {
                $transaction->rollback();
                $datajson = 0;
            }




            Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;
            // $model->save();
            // var_dump($model->errors);die;
            return $datajson;           
            
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $kq = $this->renderAjax('create'.$tp, [
                'model' => $model,
            ]);
            $kq = Aabc::$app->d->decodeview($kq);
            return $kq;
        }
        die;
    }

    

    public function actionU_km($id) //Update
    {
        return $this->update($id,$tp = 1);
    }
    public function actionU_bh($id) //Update
    {
        return $this->update($id,$tp = 2);
    }
    public function actionU_gh($id) //Update
    {
        return $this->update($id,$tp = 3);
    }

    protected function update($id,$tp) //Update
    {
        //$role = 'backend-chinhsach-update';
        //if(!Aabc::$app->user->can($role)){ return 'nacc';die;}
        $_Danhmucchinhsach = Aabc::$app->_model->Danhmucchinhsach;
        $_Sanphamchinhsach = Aabc::$app->_model->Sanphamchinhsach;

        $model = $this->findModel($id);
        $datajson = 0;
        if ($model->load(Aabc::$app->request->post()) ) {
            
            $arr_cs_id_danhmuc = NULL;
            if($model[Aabc::$app->_chinhsach->cs_apdungcho] == 2){
                if( is_array($model[Aabc::$app->_chinhsach->cs_id_danhmuc])){
                    $arr_cs_id_danhmuc = array_unique($model[Aabc::$app->_chinhsach->cs_id_danhmuc]); 
                }
            }

            $arr_cs_id_sp = NULL;
            if($model[Aabc::$app->_chinhsach->cs_apdungcho] == 3){
                if( is_array($model[Aabc::$app->_chinhsach->cs_id_sp])){
                    $arr_cs_id_sp = array_unique($model[Aabc::$app->_chinhsach->cs_id_sp]); 
                }
            }
            $transaction = \Aabc::$app->db->beginTransaction();
            try {

                // Add Chinhsach-n-n-Danhmuc;
                $countdmcs = $_Danhmucchinhsach::find()
                                    ->andWhere([Aabc::$app->_danhmucchinhsach->dmcs_id_chinhsach => $model[Aabc::$app->_chinhsach->cs_id]])
                                    ->count();
                if($countdmcs > 0){
                    if($_Danhmucchinhsach::deleteAll([Aabc::$app->_danhmucchinhsach->dmcs_id_chinhsach => $model[Aabc::$app->_chinhsach->cs_id]])){                        
                    }
                    else{
                        $transaction->rollback();                    
                        $datajson = 0;
                    }
                }
                if(isset($arr_cs_id_danhmuc)){ 
                    foreach ($arr_cs_id_danhmuc as $key => $value) {                        
                        $dmcs = new $_Danhmucchinhsach();
                        $dmcs[Aabc::$app->_danhmucchinhsach->dmcs_id_chinhsach] = $model[Aabc::$app->_chinhsach->cs_id];
                        $dmcs[Aabc::$app->_danhmucchinhsach->dmcs_id_danhmuc] = $value;

                        if($dmcs->save()){              
                            $datajson = 1;                    
                        }else{
                            $transaction->rollback();                    
                            $datajson = 0; 
                        } 
                    }
                }
                




                // Add Chinhsach-n-n-Danpham;
                $countspcs = $_Sanphamchinhsach::find()
                                    ->andWhere([Aabc::$app->_sanphamchinhsach->spcs_id_chinhsach => $model[Aabc::$app->_chinhsach->cs_id]])
                                    ->count();
                if($countspcs > 0){
                    if($_Sanphamchinhsach::deleteAll([Aabc::$app->_sanphamchinhsach->spcs_id_chinhsach => $model[Aabc::$app->_chinhsach->cs_id]])){                        
                    }
                    else{
                        $transaction->rollback();                    
                        $datajson = 0;
                    }
                }
                if(isset($arr_cs_id_sp)){ 
                    foreach ($arr_cs_id_sp as $key => $value) {                        
                        $spcs = new $_Sanphamchinhsach();
                        $spcs[Aabc::$app->_sanphamchinhsach->spcs_id_chinhsach] = $model[Aabc::$app->_chinhsach->cs_id];
                        $spcs[Aabc::$app->_sanphamchinhsach->spcs_id_sp] = $value;

                        if($spcs->save()){              
                            $datajson = 1;                    
                        }else{
                            $transaction->rollback();                    
                            $datajson = 0; 
                        } 
                    }
                }



                $model[Aabc::$app->_chinhsach->cs_id_sp] = null;
                $model[Aabc::$app->_chinhsach->cs_id_danhmuc] = null;

                if($model->save()){
                    $transaction->commit();
                    $datajson = 1;
                }else{
                    $transaction->rollback();
                    $datajson = 0;
                }                
            } catch (Exception $e) {
                $transaction->rollback();
                $datajson = 0;
            }

            Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;
            return $datajson;

        } 

         if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if($model[Aabc::$app->_chinhsach->cs_apdungcho] == 2){
                $modeldanhmuc = $_Danhmucchinhsach::find()
                                    ->andWhere([Aabc::$app->_danhmucchinhsach->dmcs_id_chinhsach => $id])
                                    ->all(); 
                $datadanhmuc = array_column($modeldanhmuc, Aabc::$app->_danhmucchinhsach->dmcs_id_danhmuc);
                $model[Aabc::$app->_chinhsach->cs_id_danhmuc] = $datadanhmuc;
            }

            if($model[Aabc::$app->_chinhsach->cs_apdungcho] == 3){
                $modelsanpham = $_Sanphamchinhsach::find()
                                    ->andWhere([Aabc::$app->_sanphamchinhsach->spcs_id_chinhsach => $id])
                                    ->all(); 
                $datasanpham = array_column($modelsanpham, Aabc::$app->_sanphamchinhsach->spcs_id_sp);
                $model[Aabc::$app->_chinhsach->cs_id_sp] = $datasanpham;
            }

            $kq = $this->renderAjax('update'.$tp, [
                'model' => $model,
            ]);
            $kq = Aabc::$app->d->decodeview($kq);
            return $kq;
        }
        die;
    }



    public function actionUs_km($id) //Update
    {
        return $this->updatestatus($id,$tp = 1);
    }
    public function actionUs_bh($id) //Update
    {
        return $this->updatestatus($id,$tp = 2);
    }
    public function actionUs_gh($id) //Update
    {
        return $this->updatestatus($id,$tp = 3);
    }


    protected function updatestatus($id,$tp) //Updatestatus
    {       
        //$role = 'backend-chinhsach-updatestatus';
        //if(!Aabc::$app->user->can($role)){ return 'nacc';die;}

        $model = $this->findModel($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if($model[Aabc::$app->_chinhsach->cs_status] == '2'){
                $model[Aabc::$app->_chinhsach->cs_status] = '1';
            }else{
                $model[Aabc::$app->_chinhsach->cs_status] = '2';
            }
             /* Json */
            Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;
            
            // if($model->save()){
            // }
            // print_r($model->errors);
            return (1 && $model->save());
        } 
        die;
    }







    public function actionRes_km($id) //Update
    {
        return $this->retore($id,$tp = 1);
    }
    public function actionRes_bh($id) //Update
    {
        return $this->retore($id,$tp = 2);
    }
    public function actionRes_gh($id) //Update
    {
        return $this->retore($id,$tp = 3);
    }
    
    protected function retore($id,$tp) //Restore
    {
        //$role = 'backend-chinhsach-restore';
        //if(!Aabc::$app->user->can($role)){ return 'nacc';die;}

        $datajson = 0; 
        $model = $this->findModel($id);
        $model[Aabc::$app->_chinhsach->cs_recycle] = '2';
       
        Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;
            return (1 && $model->save());
    }





    public function actionRec_km($id) //Update
    {
        return $this->recycle($id,$tp = 1);
    }
    public function actionRec_bh($id) //Update
    {
        return $this->recycle($id,$tp = 2);
    }
    public function actionRec_gh($id) //Update
    {
        return $this->recycle($id,$tp = 3);
    }

     
    protected function recycle($id,$tp) //Recycle
    {
        //$role = 'backend-chinhsach-recycle';
        //if(!Aabc::$app->user->can($role)){ return 'nacc';die;}

        $datajson = 0; 
        $model = $this->findModel($id);
        $model[Aabc::$app->_chinhsach->cs_recycle] = '1';
        
        Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;
            return (1 && $model->save());
    }




    public function actionReca_km() //Update
    {
        return $this->recycleall($tp = 1);
    }
    public function actionReca_bh() //Update
    {
        return $this->recycleall($tp = 2);
    }
    public function actionReca_gh() //Update
    {
        return $this->recycleall($tp = 3);
    }

     protected function recycleall($tp) //Recycleall
    {
        //$role = 'backend-chinhsach-recycleall';
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
                        $model[Aabc::$app->_chinhsach->cs_recycle] = '1';
                    }

                    if($typ == '1' OR $typ == '2'){
                        $model[Aabc::$app->_chinhsach->cs_status] = $valu;
                    } 

                    if($model->save()){                        
                    }else{
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



    public function actionD_km($id) //Update
    {
        return $this->delete($id,$tp = 1);
    }
    public function actionD_bh($id) //Update
    {
        return $this->delete($id,$tp = 2);
    }
    public function actionD_gh($id) //Update
    {
        return $this->delete($id,$tp = 3);
    }


    protected function delete($id,$tp) //Delete
    {
        //$role = 'backend-chinhsach-delete';
        //if(!Aabc::$app->user->can($role)){ return 'nacc';die;}

              
        $model =  $this->findModel($id);   
        
        Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;
        return (1 && ($model[Aabc::$app->_chinhsach->cs_recycle] == '1')  && $model->delete());
        
    }






    public function actionDa_km() //Update
    {
        return $this->deleteall($tp = 1);
    }
    public function actionDa_bh() //Update
    {
        return $this->deleteall($tp = 2);
    }
    public function actionDa_gh() //Update
    {
        return $this->deleteall($tp = 3);
    }

    protected function deleteall($tp) //Deleteall
    {        
        //$role = 'backend-chinhsach-deleteall';
        //if(!Aabc::$app->user->can($role)){ return 'nacc';die;}
        
        Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;
        $_Chinhsach = Aabc::$app->_model->Chinhsach;
        return (1 && ($_Chinhsach::deleteAll([Aabc::$app->_chinhsach->cs_recycle => '1']) ) );
        
    }

    
    protected function findModel($id)
    {
        $id = addslashes($id);
        $_Chinhsach = Aabc::$app->_model->Chinhsach;
        if (($model = $_Chinhsach::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
