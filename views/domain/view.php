<?php

use aabc\helpers\Html;
use aabc\widgets\DetailView;

/* @var $this aabc\web\View */
/* @var $model backend\models\Domain */

$this->title = $model->dm_id;
$this->params['breadcrumbs'][] = ['label' => 'Domains', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="domain-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php // Html::a('Update', ['update', 'id' => $model[Aabc::$app->->dm_id]], ['class' => 'btn btn-primary']) ?>
        <?php
        // Html::a('Delete', ['delete', 'id' => $model[Aabc::$app->->dm_id]], [
        //     'class' => 'btn btn-danger',
        //     'data' => [
        //         'confirm' => 'Are you sure you want to delete this item?',
        //         'method' => 'post',
        //     ],
        // ])
        ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'dm_id',
            'dm_domain',
            'dm_length',
            'dm_status',
            'dm_recycle',
            'dm_tiemnang',
            'dm_chude',
            'dm_email:email',
        ],
    ]) ?>

</div>
