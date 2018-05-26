<?php

namespace backend\modules\rbac\controllers;

use Aabc;
use backend\modules\rbac\models\Authitemchild;
use backend\modules\rbac\models\AuthitemchildSearch;
use aabc\web\Controller;
use aabc\web\NotFoundHttpException;
use aabc\filters\VerbFilter;


use aabc\db\Transaction;
use aabc\base\Exception;
use aabc\base\ErrorException;
use aabc\base\ErrorHandler;

use aabc\web\ForbiddenHttpException;
use aabc\filters\AccessControl;


class AuthitemchildController extends Controller
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

        $searchModel = new AuthitemchildSearch();
        $dataProvider = $searchModel->search(Aabc::$app->request->queryParams);

        // $dataProvider->setSort([
        //     'defaultOrder' => ['type'=>SORT_DESC]        
        // ]);

        $dataProvider->pagination->pageSize=$t;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    
    public function actionView($parent, $child)
    {
        return $this->render('view', [
            'model' => $this->findModel($parent, $child),
        ]);
    }

    
    public function actionCreate()
    {
        $model = new Authitemchild();

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
            return $this->redirect(['view', 'parent' => $model->parent, 'child' => $model->child]);
            */
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
        
         return $this->renderAjax('create', [
                'model' => $model,
            ]);
        die;
    }

    
    public function actionUpdate($parent, $child)
    {
        $model = $this->findModel($parent, $child);

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

    
    public function actionDelete($parent, $child)
    {
        $datajson = 'thatbai';

        $transaction = \Aabc::$app->db->beginTransaction();
        try {    
                $this->findModel($parent, $child)->delete();
                
            $transaction->commit();
            $datajson = 'thanhcong';
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
                    $model->save();
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

    
    protected function findModel($parent, $child)
    {
        if (($model = Authitemchild::findOne(['parent' => $parent, 'child' => $child])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
