<?php

use aabc\helpers\Html;

/* @var $this aabc\web\View */
/* @var $model backend\models\Ngonngu */

$this->title = 'Update Ngonngu: ' . $model->ngonngu_id;
$this->params['breadcrumbs'][] = ['label' => 'Ngonngus', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ngonngu_id, 'url' => ['view', 'id' => $model->ngonngu_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ngonngu-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
