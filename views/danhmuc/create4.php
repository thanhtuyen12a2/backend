<?php

use aabc\helpers\Html;


/* @var $this aabc\web\View */
/* @var $model backend\models\Danhmuc */
if(empty($groupmenu)) $groupmenu = '';
if(empty($pa)) $pa = '';

$this->title = 'Thêm mới';
$this->params['breadcrumbs'][] = ['label' => 'Danhmucs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="<?=Aabc::$app->_model->__danhmuc?>-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form4', [
        'model' => $model,
        'groupmenu' => $groupmenu,
        'pa' => $pa,
    ]) ?>

</div>
