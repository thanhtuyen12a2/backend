<?php

use aabc\helpers\Html;   
use aabc\grid\GridView;

//use aabc\bootstrap\Modal; /*Them*/
use aabc\helpers\Url; /*Them*/
use aabc\helpers\ArrayHelper; /*Them*/
use aabc\widgets\ActiveForm;
/*use app\models\Dskh; */


/* @var $this aabc\web\View */
// use backend\models\DanhmucSearch ;
// use backend\models\Danhmuc ;
/* @var $dataProvider aabc\data\ActiveDataProvider */

$this->title = 'Chuyên mục bài viết';
$this->params['breadcrumbs'][] = $this->title;
?>

<div id="pj<?=Aabc::$app->_model->__danhmuc?>"    <?=Aabc::$app->d->i?>=<?= Aabc::$app->_model->__danhmuc?> class="pj">


<div class="<?= Aabc::$app->_model->__danhmuc?>-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


<p>  
        
        <button type="button"  <?=Aabc::$app->d->m  ?>="3" id="mb<?= Aabc::$app->_model->__danhmuc?>" <?=Aabc::$app->d->u  ?>  ="c_cm" class="btn btn-default mb" <?=Aabc::$app->d->i  ?>="<?= Aabc::$app->_model->__danhmuc?>"><span class="glyphicon glyphicon-plus mxanh"></span><?=Aabc::$app->MyConst->view_btn_them?></button>
  

         <?php         
        $_Danhmuc = Aabc::$app->_model->Danhmuc;        
        $demthungrac = count($_Danhmuc::getAllRecycle1_2());

            echo '<button type="button"  '.Aabc::$app->d->m.'="3"  '.($demthungrac > 0 ? : 'disabled').'  id="mb'.Aabc::$app->_model->__danhmuc.'r" '.Aabc::$app->d->u.'="ir_cm" class="btn btn-danger mb" '.Aabc::$app->d->i.'="'.Aabc::$app->_model->__danhmuc.'"><span class="glyphicon glyphicon-trash mden"></span>'.Aabc::$app->MyConst->view_btn_thungrac.' ('.$demthungrac.')</button>';
        
        ?>



    </p>


     <?= $this->render('_gridview2', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]) ?>
  
<div style="clear: both"></div>



</div>
