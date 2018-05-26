<?php

use aabc\helpers\Html;


/* @var $this aabc\web\View */
/* @var $model backend\models\Nhomsanphamngonngu */

$this->title = 'Create Nhomsanphamngonngu';
$this->params['breadcrumbs'][] = ['label' => 'Nhomsanphamngonngus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nhomsanphamngonngu-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
