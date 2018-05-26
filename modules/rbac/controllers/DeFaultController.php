<?php

namespace backend\modules\rbac\controllers;

use Aabc;
use aabc\web\Controller;
use aabc\helpers\Html;
use aabc\helpers\Url; /*Them*/

class DefaultController extends Controller
{
    
    public function actionIndex()
    {
        return $this->render('index');
    	//return $this->redirect(Aabc::$app->homeUrl.'/rbac/authitem'); 
    }
}
