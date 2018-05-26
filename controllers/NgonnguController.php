<?php

namespace backend\controllers;

use Aabc;
use backend\models\Ngonngu;
use backend\models\NgonnguSearch;
use aabc\web\Controller;
use aabc\web\NotFoundHttpException;
use aabc\filters\VerbFilter;


use aabc\db\Transaction;
use aabc\base\Exception;
use aabc\base\ErrorException;
use aabc\base\ErrorHandler;

use aabc\web\ForbiddenHttpException;
use aabc\filters\AccessControl;


class NgonnguController extends Controller
{
    
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                //'only' => ['create'],
                'rules' => [
                    [
                        'allow' => true,
                        //'actions' => ['index','create'],
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action){
                            $control = Aabc::$app->controller->id;
                            $action = Aabc::$app->controller->action->id;
                            $role = 'backend-'.$control . '-' . $action;
                            if(Aabc::$app->user->can($role)){
                                return true;
                            }
                        }
                    ],
                ],
            ],


            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index' => ['POST'], 
                    'delete' => ['POST'],                    
                    'create' => ['GET','POST'],
                    'update' => ['GET','POST'],
                    'updatestatus' => ['GET','POST'],
                    'updatedefault' => ['GET','POST'],
                ],
            ],
        ];
    }

    
    public function actionIndex($t = 20)
    {        
        //$searchModel = new Dskh2Search(
        //    ['tencongty' => 'thanh']
        //);
        $searchModel = new NgonnguSearch();
        $dataProvider = $searchModel->search(Aabc::$app->request->queryParams);
        //$dataProvider->setSort([
        //    'defaultOrder' => ['id'=>SORT_DESC]        
        //]);
        $dataProvider->pagination->pageSize=$t;
        return $this->renderAjax('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    
    public function actionCreate()
    {
        $model = new Ngonngu();
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
            return $this->redirect(['view', 'id' => $model->ngonngu_id]);
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

    public function actionUpdatestatus($id)
    {       
        $model = $this->findModel($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if($model->ngonngu_trangthai == '0'){
                $model->ngonngu_trangthai = '1';
            }else{
                $model->ngonngu_trangthai = '0';
            }
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

    public function actionUpdatedefault($id)
    {   
        $datajson = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = Ngonngu::find()->all();
            $transaction = \Aabc::$app->db->beginTransaction();
            try {
                    foreach ($data as $key => $model) { 
                        if($model->ngonngu_id == $id){
                            $model->ngonngu_macdinh = '1';
                        }else{
                            $model->ngonngu_macdinh = '0';
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
        die;
    }

    
    public function actionDelete($id)
    {
        $datajson = 'thatbai';

        $transaction = \Aabc::$app->db->beginTransaction();
        try {    
                if($this->findModel($id)->delete()){
                     $transaction->commit();
                     $datajson = 'thanhcong';
                }else{
                    $transaction->rollback();
                    $datajson = 'thatbai';
                 } 
        } catch (Exception $e) {            
            $transaction->rollback();
            $datajson = 'thatbai';
        }
        Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;
        return $datajson;
        //$this->findModel($id)->delete();
        //return $this->redirect(['index']);
    }


    
    protected function findModel($id)
    {
        if (($model = Ngonngu::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
