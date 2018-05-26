<?php

use aabc\helpers\Html;
use aabc\widgets\DetailView;

/* @var $this aabc\web\View */
/* @var $model backend\models\Nhomsanphamngonngu */

$this->title = $model->nspnn_idngonngu;
$this->params['breadcrumbs'][] = ['label' => 'Nhomsanphamngonngus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nhomsanphamngonngu-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'nspnn_idngonngu' => $model->nspnn_idngonngu, 'nspnn_idnhomsanpham' => $model->nspnn_idnhomsanpham], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'nspnn_idngonngu' => $model->nspnn_idngonngu, 'nspnn_idnhomsanpham' => $model->nspnn_idnhomsanpham], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nspnn_idngonngu',
            'nspnn_idnhomsanpham',
            'nspnn_ten',
            'nspnn_motangan',
            'nspnn_tieudeseo',
            'nspnn_motaseo',
        ],
    ]) ?>

</div>
