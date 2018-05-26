<?php
namespace backend\controllers;
use Aabc;
// $sstr = Aabc::$app->_model->domain;
//use $sstr;
use backend\models\DomainSearch;
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




class DomainController extends Controller
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
                    'index' => ['POST'],
                    'index2' => ['POST'],
                    'indexrecycle' => ['POST'],
                    'recycle' => ['POST'],                    
                    'restore' => ['POST'],
                    'delete' => ['POST'],
                    'deleteall' => ['POST'],
                    'create' => ['POST'],
                    'create2' => ['GET'],
                    'update' => ['POST'],
                    'updatethutu' => ['POST'],
                    'updatestatus' => ['POST'],                    
                ],
            ],
        ];
    }
    
 

    public function actionIndex2($t = 10)
    {
        //$role = 'backend-domain-index2';
        //if(!Aabc::$app->user->can($role)){ return 'nacc';die;}
   
        // $searchModel = new DomainSearch();
        
        $searchModel = new Aabc::$app->_model->DomainSearch([
            Aabc::$app->domain->dm_recycle => '2',
            Aabc::$app->domain->dm_status => Aabc::$app->request->get(Aabc::$app->domain->dm_status),
            Aabc::$app->domain->dm_chude => Aabc::$app->request->get(Aabc::$app->domain->dm_chude),
            Aabc::$app->domain->dm_tiemnang => Aabc::$app->request->get(Aabc::$app->domain->dm_tiemnang)
            // Aabc::$app->domain->dm_domain => Aabc::$app->request->get(Aabc::$app->domain->dm_domain)
        ]);


        $dataProvider = $searchModel->search(Aabc::$app->request->queryParams);
        // $dataProvider->setSort([
        //    'defaultOrder' => [Aabc::$app->domain-> =>SORT_DESC]        
        // ]);
        $dataProvider->pagination->pageSize=$t;        
        $kq = $this->renderAjax('index2', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        $kq = Aabc::$app->d->decodeview($kq);
        return $kq;
    }

    public function actionApi()
    {   
        $_Domain = Aabc::$app->_model->Domain; 
        // $paramsm andrill_api_key::find()

        $model = $_Domain::find()
       						->andWhere(['=',Aabc::$app->domain->dm_status, '8']) 
       						// ->limit(4000)
                            ->limit(2)
       						->all();
        Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;                              
        return $model;         
        die; 
    }



    public function actionIndex($t = 10)
    {
        //$role = 'backend-domain-index';
        //if(!Aabc::$app->user->can($role)){ return 'nacc';die;}
        $str = Aabc::$app->_model->DomainSearch;  

        $searchModel = new DomainSearch();

        //$searchModel = new DomainSearch(
        //    [Aabc::$app->domain->dm_recycle => '2']
        //);
        $dataProvider = $searchModel->search(Aabc::$app->request->queryParams);
        //$dataProvider->setSort([
        //    'defaultOrder' => ['id'=>SORT_DESC]        
        //]);
        $dataProvider->pagination->pageSize=$t;        
        $kq = $this->renderAjax('index', [        
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        $kq = Aabc::$app->d->decodeview($kq);
        return $kq;
    }


    public function actionIndexrecycle()
    {
        //$role = 'backend-domain-indexrecycle';
        //if(!Aabc::$app->user->can($role)){ return 'nacc';die;}

        
        $searchModel = new DomainSearch(
            [Aabc::$app->domain->dm_recycle => '1']
        );
        
        $dataProvider = $searchModel->search(Aabc::$app->request->queryParams);
        
        $kq = $this->renderAjax('indexrecycle', [        
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        $kq = Aabc::$app->d->decodeview($kq);
        return $kq;
    }

    
    public function actionView($d)
    {       
        $_Domain = Aabc::$app->_model->Domain;
        $model = $_Domain::find()->andWhere([Aabc::$app->domain->dm_domain => $d])->count();
        if ($model > 0)  {            
            $data = 'thanhcong';                    
        }else{
            $data = 'thatbai'; 
        }        
        return $data;         
        die;        
    }

    public function actionGetdep()
    {        
        $_Domain = Aabc::$app->_model->Domain;
        $model = $_Domain::find()
                        ->andWhere(['=',Aabc::$app->domain->dm_status, '5'])                        
                        ->one();
        if ($model)  {  
            // if($model[Aabc::$app->domain->dm_chude] == ''){
                $data = $model[Aabc::$app->domain->dm_domain];                
            // }else{
                // $data = '';
            // }            
        }else{
            $data = ''; 
        }        
        return $data;         
        die;        
    }
    public function actionUpdateok($u)    
    {   
        $_Domain = Aabc::$app->_model->Domain;
        $model = $_Domain::find()
        			->andWhere(['=',Aabc::$app->domain->dm_domain, $u])                        
                     ->one();
        $model[Aabc::$app->domain->dm_status] = '7';
        $model[Aabc::$app->domain->dm_timedownload] = date('Y-m-d H:i:s');;

        
        Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;
        return (1 && $model->save());        
        die;
    }






    public function actionChecktitle($id)
    {        
        $_Domain = Aabc::$app->_model->Domain;
        $model = $_Domain::find()
                        ->andWhere([Aabc::$app->domain->dm_id => $id])                        
                        // ->andWhere(['!=', Aabc::$app->domain->dm_chude, ''])                        
                        ->andWhere(['!=',Aabc::$app->domain->dm_status, '1'])
                        ->andWhere(['!=',Aabc::$app->domain->dm_status, '2'])
                        ->andWhere(['!=',Aabc::$app->domain->dm_status, '8'])
                        ->one();

        if ($model)  {  
            // if($model[Aabc::$app->domain->dm_chude] == ''){
                $data = $model[Aabc::$app->domain->dm_domain];                
            // }else{
                // $data = '';
            // }            
        }else{
            $data = ''; 
        }        
        return $data;         
        die;        
    }

    
     public function actionCreate2($d = '', $l = '', $s = '' , $e = '')
    {
        
        $model = new Domain();
        if (isset($_GET['d'])) {
            $model[Aabc::$app->domain->dm_domain] = $d;
            $model[Aabc::$app->domain->dm_length] = $l;
            $model[Aabc::$app->domain->dm_status] = $s;
            $model[Aabc::$app->domain->dm_email] = $e;


            $model[Aabc::$app->domain->dm_recycle] = '2';

            $model[Aabc::$app->domain->dm_tiemnang] = '1';

            if($model->save()){                    
                $data = 'thanhcong';                    
            }else{
                $data = 'thatbai'; 
            }
            // Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;
            return $data;           
        }        
        die;
    }


    public function actionUpdate2($id , $l = '', $s = '', $c = '', $code = '')
    {        
        $model = $this->findModel($id);
        if (isset($_GET['id'])) {            
            $model[Aabc::$app->domain->dm_length] = $l;
            $model[Aabc::$app->domain->dm_status] = $s;

            if ($model[Aabc::$app->domain->dm_chude] == '') {
                $model[Aabc::$app->domain->dm_chude] = $c;
            }
            $model[Aabc::$app->domain->dm_source] = $code;

            $model[Aabc::$app->domain->dm_recycle] = '2';
            $model[Aabc::$app->domain->dm_tiemnang] = '1';
            if($model->save()){                    
                $data = 'thanhcong';
            }else{
                $data = 'thatbai';
            }
            return $data;
        }
        die;
    }



    public function actionCreate()
    {
        //$role = 'backend-domain-create';
        //if(!Aabc::$app->user->can($role)){ return 'nacc';die;}
        $_Domain = Aabc::$app->_model->Domain;
        $model = new $_Domain();

        //if(Aabc::$app->request->isAjax && $model->load(Aabc::$app->request->post())){
        //    Aabc::$app->response->format = 'json';
        //    return ActiveForm::validate($model);
        //    die;
        //}
        $model[Aabc::$app->domain->dm_recycle] = '2';

        if ($model->load(Aabc::$app->request->post())) {
            /* Json */
            Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;
            return (1 && $model->save());
            
            /* Binh thuong */
            /*
            $model->save();
            return $this->redirect(['view', 'id' => $model[Aabc::$app->->dm_id]]);
            */
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $kq = $this->renderAjax('create', [
                'model' => $model,
            ]);
            $kq = Aabc::$app->d->decodeview($kq);
            return $kq;
        }
        die;
    }

    
    public function actionUpdate($id)
    {
        //$role = 'backend-domain-update';
        //if(!Aabc::$app->user->can($role)){ return 'nacc';die;}

        $model = $this->findModel($id);

        if ($model->load(Aabc::$app->request->post()) ) {            
            /* Json */
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



    public function actionUpdatestatus($id,$s)
    {       
        //$role = 'backend-domain-updatestatus';
        //if(!Aabc::$app->user->can($role)){ return 'nacc';die;}
        $model = $this->findModel($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // if($model[Aabc::$app->domain->dm_status] == '2'){
            $model[Aabc::$app->domain->dm_status] = $s;
            
            // }else{
            //     $model[Aabc::$app->domain->dm_status] = '2';
            // }
            
            /* Json */
            Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;
            return (1 && $model->save());
        } 
        die;
    }







    
     public function actionRestore($id)
    {
        //$role = 'backend-domain-restore';
        //if(!Aabc::$app->user->can($role)){ return 'nacc';die;}

        $datajson = 'thatbai'; 
        $model = $this->findModel($id);
        $model[Aabc::$app->domain->dm_recycle] = '2';
        
        /* Json */
            Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;
            return (1 && $model->save());
    }


     
    public function actionRecycle($id)
    {
        //$role = 'backend-domain-recycle';
        //if(!Aabc::$app->user->can($role)){ return 'nacc';die;}

        $datajson = 'thatbai'; 
        $model = $this->findModel($id);
        $model[Aabc::$app->domain->dm_recycle] = '1';
        
        /* Json */
            Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;
            return (1 && $model->save());
    }

     public function actionRecycleall()
    {
        //$role = 'backend-domain-recycleall';
        //if(!Aabc::$app->user->can($role)){ return 'nacc';die;}

        $data = Aabc::$app->request->post('selects');
        $typ = Aabc::$app->request->post('typ');
        $valu = Aabc::$app->request->post('valu');

        $datajson = '';

        $transaction = \Aabc::$app->db->beginTransaction();
        try {
                foreach ($data as $key => $value) {                    
                    $model = $this->findModel($value);
                    
                    if($typ == '9'){
                        $model[Aabc::$app->domain->dm_recycle] = '1';
                    }

                    if($typ >= '1' AND $typ <= '8'){
                        $model[Aabc::$app->domain->dm_status] = $typ;
                    } 

                    if($model->save()){                        
                    }else{
                        $transaction->rollback();
                        $datajson = '';
                        Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;
                        return $datajson;
                    }
                } 
            $transaction->commit();
            $datajson = 1;
        } catch (Exception $e) {            
            $transaction->rollback();
            $datajson = '';
        }

        Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;
        return $datajson;


    }



    public function actionDelete($id)
    {
        //$role = 'backend-domain-delete';
        //if(!Aabc::$app->user->can($role)){ return 'nacc';die;}
        
        $model =  $this->findModel($id);   
       
       /* Json */
            Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;
            return (1 && ($model[Aabc::$app->domain->dm_recycle] == '1')  && $model->delete());
    }


    public function actionDeleteall()
    {        
        //$role = 'backend-domain-deleteall';
        //if(!Aabc::$app->user->can($role)){ return 'nacc';die;}

        /* Json */
        Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;
        $_Domain = Aabc::$app->_model->Domain;
        return (1 && $_Domain::deleteAll([Aabc::$app->domain->dm_recycle => '1'])) ;
    }

    
    protected function findModel($id)
    {
        $_Domain = Aabc::$app->_model->Domain;
        if (($model = $_Domain::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}


 $_domain = 'backend\models\Domain';