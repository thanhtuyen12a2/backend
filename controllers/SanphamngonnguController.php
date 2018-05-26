<?php

namespace backend\controllers;

use Aabc;
use backend\models\Sanphamngonngu;
use backend\models\SanphamngonnguSearch;
use aabc\web\Controller;
use aabc\web\NotFoundHttpException;
use aabc\filters\VerbFilter;


use aabc\db\Transaction;
use aabc\base\Exception;
use aabc\base\ErrorException;
use aabc\base\ErrorHandler;

use aabc\web\ForbiddenHttpException;
use aabc\filters\AccessControl;


class SanphamngonnguController extends Controller
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
                    'delete' => ['POST'],
                    'deleteall' => ['POST'],
                    'create' => ['GET','POST'],
                    'update' => ['GET','POST'],
                ],
            ],
        ];
    }

    
    public function actionIndex($t = 20)
    {
        
        //$searchModel = new Dskh2Search(
        //    ['tencongty' => 'thanh']
        //);

        $searchModel = new SanphamngonnguSearch();
        $dataProvider = $searchModel->search(Aabc::$app->request->queryParams);

        //$dataProvider->setSort([
        //    'defaultOrder' => ['id'=>SORT_DESC]        
        //]);

        $dataProvider->pagination->pageSize=$t;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    
    public function actionView($spnn_idsanpham, $spnn_idngonngu)
    {
        return $this->render('view', [
            'model' => $this->findModel($spnn_idsanpham, $spnn_idngonngu),
        ]);
    }

    
    public function actionCreate()
    {
        $model = new Sanphamngonngu();

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
            return $this->redirect(['view', 'spnn_idsanpham' => $model->spnn_idsanpham, 'spnn_idngonngu' => $model->spnn_idngonngu]);
            */
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
        die;
    }

    
    public function actionUpdate($spnn_idsanpham, $spnn_idngonngu)
    {
        $model = $this->findModel($spnn_idsanpham, $spnn_idngonngu);

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

    
    public function actionDelete($spnn_idsanpham, $spnn_idngonngu)
    {
        $datajson = 'thatbai';

        $transaction = \Aabc::$app->db->beginTransaction();
        try {                           
                $model = $this->findModel($id);
                $model->mst = '-'.$id;
                if($model->save()){
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


    public function actionDeleteall()
    {
        $data = Aabc::$app->request->post('selects');
        $datajson = 'thatbai';

        $transaction = \Aabc::$app->db->beginTransaction();
        try {
                foreach ($data as $key => $value) {                    
                    $model = $this->findModel($value);
                    $model->mst = $key.'-'.$value;
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

    
    protected function findModel($spnn_idsanpham, $spnn_idngonngu)
    {
        if (($model = Sanphamngonngu::findOne(['spnn_idsanpham' => $spnn_idsanpham, 'spnn_idngonngu' => $spnn_idngonngu])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
