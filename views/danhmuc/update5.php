<?php

use aabc\helpers\Html;

/* @var $this aabc\web\View */
/* @var $model backend\models\Danhmuc */
if($model->dm_level == 0){
	$this->title = 'Cập nhật nhóm: ' . $model[Aabc::$app->_danhmuc->dm_ten];
}
elseif($model->dm_level == 1){
	$this->title = 'Cập nhật thông số: ' . $model[Aabc::$app->_danhmuc->dm_ten];
}
elseif($model->dm_level == 2){
	$this->title = 'Cập nhật giá trị: ' . $model[Aabc::$app->_danhmuc->dm_ten];
}

$this->params['breadcrumbs'][] = ['label' => 'Danhmucs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model[Aabc::$app->_danhmuc->dm_id], 'url' => ['view', 'id' => $model[Aabc::$app->_danhmuc->dm_id]]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="<?= Aabc::$app->_model->__danhmuc?>-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form5', [
        'model' => $model,
    ]) ?>

</div>
