<?php

use aabc\helpers\Html;
use aabc\widgets\ActiveForm;

/* @var $this aabc\web\View */
/* @var $model backend\models\DomainSearch */
/* @var $form aabc\widgets\ActiveForm */
?>

<div class="domain-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'dm_id') ?>

    <?= $form->field($model, 'dm_domain') ?>

    <?= $form->field($model, 'dm_length') ?>

    <?= $form->field($model, 'dm_status') ?>

    <?= $form->field($model, 'dm_recycle') ?>

    <?php // echo $form->field($model, 'dm_tiemnang') ?>

    <?php // echo $form->field($model, 'dm_chude') ?>

    <?php // echo $form->field($model, 'dm_email') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
