<?php


use aabc\helpers\Html;
use backend\modules\settings\Module;

/**
 * @var yii\web\View $this
 * @var pheme\settings\models\Setting $model
 */

$this->title = Module::t(
        'settings',
        'Update {modelClass}: ',
        [
            'modelClass' => Module::t('settings', 'Setting'),
        ]
    ) . ' ' . $model->section. '.' . $model->key;

$this->params['breadcrumbs'][] = ['label' => Module::t('settings', 'Settings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Module::t('settings', 'Update');

?>
<div class="setting-update">


    <?=
    $this->render(
        '_form',
        [
            'model' => $model,
        ]
    ) ?>

</div>
