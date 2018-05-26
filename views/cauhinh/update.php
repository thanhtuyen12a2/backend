<?php

use aabc\helpers\Html;

/* @var $this aabc\web\View */
/* @var $model backend\models\Cauhinh */

$this->title = Aabc::t('app', 'Update {modelClass}: ', [ '' => '--Chọn--',
    'modelClass' => 'Cauhinh',
]) . $model[Aabc::$app->_cauhinh->ch_id];
$this->params['breadcrumbs'][] = ['label' => Aabc::t('app', 'Cauhinhs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model[Aabc::$app->_cauhinh->ch_id], 'url' => ['view', 'id' => $model[Aabc::$app->_cauhinh->ch_id]]];
$this->params['breadcrumbs'][] = Aabc::t('app', 'Update');
?>
<div class="<?= Aabc::$app->_model->__cauhinh?>-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
