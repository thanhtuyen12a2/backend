<?php

use aabc\helpers\Html;
use aabc\widgets\DetailView;

/* @var $this aabc\web\View */
/* @var $model backend\models\Itemhelp */

$this->title = $model->ih_id;
$this->params['breadcrumbs'][] = ['label' => 'Itemhelps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="itemhelp-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ih_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ih_id], [
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
            'ih_id',
            'ih_action',
            'ih_check',
            'ih_focus',
            'ih_noidung:ntext',
            'ih_sothutu',
            'ih_id_grouphelp',
        ],
    ]) ?>

</div>
