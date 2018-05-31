<?php

use aabc\helpers\Html;

/* @var $this aabc\web\View */
/* @var $model backend\models\Sanpham */

$this->title = 'Cập nhật thông tin sản phẩm: ' . $model[Aabc::$app->_sanpham->sp_ma];
$this->params['breadcrumbs'][] = ['label' => 'Sanphams', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model[Aabc::$app->_sanpham->sp_id], 'url' => ['view', 'id' => $model[Aabc::$app->_sanpham->sp_id]]];
$this->params['breadcrumbs'][] = 'Update';

if(empty($html_ts)) $html_ts = '';

?>
<div class="sanpham-update">

    <h1><?= Html::encode($this->title) ?></h1>

<?php
// if ($this->beginCache('sp-'.$model->sp_id)) {
    ?>

    <?= $this->render('_form1', [
        'model' => $model,
        // 'ngonngu' => $ngonngu,
        'data' => $data,
        'html_ts' => $html_ts,
    ]) ?>


<?php
 // $this->endCache();
        // }
    ?>

</div>
