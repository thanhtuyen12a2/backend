<?php
namespace backend\controllers;
use Aabc;

use backend\models\Cauhinh;
//use backend\models\Cauhinh_fakeSearch;
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


class CauhinhController extends Controller
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
                    'update' => ['POST'], //index                    
                ],
            ],
        ];
    }
     
   
    public function actionCauhinh1()
    {   
        return $this->cauhinh(1);
    }

    public function actionCauhinh2()
    {   
        return $this->cauhinh(2);
    }

    public function actionCauhinh3()
    {   
        return $this->cauhinh(3);
    }

    public function actionCauhinh4()
    {   
        return $this->cauhinh(4);
    }    

    public function actionCauhinh5()
    {   
        return $this->cauhinh(5);
    } 
     public function actionCauhinh6()
    {   
        return $this->cauhinh(6);
    } 
     public function actionCauhinh7()
    {   
        return $this->cauhinh(7);
    } 
     public function actionCauhinh8($p=0)
    {   
        //$p id Page
        return $this->cauhinh(8,$p);
    }
     public function actionCauhinh10($i='')
    {   
        return $this->cauhinh(10,0,$i);
    }

    protected function cauhinh($id = '',$p=0,$i=''){
        // echo $id;
        // die;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {  
            if(isset($_POST[Cauhinh::T])){
                $data = $_POST[Cauhinh::T];  
                $datajson = 0;
                $transaction = \Aabc::$app->db->beginTransaction();             
                try {
                    foreach ($data as $k => $v) {
                        if(!Cauhinh::check_key($k)){///Nếu key đó là bị fake
                            $transaction->rollback();
                            $datajson = 0;
                            return $datajson;
                        }
                        if(!is_array($v)) $v = addslashes($v);                        
                        $model = (Cauhinh::M)::find()->andWhere(['ch_key' => $k])->one();
                        if($model){                            
                        }else{
                            $_Cauhinh = Cauhinh::M;
                            $model = new $_Cauhinh;
                            $model[Cauhinh::ch_key] = $k;                            
                        }
                        $model[Cauhinh::ch_data] = $v;
                        if($model->save()){ 
                             $datajson = 1;                           
                        }else{
                            // print_r($model->errors);
                            $transaction->rollback();
                            $datajson = 0;
                            return $datajson;
                        }
                    } 
                    $transaction->commit();
                    return $datajson;

                } catch (Exception $e) {            
                    $transaction->rollback();
                    $datajson = 0;
                    return $datajson;
                }
            }else{
                $kq = $this->renderAjax('cauhinh'.$id,[
                    'number' => $p,
                    'i' => $i,
                ]);
                $kq = Aabc::$app->d->decodeview($kq);
                return $kq;
            }
        }
        die;
    }

    // public function actionUpdate() //Update
    // {      
    //     $model = $this->findModel($id);

    //     if ($model->load(Aabc::$app->request->post()) ) {            
    //         Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;
    //         return (1 && $model->save());
    //     } 

    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         $kq = $this->renderAjax('update', [
    //             'model' => $model,
    //         ]);
    //         $kq = Aabc::$app->d->decodeview($kq);
    //         return $kq;
    //     }
    //     die;
    // }




    
    protected function findModel($key)
    {        
        return true;
        // if (($model = (Cauhinh::M)::find()->andWhere(['ch_key' => $key])->one() !== null) {
        //     return $model;
        // } else {
        //     throw new NotFoundHttpException('The requested page does not exist.');
        // }
    }
}
