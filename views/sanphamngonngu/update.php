<?php

use aabc\helpers\Html;

/* @var $this aabc\web\View */
/* @var $model backend\models\Sanphamngonngu */

$this->title = 'Update Sanphamngonngu: ' . $model->spnn_idsanpham;
$this->params['breadcrumbs'][] = ['label' => 'Sanphamngonngus', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->spnn_idsanpham, 'url' => ['view', 'spnn_idsanpham' => $model->spnn_idsanpham, 'spnn_idngonngu' => $model->spnn_idngonngu]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sanphamngonngu-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
