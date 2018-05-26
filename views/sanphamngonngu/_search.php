<?php

use aabc\helpers\Html;
use aabc\widgets\ActiveForm;

/* @var $this aabc\web\View */
/* @var $model backend\models\SanphamngonnguSearch */
/* @var $form aabc\widgets\ActiveForm */
?>

<div class="sanphamngonngu-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'spnn_idsanpham') ?>

    <?= $form->field($model, 'spnn_idngonngu') ?>

    <?= $form->field($model, 'spnn_ten') ?>

    <?= $form->field($model, 'spnn_noidung') ?>

    <?= $form->field($model, 'spnn_gioithieu') ?>

    <?php // echo $form->field($model, 'spnn_tieudeseo') ?>

    <?php // echo $form->field($model, 'spnn_motaseo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
