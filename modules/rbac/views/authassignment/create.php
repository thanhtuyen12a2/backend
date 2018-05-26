<?php

use aabc\helpers\Html;


/* @var $this aabc\web\View */
/* @var $model backend\modules\rbac\models\Authassignment */

$this->title = 'Create Authassignment';
$this->params['breadcrumbs'][] = ['label' => 'Authassignments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="authassignment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
