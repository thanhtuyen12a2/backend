<?php

use aabc\helpers\Html;
use aabc\widgets\ActiveForm;

/* @var $this aabc\web\View */
/* @var $model backend\models\NhomsanphamngonnguSearch */
/* @var $form aabc\widgets\ActiveForm */
?>

<div class="nhomsanphamngonngu-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'nspnn_idngonngu') ?>

    <?= $form->field($model, 'nspnn_idnhomsanpham') ?>

    <?= $form->field($model, 'nspnn_ten') ?>

    <?= $form->field($model, 'nspnn_motangan') ?>

    <?= $form->field($model, 'nspnn_tieudeseo') ?>

    <?php // echo $form->field($model, 'nspnn_motaseo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
