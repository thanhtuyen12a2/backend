<?php

use aabc\helpers\Html;


/* @var $this aabc\web\View */
/* @var $model backend\modules\rbac\models\Authitem */

$this->title = 'Create Authitem';
$this->params['breadcrumbs'][] = ['label' => 'Authitems', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="authitem-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
