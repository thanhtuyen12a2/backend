<?php

use aabc\helpers\Html;


/* @var $this aabc\web\View */
/* @var $model backend\models\Cauhinh */

$this->title = Aabc::t('app', 'Create Cauhinh');
$this->params['breadcrumbs'][] = ['label' => Aabc::t('app', 'Cauhinhs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="<?=Aabc::$app->_model->__cauhinh?>-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
