<?php

use aabc\helpers\Html;   
use aabc\grid\GridView;

//use aabc\bootstrap\Modal; /*Them*/
use aabc\helpers\Url; /*Them*/
use aabc\helpers\ArrayHelper; /*Them*/
use aabc\widgets\ActiveForm;
/*use app\models\Dskh; */


/* @var $this aabc\web\View */
// use backend\models\ChinhsachSearch ;
// use backend\models\Chinhsach ;
/* @var $dataProvider aabc\data\ActiveDataProvider */

$this->title = 'Khuyến mại tặng kèm';
$this->params['breadcrumbs'][] = $this->title;
?>

<div id="pj<?=Aabc::$app->_model->__chinhsach?>"    <?=Aabc::$app->d->i?>=<?= Aabc::$app->_model->__chinhsach?> class="pj">


<div class="<?= Aabc::$app->_model->__chinhsach?>-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


<p>  
        
        <button type="button"  <?=Aabc::$app->d->m  ?>="2" id="mb<?= Aabc::$app->_model->__chinhsach?>" <?=Aabc::$app->d->u  ?>  ="c" class="btn btn-default mb" <?=Aabc::$app->d->i  ?>="<?= Aabc::$app->_model->__chinhsach?>"><span class="glyphicon glyphicon-plus mxanh"></span><?=Aabc::$app->MyConst->view_btn_them?></button>
  

         <?php         
        $_Chinhsach = Aabc::$app->_model->Chinhsach;        
        $demthungrac = count($_Chinhsach::getAllRecycle1());

            echo '<button type="button"  '.Aabc::$app->d->m.'="2"  '.($demthungrac > 0 ? : 'disabled').'  id="mb'.Aabc::$app->_model->__chinhsach.'r" '.Aabc::$app->d->u.'="ir" class="btn btn-danger mb" '.Aabc::$app->d->i.'="'.Aabc::$app->_model->__chinhsach.'"><span class="glyphicon glyphicon-trash mden"></span>'.Aabc::$app->MyConst->view_btn_thungrac.' ('.$demthungrac.')</button>';
        
        ?>

       

    </p>

<?= $this->render('_gridview1', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]) ?>


<div style="clear: both"></div>



</div>
