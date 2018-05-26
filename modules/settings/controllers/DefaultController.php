<?php


namespace backend\modules\settings\controllers;

use Aabc;
use backend\modules\settings\models\Setting;
use backend\modules\settings\models\SettingSearch;
// use pheme\grid\actions\ToggleAction;
use aabc\filters\AccessControl;
use aabc\web\Controller;
use aabc\web\NotFoundHttpException;
use aabc\filters\VerbFilter;

use aabc\widgets\Menu;

use common\cont\_sanpham;

use aabc\helpers\ArrayHelper;


use aabc\widgets\FragmentCache;
use aabc\filters\PageCache;
/**
 * SettingsController implements the CRUD actions for Setting model.
 *
 * @author Aris Karageorgos <aris@phe.me>
 */
class DefaultController extends Controller
{
    /**
     * Defines the controller behaviors
     * @return array
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => $this->module->accessRoles,
                    ],
                ],
            ],
        ];
    }

    // public function actions()
    // {
    //     return [
    //         'toggle' => [
    //             'class' => ToggleAction::className(),
    //             'modelClass' => 'pheme\settings\models\Setting',
    //             //'setFlash' => true,
    //         ]
    //     ];
    // }

    /**
     * Lists all Settings.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SettingSearch();
        $dataProvider = $searchModel->search(Aabc::$app->request->queryParams);

         FragmentCache::clear('maincontent');
        FragmentCache::clear('footer');
        


        PageCache::clear('homepage');
        PageCache::clear('site/contact');
        PageCache::clear('site/index');


        return $this->render(
            'index',
            [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]
        );
    }

    /**
     * Displays the details of a single Setting.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render(
            'view',
            [
                'model' => $this->findModel($id),
            ]
        );
    }

    /**
     * Creates a new Setting.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Setting(['active' => 1]);

        if ($model->load(Aabc::$app->request->post())) {
            echo '<pre>';
            // print_r($model);
            // die;
            $arr = '{"items":'.(json_encode($model->value)).'}';
            echo Menu::widget(json_decode($arr,true));
            // print_r(json_encode($model->value));
            $model->value = $arr;

            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }            
        } else {
            return $this->render(
                'create',
                [
                    'model' => $model,
                ]
            );
        }
    }

    /**
     * Updates an existing Setting.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
   

    public function actionUpdate($id)
    {
               
        FragmentCache::clear('maincontent');
        FragmentCache::clear('footer');
        


        PageCache::clear('homepage');
        PageCache::clear('site/contact');
        PageCache::clear('site/index');



        // Aabc::$app->settings->clearCache();

        $settings = Aabc::$app->settings;
        
        $_Sanpham = Aabc::$app->_model->Sanpham;
        // $model = $_Sanpham::find()->asArray()->all();
     

        // $sp_all = ArrayHelper::getColumn($model, 'sp_id');  
        // $settings->set('sp_all', json_encode($sp_all));



        $model = $this->findModel($id);

        if ($model->load(Aabc::$app->request->post())){
            // echo '<pre>';
            $arr = '{"items":'.(json_encode($model->value)).'}';
            // echo Menu::widget(json_decode($arr,true));
            // print_r(json_decode($arr));die;
            $model->value = $arr;
            // print_r($model->key);
            // die;
            // Aabc::$app->settings->clearCache();
            if($model->save()){
                $settings->delete('','tuyen');//Xóa cache setting
                
                // Aabc::$app->cacheFrontend->flush();
                // die;
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render(
                'update',
                [
                    'model' => $model,
                ]
            );
        }
    }

    /**
     * Deletes an existing Setting.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Aabc::$app->request->isPost) {
            $this->findModel($id)->delete();
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds a Setting model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Setting the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Setting::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
