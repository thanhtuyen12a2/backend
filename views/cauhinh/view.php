<?php

use aabc\helpers\Html;
use aabc\widgets\DetailView;

/* @var $this aabc\web\View */
/* @var $model backend\models\Cauhinh */

$this->title = $model->ch_id;
$this->params['breadcrumbs'][] = ['label' => Aabc::t('app', 'Cauhinhs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cauhinh-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Aabc::t('app', 'Update'), ['update', 'id' => $model[Aabc::$app->_->ch_id]], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Aabc::t('app', 'Delete'), ['delete', 'id' => $model[Aabc::$app->_->ch_id]], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Aabc::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ch_id',
            'ch_key',
            'ch_data:ntext',
        ],
    ]) ?>

</div>
