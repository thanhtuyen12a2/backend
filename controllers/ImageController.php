<?php
namespace backend\controllers;
use Aabc;

//use backend\models\Image;
//use backend\models\ImageSearch;
use aabc\web\Controller;
use aabc\web\NotFoundHttpException;
use aabc\filters\VerbFilter;
use aabc\helpers\Inflector;

use aabc\data\ArrayDataProvider;

use aabc\db\Transaction;
use aabc\base\Exception;
use aabc\base\ErrorException;
use aabc\base\ErrorHandler;

use common\components\Tuyen;

use aabc\web\ForbiddenHttpException;
use aabc\filters\AccessControl;
//use aabc\widgets\ActiveForm;



class ImageController extends Controller
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

             'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['i','ip','ir','rec','reca','res','d','da','c','u','ut','us','ua','v','ga','gi'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],


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
                    'da' => ['POST'], //delete all
                    'c' => ['POST'], //create
                    'v' => ['POST'], //view
                    'u' => ['POST'], //update
                    'ua' => ['POST'], //updateall
                    'ut' => ['POST'], //updatethutu
                    'us' => ['POST'], //updatestatus
                    'ga' => ['POST','GET'], //Get all image
                ],
            ],
        ];
    }
    
     public function actions()
    {
        return [
            'error' => [
                'class' => 'aabc\web\ErrorAction',
            ],
        ];
    }
    
    

    public function actionI($t = 10)
    {
        //$role = 'backend-image-index2';
        //if(!Aabc::$app->user->can($role)){ return 'nacc';die;}
        $_Up = Aabc::$app->_model->Up;   
        $model = new $_Up();

        if ($model->load(Aabc::$app->request->post())) { 

             // echo '<pre>';
            // print_r($model->imageFiles); die;

            $model[Aabc::$app->_up->imageFiles] = \aabc\web\UploadedFile::getInstances($model, Aabc::$app->_up->imageFiles); 
            // echo $model->imageFiles->width;

            // echo '<pre>';
            // print_r($model->imageFiles); die;
            if (!file_exists('../uploads/')) {
                mkdir('../uploads/', 0777, true);
            }
            if($model->validate()) { 
                foreach ($model[Aabc::$app->_up->imageFiles] as $file) {
                    $modelimage = new Aabc::$app->_model->Image();

                    $filename = $file->baseName;
                    $filename = Inflector::slug($filename);
                    
                    $filename = strtolower($filename);
                    $morong = '.'. $file->extension;
                    if(strlen($filename) > 30){
                        $filename = substr($filename,0, 30);
                    }
                    
                    $link = '/uploads/';

                    $modelimage[Aabc::$app->_image->image_tenfile] = $filename;
                    $modelimage[Aabc::$app->_image->image_morong] = $morong;
                    $modelimage[Aabc::$app->_image->image_link] = $link;
                    $modelimage[Aabc::$app->_image->image_recycle] = '2';
                    $modelimage[Aabc::$app->_image->image_status] = '1';
                    // $modelimage[Aabc::$app->_image->image_byte] = intval(intval($file->size)/1024);
                    
                    // echo '<pre>';
                    // print_r($modelimage); die;                   
                    $modelimage->save();                    

                    $filename = $filename . '-' .$modelimage[Aabc::$app->_image->image_id];
                    $file->saveAs('..'. $link . $filename . $morong);

                    //Nen anh
                        $path = '..'. $link . $filename . $morong;
                        $savelink = $path;                        
                        $info = getimagesize($path);
                        $size = array($info[0], $info[1]);  
                        if ($info['mime'] == 'image/png') {
                            $src = ImageCreateFromPNG($path);       
                        } 
                        if ($info['mime'] == 'image/jpeg') {
                            $src = ImageCreateFromJPEG($path);      
                        }
                        if ($info['mime'] == 'image/gif') {
                            $src = ImageCreateFromGIF($path);       
                        }   
                        $width = (int)$info[0];
                        $height = (int)$info[1];

                        // echo $width;die;

                        //Resize nếu width > 900
                        if($width > 768){
                            $height = (int)(768 * $height / $width);
                            $width = 768;
                        }

                        if($height > 768){
                            $width = (int)(768 * $width / $height);
                            $height = 768;
                        }


                        $thumb = imagecreatetruecolor($width, $height);
                        $src_aspect = $size[0] / $size[1];
                        $thumb_aspect = $width / $height;
                        if ($src_aspect < $thumb_aspect) {
                            $scale = $width / $size[0];
                            $new_size = array($width, $width / $src_aspect);
                            $src_post = array(0, ($size[1] * $scale - $height) / $scale / 2);
                        } else if ($src_aspect > $thumb_aspect) {
                            $scale = $width / $size[1];
                            $new_size = array($height * $src_aspect, $height);
                            $src_post = array(($size[0] * $scale - $width) / $scale / 2, 0);
                        } else {
                            $new_size = array($width, $height);
                            $src_post = array(0, 0);
                        }
                        $new_size[0] = max($new_size[0], 1);
                        $new_size[1] = max($new_size[1], 1);
                        $transparent = imagecolorallocate($thumb,255,255,255);
                        imagecolortransparent($thumb,$transparent);
                        imagefilledrectangle($thumb,0,0,4000,4000,$transparent);
                        imagecopyresampled($thumb, $src, 0, 0, $src_post[0], $src_post[1], $new_size[0], $new_size[1], $size[0], $size[1]);                        
                        if ($info['mime'] == 'image/png') {
                            imagepng($thumb, $savelink); 
                        }else{
                            imagejpeg($thumb, $savelink);    
                        }  
                    //End- Nen anh

                    $dungluong = filesize($path);
                    $modelimage[Aabc::$app->_image->image_size] =  $width .'x'.$height;
                    $modelimage[Aabc::$app->_image->image_byte] =  intval(intval($dungluong)/1024);
                    $modelimage->save();
                }
                return '1';
            } else {
                // print_r($model->getErrors());
                // die;
                return '0';
                // return $this->render('up', ['model' => $model]);
            }
        }


        $_ImageSearch = Aabc::$app->_model->ImageSearch;
        // $searchModel = new $_ImageSearch();

        $searchModel = new $_ImageSearch(
           [Aabc::$app->_image->image_recycle => '2']
        );
        $dataProvider = $searchModel->search(Aabc::$app->request->queryParams);
        $dataProvider->setSort([
           'defaultOrder' => [Aabc::$app->_image->image_id=>SORT_DESC]        
        ]);
        $dataProvider->pagination->pageSize=$t;        
        $kq = $this->renderAjax('index', [ 
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        $kq = Aabc::$app->d->decodeview($kq);
            return $kq;
    }

    //Get
    public function actionGi($t = 300,$i = "", $s = '',$e = 'editable') //$e: element update ảnh sau chọn
    {
        $data = Tuyen::_list_icon();
          
       
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
        // // die;

        $kq = $this->renderAjax('indexicon', [              
            'data' => $data,
            'element' => $e,
        ]);
              

        $kq = Aabc::$app->d->decodeview($kq);
        return $kq;
    }


    public function actionGa($t = 30,$i = "", $s = '',$e = 'editable') //$e: element update ảnh sau chọn
    {
        $s = addslashes($s);
        $s = Inflector::slug($s);

        $_Image = Aabc::$app->_model->Image;
        $modelimg = new $_Image();
        $count = count($modelimg->getAllRecycle0());

        $_Up = Aabc::$app->_model->Up;
        $model = new $_Up();        


        $_ImageSearch = Aabc::$app->_model->ImageSearch;
        // $searchModel = new $_ImageSearch();
        $searchModel = new $_ImageSearch([
            Aabc::$app->_image->image_recycle => '2',
            'image_tenfile' => $s,
        ]);
        $dataProvider = $searchModel->search(Aabc::$app->request->queryParams);
        $dataProvider->setSort([
           'defaultOrder' => [Aabc::$app->_image->image_id=>SORT_DESC]        
        ]);
        $dataProvider->pagination->pageSize=$t;     
        // $kq = "";
        if($i == ''){
            $kq = $this->renderAjax('indexinsert', [  
                'count' => $count,
                'model' => $model,                
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'element' => $e,
            ]);
        }else{
            $kq = $this->renderAjax('indexinsert', [  
                'count' => $count,
                'model' => $model,
                'icon' => 'icon',
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'element' => $e,
            ]);
        }
        //     $model = new \backend\models\Up();
        //     $kq = $this->renderAjax('indexpopup', [  
        //         'model' => $model,                
        //     ]);
        // }



        $kq = Aabc::$app->d->decodeview($kq);
        return $kq;
    }



    public function actionIp($t = 10)
    {
        
    }


    public function actionIr() //Indexrecycle
    {
        //$role = 'backend-image-indexrecycle';
        //if(!Aabc::$app->user->can($role)){ return 'nacc';die;}

        
        $_ImageSearch = Aabc::$app->_model->ImageSearch;
        $searchModel = new $_ImageSearch(
            [Aabc::$app->_image->image_recycle => '1']
        );
        
        $dataProvider = $searchModel->search(Aabc::$app->request->queryParams);
        
        $kq = $this->renderAjax('indexrecycle', [        
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        $kq = Aabc::$app->d->decodeview($kq);
            return $kq;
    }

    
    //public function actionView($id)
    //{
    //    die;
    //    return $this->render('view', [
    //        'model' => $this->findModel($id),
    //    ]);
    //}

    


    public function actionC() //Create
    {
        //$role = 'backend-image-create';
        //if(!Aabc::$app->user->can($role)){ return 'nacc';die;}

        $_Image = Aabc::$app->_model->Image;
        $model = new $_Image();                        
        //if(Aabc::$app->request->isAjax && $model->load(Aabc::$app->request->post())){
        //    Aabc::$app->response->format = 'json';
        //    return ActiveForm::validate($model);
        //    die;
        //}
        if ($model->load(Aabc::$app->request->post()) && Aabc::$app->request->isPost) {          
            // Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;
            
            $model[Aabc::$app->_up->imageFiles] = \aabc\web\UploadedFile::getInstances($model, Aabc::$app->_up->imageFiles);

            return (1 && $model->save()); 

            // echo '<pre>';
            // print_r($model->imageFiles); die;

            // if($model->validate()){
            //     return '123';
            // }else{
            //     return 'no';
            // }

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


    public function actionU($id) //Update ten 1 anh
    {
        //$role = 'backend-image-update';
        //if(!Aabc::$app->user->can($role)){ return 'nacc';die;}
        Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;
        $model = $this->findModel($id);
        $tencu = $model[Aabc::$app->_image->image_tenfile];

        if ($model->load(Aabc::$app->request->post()) ) {    
            $model[Aabc::$app->_image->image_tenfile] = strtolower($model[Aabc::$app->_image->image_tenfile]);
            $tenmoi = $model[Aabc::$app->_image->image_tenfile];

            $vitricu = '..'.$model[Aabc::$app->_image->image_link] . $tencu . '-' . $model[Aabc::$app->_image->image_id] . $model[Aabc::$app->_image->image_morong];
            $vitrimoi = '..'.$model[Aabc::$app->_image->image_link]. $tenmoi . '-' . $model[Aabc::$app->_image->image_id] . $model[Aabc::$app->_image->image_morong];

            if (file_exists($vitricu)) {                
                rename($vitricu, $vitrimoi);
                if($model->save()){
                    $l1 = '..'.$model[Aabc::$app->_image->image_link];
                    $l2 = $tencu . '-' . $model[Aabc::$app->_image->image_id] . $model[Aabc::$app->_image->image_morong];                        
                    $this->deletethumb($l1,$l2);
                    return 1;
                }
            }  
            return 0;    
        } 

         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $kq = $this->renderAjax('update', [
                'model' => $model,
            ]);
            $kq = Aabc::$app->d->decodeview($kq);
            return $kq;
        }
        return 0; 
    }


    public function actionV($id,$ro = '') //Update
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = $this->findModel($id);
            if(!isset($model)) return 0;
            if (isset($model)) {  
                $rotate = Aabc::$app->request->get('ro');
                if($rotate == '1' OR $rotate == '3'){
                    $rotate = (int)(90 * $rotate);

                    $path = '..'.$model[Aabc::$app->_image->image_link] . $model[Aabc::$app->_image->image_tenfile] . '-' . $model[Aabc::$app->_image->image_id] . $model[Aabc::$app->_image->image_morong];
                    
                    if (file_exists($path)) {                
                        $info = getimagesize($path);                          
                        if ($info['mime'] == 'image/png') {
                            $src = ImageCreateFromPNG($path); 
                            $saverotate = imagerotate($src, $rotate, 0);
                            imagepng($saverotate,$path);
                        } 
                        if ($info['mime'] == 'image/jpeg') {
                            $src = ImageCreateFromJPEG($path);   
                            $saverotate = imagerotate($src, $rotate, 0);
                            imagejpeg($saverotate,$path);   
                        }
                        if ($info['mime'] == 'image/gif') {
                            $src = ImageCreateFromGIF($path); 
                            $saverotate = imagerotate($src, $rotate, 0);
                            imagejpeg($saverotate,$path);      
                        } 
                        imagedestroy($src);
                        imagedestroy($saverotate);
                        // return (1 && $model->save());

                        $model[Aabc::$app->_image->image_size] =  $info[1] .'x'.$info[0];
                        $model->save();

                        $l1 = '..'.$model[Aabc::$app->_image->image_link];
                        $l2 = $model[Aabc::$app->_image->image_tenfile] . '-' . $model[Aabc::$app->_image->image_id] . $model[Aabc::$app->_image->image_morong];
                        $this->deletethumb($l1,$l2);
                    } 
                    // echo $path;
                    // die;
                }                
                
                $model = $this->findModel($id);
                $kq = $this->renderAjax('view', [
                    'model' => $model,
                ]);
                $kq = Aabc::$app->d->decodeview($kq);
                return $kq;
            }            
        }
        return 0;
    }

    protected function deletethumb($link,$img)
    {
        require('../thumb/size.php');        
        foreach ($size as $key => $value) {            
            $full = $link.$value[0].'/'.$value[1].'/'.$img;
            if (file_exists($full)) {   
                unlink($full);
            }
        }        
    }
    protected function deleteimage($link,$img)
    {        
        $full = $link.$img;
        if (file_exists($full)) {   
            unlink($full);
        }              
    }


    public function actionUa() //Update ten all cac anh 
    {
        $model = new Aabc::$app->_model->Image();
        if ($model->load(Aabc::$app->request->post()) ) {    
            $data = Aabc::$app->request->post('selectsimg');
                       
            foreach ($data as $key => $value) {                    
                $modelcu = $this->findModel($value);
                $tencu = $modelcu[Aabc::$app->_image->image_tenfile];

                $modelcu[Aabc::$app->_image->image_tenfile] = strtolower($model[Aabc::$app->_image->image_tenfile]);

                $tenmoi = $modelcu[Aabc::$app->_image->image_tenfile];

                $vitricu = '..'.$modelcu[Aabc::$app->_image->image_link] . $tencu . '-' . $modelcu[Aabc::$app->_image->image_id] . $modelcu[Aabc::$app->_image->image_morong];
                $vitrimoi = '..'.$modelcu[Aabc::$app->_image->image_link]. $tenmoi . '-' . $modelcu[Aabc::$app->_image->image_id] . $modelcu[Aabc::$app->_image->image_morong];

                if (file_exists($vitricu)) {                
                    rename($vitricu, $vitrimoi);
                    if($modelcu->save()){
                        $l1 = '..'.$modelcu[Aabc::$app->_image->image_link];
                        $l2 = $tencu . '-' . $modelcu[Aabc::$app->_image->image_id] . $modelcu[Aabc::$app->_image->image_morong];                        
                        $this->deletethumb($l1,$l2);
                    }
                }               
            } 
            return '1';
                 
        }else{            
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $data = Aabc::$app->request->post('selects');

                // print_r($data);die;

                $kq = $this->renderAjax('update', [
                    'model' => $model,
                    'data' => $data,
                ]);
                $kq = Aabc::$app->d->decodeview($kq);
                return $kq;
            }
        }
        //$role = 'backend-image-recycleall';
        //if(!Aabc::$app->user->can($role)){ return 'nacc';die;}
        // $data = Aabc::$app->request->post('selects');
        // $typ = Aabc::$app->request->post('typ');
        // $valu = Aabc::$app->request->post('valu');
        
    }




    public function actionUs($id) //Updatestatus
    {       
        //$role = 'backend-image-updatestatus';
        //if(!Aabc::$app->user->can($role)){ return 'nacc';die;}

        $model = $this->findModel($id);
        if(!isset($model)) return 0;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if($model[Aabc::$app->_image->image_status] == '2'){
                $model[Aabc::$app->_image->image_status] = '1';
            }else{
                $model[Aabc::$app->_image->image_status] = '2';
            }
             /* Json */
            Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;
            return (1 && $model->save());
        } 
        die;
    }







    
     public function actionRes($id) //Restore
    {
        //$role = 'backend-image-restore';
        //if(!Aabc::$app->user->can($role)){ return 'nacc';die;}

        $datajson = 'thatbai'; 
        $model = $this->findModel($id);
        if(!isset($model)) return 0;
        $model[Aabc::$app->_image->image_recycle] = '2';
       
        Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;
            return (1 && $model->save());
    }


     
    public function actionRec($id) //Recycle
    {
        //$role = 'backend-image-recycle';
        //if(!Aabc::$app->user->can($role)){ return 'nacc';die;}

        $datajson = 'thatbai'; 
        $model = $this->findModel($id);
        if(!isset($model)) return 0;
        $model[Aabc::$app->_image->image_recycle] = '1';
        
        Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;
            return (1 && $model->save());
    }

    public function actionReca() //Recycleall
    {
        //$role = 'backend-image-recycleall';
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
                        $model[Aabc::$app->_image->image_recycle] = '1';
                    }

                    if($typ == '1' OR $typ == '2'){
                        $model[Aabc::$app->_image->image_status] = $valu;
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
        //$role = 'backend-image-delete';
        //if(!Aabc::$app->user->can($role)){ return 'nacc';die;}
              
        $model =  $this->findModel($id);   
        if(!isset($model)) return 0;
        $l1 = '..'.$model[Aabc::$app->_image->image_link];
        $l2 = $model[Aabc::$app->_image->image_tenfile] . '-' . $model[Aabc::$app->_image->image_id] . $model[Aabc::$app->_image->image_morong];
        if($model[Aabc::$app->_image->image_recycle] == '1'  && $model->delete()){
            $this->deletethumb($l1,$l2);
            $this->deleteimage($l1,$l2);
            return 1;
        }
        return 0;
    }


    public function actionDa() //Deleteall
    {        
        //$role = 'backend-image-deleteall';
        //if(!Aabc::$app->user->can($role)){ return 'nacc';die;}
        
        Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;
        $_Image = Aabc::$app->_model->Image;

        $models = new $_Image();
        $models = $models->getAllRecycle1();
        if(!isset($models)) return 0;
        // if($_Image::deleteAll([Aabc::$app->_image->image_recycle => '1']) ){

        foreach ($models as $key => $model) {
            $l1 = '..'.$model[Aabc::$app->_image->image_link];
            $l2 = $model[Aabc::$app->_image->image_tenfile] . '-' . $model[Aabc::$app->_image->image_id] . $model[Aabc::$app->_image->image_morong];
            if($model[Aabc::$app->_image->image_recycle] == '1'  && $model->delete()){
                $this->deletethumb($l1,$l2);
                $this->deleteimage($l1,$l2);
            }
        }
        return 1;
        // }
        // return 0;
    }

    
    protected function findModel($id)
    {
        $_Image = Aabc::$app->_model->Image;
        if (($model = $_Image::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
