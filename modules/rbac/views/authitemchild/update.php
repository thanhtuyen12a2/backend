<?php

use aabc\helpers\Html;

/* @var $this aabc\web\View */
/* @var $model backend\modules\rbac\models\Authitemchild */

$this->title = 'Update Authitemchild: ' . $model->parent;
$this->params['breadcrumbs'][] = ['label' => 'Authitemchildren', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->parent, 'url' => ['view', 'parent' => $model->parent, 'child' => $model->child]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="authitemchild-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
