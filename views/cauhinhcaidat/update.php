<?php

use aabc\helpers\Html;

/* @var $this aabc\web\View */
/* @var $model backend\models\Cauhinhcaidat */

$this->title = 'Update Cauhinhcaidat: ' . $model[Aabc::$app->_cauhinhcaidat->chcd_id];
$this->params['breadcrumbs'][] = ['label' => 'Cauhinhcaidats', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model[Aabc::$app->_cauhinhcaidat->chcd_id], 'url' => ['view', 'id' => $model[Aabc::$app->_cauhinhcaidat->chcd_id]]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="<?= Aabc::$app->_model->__cauhinhcaidat?>-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
