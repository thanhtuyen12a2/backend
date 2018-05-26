<?php

namespace backend\controllers;

use Aabc;
use backend\models\Itemhelp;
use backend\models\ItemhelpSearch;
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


class ItemhelpController extends Controller
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
                    // 'view' => ['POST'],
                    'index' => ['POST'],
                    'indexrecycle' => ['POST'],
                    'recycle' => ['POST'],                    
                    'restore' => ['POST'],
                    'delete' => ['POST'],
                    'deleteall' => ['POST'],
                    'create' => ['POST'],
                    'update' => ['POST'],
                    'updatethutu' => ['POST'],
                    'updatestatus' => ['POST'],                    
                ],
            ],
        ];
    }

    

 







    public function actionIndex($t = 10)
    {
        
        
        $searchModel = new ItemhelpSearch([
            'ih_id_grouphelp' => Aabc::$app->request->get('grouphelp'),
        ]);


        $dataProvider = $searchModel->search(Aabc::$app->request->queryParams);

        $dataProvider->setSort([
           'defaultOrder' => ['ih_sothutu'=>SORT_ASC]        
        ]);

        $dataProvider->pagination->pageSize=$t;
        
        return $this->renderAjax('index', [        
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionIndexrecycle()
    {
        
        $searchModel = new ItemhelpSearch();
        
        $dataProvider = $searchModel->search(Aabc::$app->request->queryParams);
        
        return $this->renderAjax('indexrecycle', [        
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    
    public function actionView($st,$gr)
    {
        // $model = $this->findModel($id);      
        $model = Itemhelp::find()->andWhere(['ih_sothutu' => $st])->andWhere(['ih_id_grouphelp' => $gr])->one();

        // Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;
        $datajson = '';
        if(isset($model)){           
            $datajson = urlencode($model->ih_noidung .'|'. $model->ih_focus .'|'. $model->ih_check .'|'. $model->ih_action .'|'. $model->ih_sothutu  .'|'. $model->ih_id_grouphelp );            
        }        
        return $datajson;  

    }

    


    public function actionCreate()
    {
        $model = new Itemhelp();

        //if(Aabc::$app->request->isAjax && $model->load(Aabc::$app->request->post())){
        //    Aabc::$app->response->format = 'json';
        //    return ActiveForm::validate($model);
        //    die;
        //}

        if ($model->load(Aabc::$app->request->post())) {

            /* Json */
            if($model->save()){                    
                $data = 'thanhcong';                    
            }else{
                $data = 'thatbai'; 
            }
            Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;
            return $data;
           
            
            /* Binh thuong */
            /*
            $model->save();
            return $this->redirect(['view', 'id' => $model->ih_id]);
            */
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
        die;
    }

    
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Aabc::$app->request->post()) ) {
            
             /* Json */
            if($model->save()){                    
                $data = 'thanhcong';                    
            }else{
                $data = 'thatbai'; 
            }
            Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;
            return $data;

        } 

         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }
        die;
    }


    // public function actionUpdatethutu($id,$t)
    // {       
    //     $model = $this->findModel($id);
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         $sothututhaydoi = 0;
    //         if($t == 'u'){
    //             $sothututhaydoi = $model->ih_sothutu - 1;                                 
    //         }else{
    //             $sothututhaydoi = $model->ih_sothutu + 1; 
    //         }       
    //         $modelthaydoi = Itemhelp::find()->andWhere(['ih_id_grouphelp' => $model->ih_id_grouphelp])->andWhere(['ih_sothutu' => $sothututhaydoi])->one();
    //         if(isset($modelthaydoi)){
    //             $modelthaydoi->ih_sothutu = $model->ih_sothutu;
    //         }
    //         $model->ih_sothutu = $sothututhaydoi;

    //         if($model->save() && $modelthaydoi->save()){                  
    //             $data = 'thanhcong';                    
    //         }else{
    //             $data = 'thatbai'; 
    //         }
    //         Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;

    //         return $data;
    //     } 
    //     die;
    // }

    public function actionUpdatestatus($id)
    {       
        $model = $this->findModel($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          
             /* Json */
            if($model->save()){                    
                $data = 'thanhcong';                    
            }else{
                $data = 'thatbai'; 
            }
            Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;
            return $data;
        } 
        die;
    }







    
     public function actionRestore($id)
    {
        $datajson = 'thatbai'; 
        $model = $this->findModel($id);
        if($model->save()){                    
             $datajson = 'thanhcong';
        }else{                   
            $datajson = 'thatbai';
         }        

        Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;
        return $datajson;
    }


     
    public function actionRecycle($id)
    {
        $datajson = 'thatbai'; 
        $model = $this->findModel($id);
        $model->ih_recycle = '1';
        if($model->save()){                    
             $datajson = 'thanhcong';
        }else{                   
            $datajson = 'thatbai';
         }        

        Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;
        return $datajson;
    }

     public function actionRecycleall()
    {
        $data = Aabc::$app->request->post('selects');
        $typ = Aabc::$app->request->post('typ');
        $valu = Aabc::$app->request->post('valu');

        $datajson = 'thatbai';

        $transaction = \Aabc::$app->db->beginTransaction();
        try {
                foreach ($data as $key => $value) {                    
                    $model = $this->findModel($value);
                    
                    if($typ == '3'){
                        $model->ih_recycle = '1';
                    }

                    if($typ == '1' OR $typ == '2'){
                        $model->ih_status = $valu;
                    } 

                    if($model->save()){                        
                    }else{
                        $transaction->rollback();
                        $datajson = 'thatbai';
                        Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;
                        return $datajson;
                    }
                } 
            $transaction->commit();
            $datajson = 'thanhcong';
        } catch (Exception $e) {            
            $transaction->rollback();
            $datajson = 'thatbai';
        }

        Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;
        return $datajson;


    }



    public function actionDelete($id)
    {
        $datajson = 'thatbai';        
        if($this->findModel($id)->delete()){                    
             $datajson = 'thanhcong';
        }else{                   
            $datajson = 'thatbai';
        }      
        Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;
        return $datajson;
    }


    public function actionDeleteall()
    {        
        $datajson = 'thatbai';
        if( Itemhelp::deleteAll(['ih_recycle' => '1']) ){                        
            $datajson = 'thanhcong';
        }else{                   
            $datajson = 'thatbai';
        }      
        Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;
        return $datajson;
    }

    
    protected function findModel($id)
    {
        if (($model = Itemhelp::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
