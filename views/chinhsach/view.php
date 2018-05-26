<?php

use aabc\helpers\Html;
use aabc\widgets\DetailView;

/* @var $this aabc\web\View */
/* @var $model backend\models\Chinhsach */

$this->title = $model->cs_id;
$this->params['breadcrumbs'][] = ['label' => 'Chinhsaches', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="chinhsach-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model[Aabc::$app->_->cs_id]], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model[Aabc::$app->_->cs_id]], [
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
            'cs_id',
            'cs_type',
            'cs_ten',
            'cs_code',
            'cs_ghichu',
            'cs_typetyle',
            'cs_tylechietkhau',
            'cs_apdungcho',
            'cs_dieukien',
            'cs_noidungdieukien',
            'cs_status',
            'cs_recycle',
            'cs_ngaytao',
            'cs_ngaybatdau',
            'cs_ngayketthuc',
        ],
    ]) ?>

</div>
