<?php

use aabc\helpers\Html;

/* @var $this aabc\web\View */
/* @var $model backend\models\Image */

$this->title = 'Update Image: ' . $model[Aabc::$app->_image->image_id];
$this->params['breadcrumbs'][] = ['label' => 'Images', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model[Aabc::$app->_image->image_id], 'url' => ['view', 'id' => $model[Aabc::$app->_image->image_id]]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="<?= Aabc::$app->_model->__image?>-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    if(isset($data)){
    	echo $this->render('_form', [
	        'model' => $model,
	        'data' => $data,
	    ]);
    }else{
    	echo $this->render('_form', [
	        'model' => $model,	        
	    ]);
    }  

    ?>

</div>
