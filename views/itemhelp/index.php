<?php

use aabc\helpers\Html;   
use aabc\grid\GridView;

use aabc\bootstrap\Modal; /*Them*/
use aabc\helpers\Url; /*Them*/
use aabc\helpers\ArrayHelper; /*Them*/
use aabc\widgets\ActiveForm;
/*use app\models\Dskh; */


/* @var $this aabc\web\View */
// use backend\models\ItemhelpSearch ;
 use backend\models\Itemhelp ;
 use backend\models\Grouphelp ;
/* @var $dataProvider aabc\data\ActiveDataProvider */

$this->title = 'Itemhelps';
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="pjitemhelp" d-i="itemhelp" class="pj">
<div class="itemhelp-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p  class="col-md-2" >
        <button type="button" d-m="2" id="mbitemhelp" d-u="create" class="btn btn-default mb" d-i="itemhelp"><span class="glyphicon glyphicon-plus mxanh"></span>Thêm</button>
        </p>
    <div class="col-md-10">
        <?php
         $gh = Grouphelp::find()->all(); 
          array_unshift($gh,[
                        'gh_id' => '',
                        'gh_ten' =>'---Chọn---',
                    ]);//Thêm vào đầu 
         echo Html::dropDownList('grouphelp', Aabc::$app->request->get('grouphelp') != NULL ? Aabc::$app->request->get('grouphelp') : ['' => Aabc::$app->MyConst->vindex_search_chon], ArrayHelper::map($gh, 'gh_id', 'gh_ten'), [
                        'd-ty' => 'ra',
                        'd-i' => 'itemhelp',
                        'd-s' => 'rel',
                        'class' => 'mulr',
                        'd-c' => 'one',
                        'id' => 'itemhelp_grouphelp'
                    ]);

        ?>
    </div>
    <div class="col-md-12">
    <?= GridView::widget([ 
        'id' => 'gritemhelp',
        'options' => ['class' => 'gr'],
        'emptyText' => Aabc::$app->MyConst->gridview_khongthayketqua,
        'summary' => "<div class='sy'>(Từ {begin} - {end} trong {totalCount})</div>",
        'dataProvider' => $dataProvider,
        'rowOptions' => function($model){            
            $class = '';
           
            return ['class'=>$class];
        },
        //'filterModel' => $searchModel,
        'columns' => [


         [
            'class' => 'aabc\grid\CheckboxColumn',             
                'checkboxOptions' => function($model) {                  
                   return ['value' => $model->ih_id];                    
                },
                'headerOptions' => ['width' => '32'],
                'cssClass' => 'ca',
                'name' => 'tuyen', 
          ],

     


            'ih_sothutu',



            'ih_ten',
            'ih_noidung:ntext',
            'ih_focus',
            'ih_action',
            'ih_check',
            
            
            // 'ih_sothutu',
            'ih_id_grouphelp',
                     

             [                
                //'header' => '<a href="'.Aabc::$app->homeUrl.'sanpham">Reset</a>',
                'attribute' => 'ih_id',
                //'headerOptions' => ['width' => '100'],                 
                'contentOptions' => [
                    'class' => 'omb',                    
                ],
                'format' => 'raw',
                'value' => function ($model) {                         
                    return '<div>'.$model->ih_id.'</div><div class="omc" id="itemhelp'.$model->ih_id.'"><div class="omd">

                    <button type="button" d-m="2" class="mb btn btn-default" d-i="itemhelp" d-u="update?id='.$model->ih_id.'">'.Aabc::$app->MyConst->gridview_menu_suachitiet.'<span class="glyphicon glyphicon-pencil"></span></button>

                    <div class="gn"></div>
                   
                    <button type="button" class="br btn btn-default" d-i="itemhelp" d-u="updatethutu?id='.$model->ih_id.'&t=u">'.Aabc::$app->MyConst->gridview_menu_up.'<span class="glyphicon glyphicon-triangle-top"></span></button>

                     <button type="button" class="br btn btn-default" d-i="itemhelp" d-u="updatethutu?id='.$model->ih_id.'&t=d">'.Aabc::$app->MyConst->gridview_menu_down.'<span class="glyphicon glyphicon-triangle-bottom"></span></button>

                    </div></div>';                                      
                }, 
            ],

        


        ],


         //« » ‹ ›
        'pager' => [
            'firstPageLabel' => '«',
            'prevPageLabel'  => '‹',
            'nextPageLabel' => '›',
            'lastPageLabel' => '»',

            'maxButtonCount'=>3, // Số page hiển thị ví dụ: (First  1 2 3 Last)
        ],

 ]); ?>

 </div>
   

<div class="endgr col-md-12">

<div class='per-page'>

<?= 
Html::dropDownList('t', Aabc::$app->request->get('t') != NULL ? Aabc::$app->request->get('t') : [10 => 10], [10 => 10, 20 => 20, 50 => 50, 100 => 100, 200 => 200], [    
    'class' => 'btn btn-default',
    'id' => 'ipage'
])?></div>

<div class="sy0"></div>

 <div class='cas'>

     <select id="selitemhelp" class="btn btn-default">
         <option value="" selected="">--Chọn thao tác--</option>            
    </select>

    <?= Html::button(Aabc::$app->MyConst->gridview_selectmultiitem_thuchien, ['d-i'=>'itemhelp','d-u'=>'recycleall','class' => 'btn btn-default bra', 'method' => 'POST']) ?>
</div>

</div>
<div style="clear: both"></div>

    <?php
 //Lên đầu trang khi next page
$this->registerJs(  
    " 
// selectmur('sanpham','radio','itemhelp_grouphelp');

// changea('itemhelp');

// footertable('itemhelp');

//headertable('itemhelp');

chaheicliaft('itemhelp');

")
?>

</div>

</div>
