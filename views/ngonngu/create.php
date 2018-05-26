<?php

use aabc\helpers\Html;


/* @var $this aabc\web\View */
/* @var $model backend\models\Ngonngu */

$this->title = 'Create Ngonngu';
$this->params['breadcrumbs'][] = ['label' => 'Ngonngus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ngonngu-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
