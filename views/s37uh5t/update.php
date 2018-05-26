<?php

use aabc\helpers\Html;

/* @var $this aabc\web\View */
/* @var $model backend\models\Sanpham3 */

$this->title = 'Update Sanpham3: ' . $model[Aabc::$app->_sanpham3->sp_id];
$this->params['breadcrumbs'][] = ['label' => 'Sanpham3s', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model[Aabc::$app->_sanpham3->sp_id], 'url' => ['view', 'id' => $model[Aabc::$app->_sanpham3->sp_id]]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="<?= Aabc::$app->_model->__sanpham3?>-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
