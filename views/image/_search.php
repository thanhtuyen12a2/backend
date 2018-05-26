<?php

use aabc\helpers\Html;
use aabc\widgets\ActiveForm;

/* @var $this aabc\web\View */
/* @var $model backend\models\ImageSearch */
/* @var $form aabc\widgets\ActiveForm */
?>

<div class="image-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'image_id') ?>

    <?= $form->field($model, 'image_tieude') ?>

    <?= $form->field($model, 'image_link') ?>

    <?= $form->field($model, 'image_recycle') ?>

    <?= $form->field($model, 'image_status') ?>

    <?php // echo $form->field($model, 'image_byte') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
