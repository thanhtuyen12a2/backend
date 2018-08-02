<?php
namespace backend\controllers;
use Aabc;

use backend\models\Cauhinh;
use backend\models\Danhmuc;
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
     
    public function actionModuleclone()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {  
            if(isset($_POST['from']) && isset($_POST['to'])){
                $from = (int)$_POST['from'];
                $to = (int)$_POST['to'];

                if(empty($from) || empty($to)) return 0;

                $transaction = \Aabc::$app->db->beginTransaction();             
                try {            
                    return 0;        
                    Danhmuc::deleteAll(['dm_groupmenu' => $to,'dm_template' => temp]);

                    $model_to_0 = Danhmuc::find()
                                ->where(['and',
                                    ['dm_groupmenu' => $from],
                                    ['dm_template' => temp],
                                    ['dm_level' => 0],                                
                                ])
                                ->all();

                    if($model_to_0){
                        foreach ($model_to_0 as $model_0) {
                            $model_0_new = new Danhmuc();
                            $model_0_new->attributes = $model_0->attributes;
                            $model_0_new->dm_groupmenu = $to;
                            if(!$model_0_new->save(false)){
                                $transaction->rollback();
                                return 0;
                            };
                            // Aabc::error($model_0_new->attributes);
                            $model_to_1 = $model_0->danhmuccon;
                            if($model_to_1){
                                foreach ($model_to_1 as $model_1) {
                                    $model_1_new = new Danhmuc();
                                    $model_1_new->attributes = $model_1->attributes;
                                    $model_1_new->dm_idcha = $model_0_new->dm_id;
                                    $model_1_new->dm_groupmenu = $to;                                    
                                    if(!$model_1_new->save(false)){
                                        $transaction->rollback();
                                        return 0;
                                    };
                                    Aabc::error($model_1_new->attributes);
                                    $model_to_2 = $model_1->danhmuccon;
                                    if($model_to_2){
                                        foreach ($model_to_2 as $model_2) {
                                            $model_2_new = new Danhmuc();
                                            $model_2_new->attributes = $model_2->attributes;
                                            $model_2_new->dm_idcha = $model_1_new->dm_id;
                                            $model_2_new->dm_groupmenu = $to;               
                                            if(!$model_2_new->save(false)){
                                                $transaction->rollback();
                                                return 0;
                                            };
                                            Aabc::error($model_2_new->attributes);
                                        }
                                    }                                    
                                }
                            }                            
                        }
                    }

                    $transaction->commit();
                    return 1;
                }
                catch (Exception $e) {            
                    $transaction->rollback();
                    $datajson = 0;
                    return $datajson;
                }

            }
        }
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

                        if(is_array($v)){
                            Aabc::error(json_encode($v));
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
