<?php

use aabc\helpers\Html;

/* @var $this aabc\web\View */
/* @var $model backend\models\Itemhelp */

$this->title = 'Update Itemhelp: ' . $model->ih_id;
$this->params['breadcrumbs'][] = ['label' => 'Itemhelps', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ih_id, 'url' => ['view', 'id' => $model->ih_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="itemhelp-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
