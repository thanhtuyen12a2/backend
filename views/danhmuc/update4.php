<?php

use aabc\helpers\Html;

/* @var $this aabc\web\View */
/* @var $model backend\models\Danhmuc */

$this->title = 'Chỉnh sửa';
$this->params['breadcrumbs'][] = ['label' => 'Danhmucs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model[Aabc::$app->_danhmuc->dm_id], 'url' => ['view', 'id' => $model[Aabc::$app->_danhmuc->dm_id]]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="<?= Aabc::$app->_model->__danhmuc?>-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form4', [
        'model' => $model,
    ]) ?>

</div>
