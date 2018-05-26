<?php

use aabc\helpers\Html;
use aabc\widgets\ActiveForm;

/* @var $this aabc\web\View */
/* @var $model backend\models\ItemhelpSearch */
/* @var $form aabc\widgets\ActiveForm */
?>

<div class="itemhelp-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ih_id') ?>

    <?= $form->field($model, 'ih_action') ?>

    <?= $form->field($model, 'ih_check') ?>

    <?= $form->field($model, 'ih_focus') ?>

    <?= $form->field($model, 'ih_noidung') ?>

    <?php // echo $form->field($model, 'ih_sothutu') ?>

    <?php // echo $form->field($model, 'ih_id_grouphelp') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
