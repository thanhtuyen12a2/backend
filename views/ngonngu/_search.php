<?php

use aabc\helpers\Html;
use aabc\widgets\ActiveForm;

/* @var $this aabc\web\View */
/* @var $model backend\models\NgonnguSearch */
/* @var $form aabc\widgets\ActiveForm */
?>

<div class="ngonngu-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ngonngu_id') ?>

    <?= $form->field($model, 'ngonngu_code') ?>

    <?= $form->field($model, 'ngonngu_ten') ?>

    <?= $form->field($model, 'ngonngu_trangthai') ?>

    <?= $form->field($model, 'ngonngu_macdinh') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
