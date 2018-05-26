<?php

use aabc\helpers\Html;

/* @var $this aabc\web\View */
/* @var $model backend\models\Sanpham */

$this->title = 'Cập nhật Bài viết: ' . $model[Aabc::$app->_sanpham->sp_id];
$this->params['breadcrumbs'][] = ['label' => 'Sanphams', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model[Aabc::$app->_sanpham->sp_id], 'url' => ['view', 'id' => $model[Aabc::$app->_sanpham->sp_id]]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sanpham-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form2', [
        'model' => $model,
        // 'ngonngu' => $ngonngu,
        'data' => $data,
    ]) ?>

</div>
