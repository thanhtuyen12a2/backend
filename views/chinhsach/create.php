<?php

use aabc\helpers\Html;


/* @var $this aabc\web\View */
/* @var $model backend\models\Chinhsach */

$this->title = 'Create Chinhsach';
$this->params['breadcrumbs'][] = ['label' => 'Chinhsaches', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="<?=Aabc::$app->_model->__chinhsach?>-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
