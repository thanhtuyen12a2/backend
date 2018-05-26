<?php

use aabc\helpers\Html;

/* @var $this aabc\web\View */
/* @var $model backend\models\Nhomsanphamngonngu */

$this->title = 'Update Nhomsanphamngonngu: ' . $model->nspnn_idngonngu;
$this->params['breadcrumbs'][] = ['label' => 'Nhomsanphamngonngus', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nspnn_idngonngu, 'url' => ['view', 'nspnn_idngonngu' => $model->nspnn_idngonngu, 'nspnn_idnhomsanpham' => $model->nspnn_idnhomsanpham]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="nhomsanphamngonngu-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
