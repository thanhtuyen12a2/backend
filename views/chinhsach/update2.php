<?php

use aabc\helpers\Html;

/* @var $this aabc\web\View */
/* @var $model backend\models\Chinhsach */

$this->title = 'Cập nhật chính sách bảo hành: ' . $model[Aabc::$app->_chinhsach->cs_id];
$this->params['breadcrumbs'][] = ['label' => 'Chinhsaches', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model[Aabc::$app->_chinhsach->cs_id], 'url' => ['view', 'id' => $model[Aabc::$app->_chinhsach->cs_id]]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="<?= Aabc::$app->_model->__chinhsach?>-update-bh">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form2', [
        'model' => $model,
    ]) ?>

</div>
