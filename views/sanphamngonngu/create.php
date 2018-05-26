<?php

use aabc\helpers\Html;


/* @var $this aabc\web\View */
/* @var $model backend\models\Sanphamngonngu */

$this->title = 'Create Sanphamngonngu';
$this->params['breadcrumbs'][] = ['label' => 'Sanphamngonngus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sanphamngonngu-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
