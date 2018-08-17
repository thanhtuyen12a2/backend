<?php
namespace backend\controllers;

use Aabc;
use aabc\web\Controller;
use aabc\filters\VerbFilter;
use aabc\filters\AccessControl;
use common\models\LoginForm;

use backend\models\Sanpham;
use backend\models\Danhmuc;
use backend\models\Cauhinh;
use backend\models\Chinhsach;
use backend\models\Image;

use aabc\widgets\FragmentCache;
use aabc\filters\PageCache;

class SiteController extends Controller
{
    
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error','i','tuyen','clearcache'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index','i','tuyen','clearcache'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'i' => ['get','post'],
                    'logout' => ['post'],
                    'index' => ['get','post'],
                    'up' => ['get','post'],
                ],
            ],
        ];
    }

    
    public function actions()
    {
        return [
            'error' => [
                // 'class' => 'aabc\web\ErrorAction',
            ],
        ];
    }
    
   
    public function actionI($k = '', $f = '')
    {       
        

        if (Aabc::$app->user->isGuest) {
            return Aabc::$app->runAction('site/login');                
        }
        $key = $k.':'.$f;

        $arr_link = [];

        $arr_link += Chinhsach::actionController();

        $arr_link += Sanpham::actionController();

        $arr_link += Cauhinh::actionController();

        $arr_link += [
            ':' => 'site/index',
            'clear:cache' => 'site/clearcache',  
            'domain:getdep' => 'domain/getdep',
            'yur75:kh3h57' => 'site/index',

            // Sanpham::tt.':'.
            'danhmuc:rts' => 'danhmuc/reloadthongso',

            // Sanpham::tt.':'.Sanpham::index_sp => 'sanpham/i',
            // Sanpham::tt.':'.Sanpham::index_bv => 'sanpham/i_b',
            // Sanpham::tt.':'.Sanpham::update_sp => 'sanpham/u',
            // Sanpham::tt.':'.Sanpham::update_bv => 'sanpham/u_b',
            // Sanpham::tt.':s' => 'sanpham/s',
            // Sanpham::tt.':c' => 'sanpham/c',
            // Sanpham::tt.':ut' => 'sanpham/ut',
            // Sanpham::tt.':rec' => 'sanpham/rec',
            // Sanpham::tt.':ir' => 'sanpham/ir',
            // Sanpham::tt.':'.Sanpham::action_thongso => 'sanpham/thongso',

        ];     
        if(empty($arr_link[$key])){            
            return Aabc::$app->runAction($k .'/'. $f,$_GET);
        }else{
            return Aabc::$app->runAction($arr_link[$key],$_GET);
        }

        

         //Cau hinh
        if ($k == 'ch' && $f == 'c1'){           
            return Aabc::$app->runAction('cauhinh/cauhinh1');
        }
        elseif ($k == 'ch' && $f == 'c2'){           
            return Aabc::$app->runAction('cauhinh/cauhinh2');
        }
        elseif ($k == 'ch' && $f == 'c3'){           
            return Aabc::$app->runAction('cauhinh/cauhinh3');
        }
        elseif ($k == 'ch' && $f == 'c4'){           
            return Aabc::$app->runAction('cauhinh/cauhinh4');
        }
        elseif ($k == 'ch' && $f == 'c5'){
            return Aabc::$app->runAction('cauhinh/cauhinh5');
        }

        ///Clearcache
        elseif ($k == 'clear' && $f == 'cache'){ 

            FragmentCache::clear('maincontent');        
            PageCache::clear('site/index');

            return $this->clearcache();
        }


               


        return Aabc::$app->runAction($k .'/'. $f,$_GET);











               
        if($k == 'yur75' && $f == 'kh3h57'){
            
        }elseif ($k == '' && $f == ''){           
        }


        elseif ($k == Sanpham::tt){

            if($f == Sanpham::index_sp){               
            }           
                     
             elseif ($f == 'c'){                
                return Aabc::$app->runAction('sanpham/c');
            }
            elseif ($f == 'c_b'){                
                return Aabc::$app->runAction('sanpham/c_b');
            }


            
            elseif ($f == 'reca'){                
                return Aabc::$app->runAction('sanpham/reca');
            }
            elseif ($f == 'reca_b'){                
                return Aabc::$app->runAction('sanpham/reca_b');
            }



            elseif ($f == 'ut'){   
                 $data = [
                    'id' => $_GET['id'],
                ];             
                return Aabc::$app->runAction('sanpham/ut',$data);
            }
            elseif ($f == 'ut_b'){   
                 $data = [
                    'id' => $_GET['id'],
                ];             
                return Aabc::$app->runAction('sanpham/ut_b',$data);
            }

            elseif ($f == 'rec'){   
                 $data = [
                    'id' => $_GET['id'],
                ];             
                return Aabc::$app->runAction('sanpham/rec',$data);
            }
            elseif ($f == 'rec_b'){   
                 $data = [
                    'id' => $_GET['id'],
                ];             
                return Aabc::$app->runAction('sanpham/rec_b',$data);
            }

             elseif ($f == 'ir'){                
                return Aabc::$app->runAction('sanpham/ir');
            }
            elseif ($f == 'ir_b'){                
                return Aabc::$app->runAction('sanpham/ir_b');
            }


            elseif ($f == 'res'){   
                 $data = [
                    'id' => $_GET['id'],
                ];             
                return Aabc::$app->runAction('sanpham/res',$data);
            }
            elseif ($f == 'res_b'){   
                 $data = [
                    'id' => $_GET['id'],
                ];             
                return Aabc::$app->runAction('sanpham/res_b',$data);
            }


             elseif ($f == 'd'){   
                 $data = [
                    'id' => $_GET['id'],
                ];             
                return Aabc::$app->runAction('sanpham/d',$data);
            }
            elseif ($f == 'd_b'){   
                 $data = [
                    'id' => $_GET['id'],
                ];             
                return Aabc::$app->runAction('sanpham/d_b',$data);
            }



            elseif ($f == 'da'){
                return Aabc::$app->runAction('sanpham/da');
            }
            elseif ($f == 'da_b'){
                return Aabc::$app->runAction('sanpham/da_b');
            }
        }

//////////////////////////////////////
//////////////////////////////////////
//////////////////////////////////////
//////////////////////////////////////

        elseif ($k == 'image' && $f == 'i'){
            return Aabc::$app->runAction('image/i');
        }
        elseif ($k == 'image' && $f == 'v'){
            $data = [
                'id' => $_GET['id'],
            ];
            return Aabc::$app->runAction('image/v',$data);
        }
        elseif ($k == 'image' && $f == 'u'){
            $data = [
                'id' => $_GET['id'],
            ];
            return Aabc::$app->runAction('image/u',$data);
        }
        elseif ($k == 'image' && $f == 'rec'){
            $data = [
                'id' => $_GET['id'],
            ];
            return Aabc::$app->runAction('image/rec',$data);
        }
        elseif ($k == 'image' && $f == 'reca'){            
            return Aabc::$app->runAction('image/reca');
        }
        elseif ($k == 'image' && $f == 'da'){            
            return Aabc::$app->runAction('image/da');
        }
        elseif ($k == 'image' && $f == 'ir'){            
            return Aabc::$app->runAction('image/ir');
        }
        elseif ($k == 'image' && $f == 'res'){
            $data = [
                'id' => $_GET['id'],
            ];
            return Aabc::$app->runAction('image/res',$data);
        }
        elseif ($k == 'image' && $f == 'd'){
            $data = [
                'id' => $_GET['id'],
            ];
            return Aabc::$app->runAction('image/d',$data);
        }
        elseif ($k == 'image' && $f == 'ga'){
            $data = [                
                'i' => isset($_GET['i'])?$_GET['i']:null,
            ];
            return Aabc::$app->runAction('image/ga',$data);
        }



//////////////////////////////////////
//////////////////////////////////////
//////////////////////////////////////
//////////////////////////////////////



        elseif ($k == 'danhmuc' && $f == 'ip'){            
            return Aabc::$app->runAction('danhmuc/ip');
        }
        elseif ($k == 'danhmuc' && $f == 'ip_cm'){            
            return Aabc::$app->runAction('danhmuc/ip_cm');
        }

        elseif ($k == 'danhmuc' && $f == 'i'){
            return Aabc::$app->runAction('danhmuc/i');
        }
        elseif ($k == 'danhmuc' && $f == 'i_cm'){
            return Aabc::$app->runAction('danhmuc/i_cm');
        }


        elseif ($k == 'danhmuc' && $f == 'c'){
            return Aabc::$app->runAction('danhmuc/c');
        }
        elseif ($k == 'danhmuc' && $f == 'c_cm'){
            return Aabc::$app->runAction('danhmuc/c_cm');
        }

        elseif ($k == 'danhmuc' && $f == 'ir'){
            return Aabc::$app->runAction('danhmuc/ir');
        }
        elseif ($k == 'danhmuc' && $f == 'ir_cm'){
            return Aabc::$app->runAction('danhmuc/ir_cm');
        }

        elseif ($k == 'danhmuc' && $f == 'da'){
            return Aabc::$app->runAction('danhmuc/da');
        }
        elseif ($k == 'danhmuc' && $f == 'da_cm'){
            return Aabc::$app->runAction('danhmuc/da_cm');
        }


        elseif ($k == 'danhmuc' && $f == 'reca_cm'){
            return Aabc::$app->runAction('danhmuc/reca_cm');
        }
        elseif ($k == 'danhmuc' && $f == 'reca'){
            return Aabc::$app->runAction('danhmuc/reca');
        }

        elseif ($k == 'danhmuc' && $f == 'u'){
            $data = [
                'id' => $_GET['id'],
            ];
            return Aabc::$app->runAction('danhmuc/u',$data);
        }
        elseif ($k == 'danhmuc' && $f == 'u_cm'){
            $data = [
                'id' => $_GET['id'],
            ];
            return Aabc::$app->runAction('danhmuc/u_cm',$data);
        }



        elseif ($k == 'danhmuc' && $f == 'd'){
            $data = [
                'id' => $_GET['id'],
            ];
            return Aabc::$app->runAction('danhmuc/d',$data);
        }
        elseif ($k == 'danhmuc' && $f == 'd_cm'){
            $data = [
                'id' => $_GET['id'],
            ];
            return Aabc::$app->runAction('danhmuc/d_cm',$data);
        }


        elseif ($k == 'danhmuc' && $f == 'us'){
            $data = [
                'id' => $_GET['id'],
            ];
            return Aabc::$app->runAction('danhmuc/us',$data);
        }
        elseif ($k == 'danhmuc' && $f == 'us_cm'){
            $data = [
                'id' => $_GET['id'],
            ];
            return Aabc::$app->runAction('danhmuc/us_cm',$data);
        }



        elseif ($k == 'danhmuc' && $f == 'rec_cm'){
            $data = [
                'id' => $_GET['id'],
            ];
            return Aabc::$app->runAction('danhmuc/rec_cm',$data);
        }
        elseif ($k == 'danhmuc' && $f == 'rec'){
            $data = [
                'id' => $_GET['id'],
            ];
            return Aabc::$app->runAction('danhmuc/rec',$data);
        }


        elseif ($k == 'danhmuc' && $f == 'res'){
            $data = [
                'id' => $_GET['id'],
            ];
            return Aabc::$app->runAction('danhmuc/res',$data);
        }
        elseif ($k == 'danhmuc' && $f == 'res_cm'){
            $data = [
                'id' => $_GET['id'],
            ];
            return Aabc::$app->runAction('danhmuc/res_cm',$data);
        }


        elseif ($k == 'danhmuc' && $f == 'ut'){
            $data = [
                'id' => $_GET['id'],                
            ];
            if(isset($_GET['t'])) $data['t'] = 'u';
            return Aabc::$app->runAction('danhmuc/ut',$data);
        }
        elseif ($k == 'danhmuc' && $f == 'ut_cm'){
            $data = [
                'id' => $_GET['id'],                
            ];
            if(isset($_GET['t'])) $data['t'] = 'u';
            return Aabc::$app->runAction('danhmuc/ut_cm',$data);
        }


//////////////////////////////////////
//////////////////////////////////////
//////////////////////////////////////
//////////////////////////////////////


        //Cau hinh
        elseif ($k == 'ch' && $f == 'c1'){           
            return Aabc::$app->runAction('cauhinh/cauhinh1');
        }
        elseif ($k == 'ch' && $f == 'c2'){           
            return Aabc::$app->runAction('cauhinh/cauhinh2');
        }
        elseif ($k == 'ch' && $f == 'c3'){           
            return Aabc::$app->runAction('cauhinh/cauhinh3');
        }
        elseif ($k == 'ch' && $f == 'c4'){           
            return Aabc::$app->runAction('cauhinh/cauhinh4');
        }
        elseif ($k == 'ch' && $f == 'c5'){
            return Aabc::$app->runAction('cauhinh/cauhinh5');
        }

        ///Clearcache
        elseif ($k == 'clear' && $f == 'cache'){           
            return $this->clearcache();
        }

// http://ngocanhpc/ad/danhmuc/ut?id=62&t=u

        else{   
            if (Aabc::$app->user->isGuest) {
                return Aabc::$app->runAction('site/login');
                // print_r('tuyen');
                // die;
            }else{
                // print_r('login tuyen');
                // die;
            }   
            // return Aabc::$app->runAction('site/index');
        }
        die;
    }


    // public function actionTuyen(){
    //     // echo '1';die;
    //     return Aabc::$app->runAction('settings/default');         
    // }

    // public function actionClear()    
    // {
    //     // echo 'ok';
    //     die;
    //     // return $this->clearcache();
    // }

     public function actionTuyen()
    {
        // FragmentCache::clear('maincontent');
        // FragmentCache::clear('footer');
        
        // PageCache::clear('homepage');
        // PageCache::clear('site/contact');
        // PageCache::clear('site/index');
    }

  

    public function actionClearcache(){
        FragmentCache::clear('maincontent');
        FragmentCache::clear('footer');
        
        PageCache::clear('homepage');
        PageCache::clear('site/contact');
        PageCache::clear('site/index');

        $sanpham = (Sanpham::M)::find()->limit(100)->orderBy(['sp_id' => SORT_ASC])->all();    
        $cauhinh = (Cauhinh::M)::find()->all();   
        $danhmuc = Danhmuc::find()->all();
        $danhmuc = Danhmuc::find()->all();
        $image   = Image::find()->all();

        if($image){
            foreach ($image as $k => $v) {
                Image::cache($v);
            }
        };


        if($sanpham){
            foreach ($sanpham as $k => $v) {
                Sanpham::cache($v);
            }
        };
        
        
        if($danhmuc){
            foreach ($danhmuc as $k => $v) {
                if($v->dm_type == 1 OR $v->dm_type == 2)
                Danhmuc::cache($v);
            }
        };


        if($cauhinh){
            foreach ($cauhinh as $k => $v) {
                Cauhinh::cache($v);
            }
        };


        $cache = Aabc::$app->dulieu;         
        for ($i=1; $i < 20; $i++) {
            $groupmenu = $i;        
            $module = Danhmuc::find()                
               ->andWhere([Aabc::$app->_danhmuc->dm_recycle => '2'])
               ->andWhere([Aabc::$app->_danhmuc->dm_type => 4]) 
               ->andWhere(['dm_groupmenu' => $groupmenu])                
               ->orderBy([Aabc::$app->_danhmuc->dm_sothutu=>SORT_ASC])
               ->asArray()->all();
            if($module){
                $tree = Aabc::$app->MyComponent->getChildren($module,0);
                $cache->set('module'.$groupmenu, json_encode($tree) );
            }
        }

        return 'ok';
    }


    
    public function actionIndex($t = '')
    {
        // FragmentCache::clear('maincontent');
        // PageCache::clear('site/index');
        // echo 'ok';
        // die;

        // echo 'tuyen';
        // die;
        // if(empty($t)){  
        //     header('Location: /ad?t='.time(), true,302);
        //     exit();
        // }else{
        //     if(($t  + 60) < time()){
        //         header('Location: /ad?t='.time(), true,302);
        //         exit();  
        //     }            
        // }
      
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //     Aabc::$app->response->format = \aabc\web\Response::FORMAT_JSON;  
        //     return $this->renderAjax('index');
            return $this->render('indexjson');
        }           
        // return $this->render('indexjson');
        return $this->render('index');
    }

    
    public function actionLogin()
    {
        if (!Aabc::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Aabc::$app->request->post()) && $model->login()) {
            return $this->goBack();
            //return $this->goHome();
        } else {
            // die;
            Aabc::$app->cache->set('test',$model);
            
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    
    public function actionLogout()
    {
        Aabc::$app->user->logout();

        return $this->goHome();
    }
}
