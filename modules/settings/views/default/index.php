<?php
/**
 * @link http://phe.me
 * @copyright Copyright (c) 2014 Pheme
 * @license MIT http://opensource.org/licenses/MIT
 */

use aabc\helpers\Html;
use aabc\grid\GridView;
use backend\modules\settings\Module;
use backend\modules\settings\models\Setting;
use aabc\helpers\ArrayHelper;
use aabc\widgets\Pjax;

/**
 * @var aabc\web\View $this
 * @var backend\modules\settings\models\SettingSearch $searchModel
 * @var aabc\data\ActiveDataProvider $dataProvider
 */

$this->title = Module::t('settings', 'Settings');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="setting-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php //echo $this->render('_search', ['model' => $searchModel]);?>

    <p>
        <?=
        Html::a(
            Module::t(
                'settings',
                'Create {modelClass}',
                [
                    'modelClass' => Module::t('settings', 'Setting'),
                ]
            ),
            ['create'],
            ['class' => 'btn btn-success']
        ) ?>
    </p>
    <?php Pjax::begin(); ?>
    <?=
    GridView::widget(
        [
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                'id',
                //'type',
                [
                    'attribute' => 'section',
                    'filter' => ArrayHelper::map(
                        Setting::find()->select('section')->distinct()->where(['<>', 'section', ''])->all(),
                        'section',
                        'section'
                    ),
                ],
                'key',
                'value:ntext',
                // [
                //     'class' => '\backend\modules\grid\ToggleColumn',
                //     'attribute' => 'active',
                //     'filter' => [1 => Aabc::t('aabc', 'Yes'), 0 => Aabc::t('aabc', 'No')],
                // ],
                ['class' => 'aabc\grid\ActionColumn'],
            ],
        ]
    ); ?>
    <?php Pjax::end(); ?>
</div>
