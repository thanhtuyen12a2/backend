<?php

use aabc\helpers\Html;

/* @var $this aabc\web\View */
/* @var $model backend\models\Domain */

$this->title = 'Update Domain: ' . $model[Aabc::$app->domain->dm_id];
$this->params['breadcrumbs'][] = ['label' => 'Domains', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model[Aabc::$app->domain->dm_id], 'url' => ['view', 'id' => $model[Aabc::$app->domain->dm_id]]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="domain-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
