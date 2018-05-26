<?php

use aabc\helpers\Html;
use aabc\widgets\ActiveForm;

/* @var $this aabc\web\View */
/* @var $model backend\models\ChinhsachSearch */
/* @var $form aabc\widgets\ActiveForm */
?>

<div class="chinhsach-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'cs_id') ?>

    <?= $form->field($model, 'cs_type') ?>

    <?= $form->field($model, 'cs_ten') ?>

    <?= $form->field($model, 'cs_code') ?>

    <?= $form->field($model, 'cs_ghichu') ?>

    <?php // echo $form->field($model, 'cs_typetyle') ?>

    <?php // echo $form->field($model, 'cs_tylechietkhau') ?>

    <?php // echo $form->field($model, 'cs_apdungcho') ?>

    <?php // echo $form->field($model, 'cs_dieukien') ?>

    <?php // echo $form->field($model, 'cs_noidungdieukien') ?>

    <?php // echo $form->field($model, 'cs_status') ?>

    <?php // echo $form->field($model, 'cs_recycle') ?>

    <?php // echo $form->field($model, 'cs_ngaytao') ?>

    <?php // echo $form->field($model, 'cs_ngaybatdau') ?>

    <?php // echo $form->field($model, 'cs_ngayketthuc') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
