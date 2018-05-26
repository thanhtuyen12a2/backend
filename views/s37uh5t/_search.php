<?php

use aabc\helpers\Html;
use aabc\widgets\ActiveForm;

/* @var $this aabc\web\View */
/* @var $model backend\models\Sanpham3Search */
/* @var $form aabc\widgets\ActiveForm */
?>

<div class="sanpham3-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'sp_id') ?>

    <?= $form->field($model, 'sp_tensp') ?>

    <?= $form->field($model, 'sp_masp') ?>

    <?= $form->field($model, 'sp_linkseo') ?>

    <?= $form->field($model, 'sp_linkanhdaidien') ?>

    <?php // echo $form->field($model, 'sp_images') ?>

    <?php // echo $form->field($model, 'sp_status') ?>

    <?php // echo $form->field($model, 'sp_recycle') ?>

    <?php // echo $form->field($model, 'sp_conhang') ?>

    <?php // echo $form->field($model, 'sp_view') ?>

    <?php // echo $form->field($model, 'sp_ngaytao') ?>

    <?php // echo $form->field($model, 'sp_ngayupdate') ?>

    <?php // echo $form->field($model, 'sp_idnguoitao') ?>

    <?php // echo $form->field($model, 'sp_idnguoiupdate') ?>

    <?php // echo $form->field($model, 'sp_id_ncc') ?>

    <?php // echo $form->field($model, 'sp_id_thuonghieu') ?>

    <?php // echo $form->field($model, 'sp_gia') ?>

    <?php // echo $form->field($model, 'sp_giakhuyenmai') ?>

    <?php // echo $form->field($model, 'sp_soluong') ?>

    <?php // echo $form->field($model, 'sp_soluongfake') ?>

    <?php // echo $form->field($model, 'sp_soluotmua') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
