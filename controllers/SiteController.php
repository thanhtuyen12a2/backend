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
                        'actions' => ['login', 'error','i','tuyen'],
                        'allow' => true,
                        //Không cần đăng nhập
                    ],
                    [
                        'actions' => ['logout','index','i','clearcache'],
                        'allow' => true,
                        'roles' => ['@'], //Phải đăng nhập
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'i' => ['get','post'],
                    'logout' => ['get','post'],
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
        ];     
        if(empty($arr_link[$key])){            
            return Aabc::$app->runAction($k .'/'. $f,$_GET);
        }else{
            return Aabc::$app->runAction($arr_link[$key],$_GET);
        }

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
        return 'tuyen';
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
            // return $this->redirect(['/']);
            // return $this->goBack();
            return $this->goHome();
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
        // return $this->redirect(['/']);
        return $this->goHome();
    }
}
