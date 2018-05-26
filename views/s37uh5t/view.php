<?php

use aabc\helpers\Html;
use aabc\widgets\DetailView;

/* @var $this aabc\web\View */
/* @var $model backend\models\Sanpham3 */

$this->title = $model->sp_id;
$this->params['breadcrumbs'][] = ['label' => 'Sanpham3s', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sanpham3-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model[Aabc::$app->_->sp_id]], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model[Aabc::$app->_->sp_id]], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'sp_id',
            'sp_tensp',
            'sp_masp',
            'sp_linkseo',
            'sp_linkanhdaidien',
            'sp_images:ntext',
            'sp_status',
            'sp_recycle',
            'sp_conhang',
            'sp_view',
            'sp_ngaytao',
            'sp_ngayupdate',
            'sp_idnguoitao',
            'sp_idnguoiupdate',
            'sp_id_ncc',
            'sp_id_thuonghieu',
            'sp_gia',
            'sp_giakhuyenmai',
            'sp_soluong',
            'sp_soluongfake',
            'sp_soluotmua',
        ],
    ]) ?>

</div>
