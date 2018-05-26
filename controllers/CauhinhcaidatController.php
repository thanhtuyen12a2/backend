<?php
namespace backend\controllers;
use Aabc;

//use backend\models\Cauhinhcaidat;
//use backend\models\CauhinhcaidatSearch;
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


class CauhinhcaidatController extends Controller
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
    
 

   





     public function actionPja()
    {
       
        $_Cauhinhcaidat = Aabc::$app->_model->Cauhinhcaidat;
        $model = new $_Cauhinhcaidat();
        $model = $model->getAll1();

        Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;
        // $kq = serialize($kq);
        if(isset($model)){
            $kq = '';
            foreach ($model as $key => $value) {
                 $kq .= $value[Aabc::$app->_cauhinhcaidat->chcd_id] .'@abcd#'. $value[Aabc::$app->_cauhinhcaidat->chcd_ten] . '@aabc#';
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

    



    
    public function actionU() //Update
    {
        //$role = 'backend-cauhinhcaidat-update';
        //if(!Aabc::$app->user->can($role)){ return 'nacc';die;}

        $model = $this->findModel('1');

        if ($model->load(Aabc::$app->request->post()) ) {
            
            Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;
            return (1 && $model->save());

        } 

         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $kq = $this->renderAjax('update', [
                'model' => $model,
            ]);
            $kq = Aabc::$app->d->decodeview($kq);
            return $kq;
        }
        die;
    }



    public function actionUs($id) //Updatestatus
    {       
        //$role = 'backend-cauhinhcaidat-updatestatus';
        //if(!Aabc::$app->user->can($role)){ return 'nacc';die;}

        $model = $this->findModel($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if($model[Aabc::$app->_cauhinhcaidat->chcd_status] == '2'){
                $model[Aabc::$app->_cauhinhcaidat->chcd_status] = '1';
            }else{
                $model[Aabc::$app->_cauhinhcaidat->chcd_status] = '2';
            }
             /* Json */
            Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;
            return (1 && $model->save());
        } 
        die;
    }







    
     public function actionRes($id) //Restore
    {
        //$role = 'backend-cauhinhcaidat-restore';
        //if(!Aabc::$app->user->can($role)){ return 'nacc';die;}

        $datajson = 'thatbai'; 
        $model = $this->findModel($id);
        $model[Aabc::$app->_cauhinhcaidat->chcd_recycle] = '2';
       
        Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;
            return (1 && $model->save());
    }


     
    public function actionRec($id) //Recycle
    {
        //$role = 'backend-cauhinhcaidat-recycle';
        //if(!Aabc::$app->user->can($role)){ return 'nacc';die;}

        $datajson = 'thatbai'; 
        $model = $this->findModel($id);
        $model[Aabc::$app->_cauhinhcaidat->chcd_recycle] = '1';
        
        Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;
            return (1 && $model->save());
    }

     public function actionReca() //Recycleall
    {
        //$role = 'backend-cauhinhcaidat-recycleall';
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
                        $model[Aabc::$app->_cauhinhcaidat->chcd_recycle] = '1';
                    }

                    if($typ == '1' OR $typ == '2'){
                        $model[Aabc::$app->_cauhinhcaidat->chcd_status] = $valu;
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



    public function actionD($id) //Delete
    {
        //$role = 'backend-cauhinhcaidat-delete';
        //if(!Aabc::$app->user->can($role)){ return 'nacc';die;}

              
        $model =  $this->findModel($id);   
        
        Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;
        return (1 && ($model[Aabc::$app->_cauhinhcaidat->chcd_recycle] == '1')  && $model->delete());
        
    }


    public function actionDa() //Deleteall
    {        
        //$role = 'backend-cauhinhcaidat-deleteall';
        //if(!Aabc::$app->user->can($role)){ return 'nacc';die;}

        
        Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;
        $_Cauhinhcaidat = Aabc::$app->_model->Cauhinhcaidat;
        return (1 && ($_Cauhinhcaidat::deleteAll([Aabc::$app->_cauhinhcaidat->chcd_recycle => '1']) ) );
        
    }

    
    protected function findModel($id)
    {
        $_Cauhinhcaidat = Aabc::$app->_model->Cauhinhcaidat;
        if (($model = $_Cauhinhcaidat::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
