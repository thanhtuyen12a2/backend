<?php

use aabc\helpers\Html;


/* @var $this aabc\web\View */
/* @var $model backend\modules\rbac\models\Authitemchild */

$this->title = 'Create Authitemchild';
$this->params['breadcrumbs'][] = ['label' => 'Authitemchildren', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="authitemchild-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
