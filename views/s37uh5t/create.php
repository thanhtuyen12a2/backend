<?php

use aabc\helpers\Html;


/* @var $this aabc\web\View */
/* @var $model backend\models\Sanpham3 */

$this->title = 'Create Sanpham3';
$this->params['breadcrumbs'][] = ['label' => 'Sanpham3s', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="<?=Aabc::$app->_model->__sanpham3?>-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
