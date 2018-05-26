<?php

use aabc\helpers\Html;
use aabc\widgets\DetailView;

/* @var $this aabc\web\View */
/* @var $model backend\models\Sanphamngonngu */

$this->title = $model->spnn_idsanpham;
$this->params['breadcrumbs'][] = ['label' => 'Sanphamngonngus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sanphamngonngu-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'spnn_idsanpham' => $model->spnn_idsanpham, 'spnn_idngonngu' => $model->spnn_idngonngu], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'spnn_idsanpham' => $model->spnn_idsanpham, 'spnn_idngonngu' => $model->spnn_idngonngu], [
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
            'spnn_idsanpham',
            'spnn_idngonngu',
            'spnn_ten',
            'spnn_noidung:ntext',
            'spnn_gioithieu:ntext',
            'spnn_tieudeseo',
            'spnn_motaseo',
        ],
    ]) ?>

</div>
