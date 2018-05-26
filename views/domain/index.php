<?php

use aabc\helpers\Html;   
use aabc\grid\GridView;

//use aabc\bootstrap\Modal; /*Them*/
use aabc\helpers\Url; /*Them*/
use aabc\helpers\ArrayHelper; /*Them*/
use aabc\widgets\ActiveForm;
/*use app\models\Dskh; */


/* @var $this aabc\web\View */
// use backend\models\DomainSearch ;
 use backend\models\Domain ;
/* @var $dataProvider aabc\data\ActiveDataProvider */

$this->title = 'Domains';
$this->params['breadcrumbs'][] = $this->title;
?>

<div id="pjdomain" d-i="domain" class="pj">


<div class="domain-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


<p>  
        
        <button type="button"  d-m="2" id="mbdomain" d-u="create" class="btn btn-default mb" d-i="domain"><span class="glyphicon glyphicon-plus mxanh"></span><?=Aabc::$app->MyConst->view_btn_them?></button>
  

         <?php         
        $demthungrac = count(Domain::getAllRecycle1());

            echo '<button type="button"  d-m="2"  '.($demthungrac > 0 ? : 'disabled').'  id="mbdomainr" d-u="indexrecycle" class="btn btn-default mb" d-i="domain"><span class="glyphicon glyphicon-trash mden"></span>'.Aabc::$app->MyConst->view_btn_thungrac.' ('.$demthungrac.')</button>';
        
        ?>



    </p>



    <?= GridView::widget([ 
        'id' => 'grdomain',
        'options' => ['class' => 'gr'],
        'emptyText' => Aabc::$app->MyConst->gridview_khongthayketqua,
        'summary' => "<div class='sy'>(Từ {begin} - {end} trong {totalCount})</div>",
        'dataProvider' => $dataProvider,
        'rowOptions' => function($model){            
            $class = '';
            if ($model[Aabc::$app->domain->dm_status] == '2'){
                $class = 'an';
            }
            return ['class'=>$class];
        },
        //'filterModel' => $searchModel,
        'columns' => [


         [
            'class' => 'aabc\grid\CheckboxColumn',             
                'checkboxOptions' => function($model) {                  
                   return ['value' => $model[Aabc::$app->domain->dm_id]];                    
                },
                'headerOptions' => ['width' => '32'],
                'cssClass' => 'ca',
                'name' => 'tuyen', 
          ],

     


             // Aabc::$app->domain->dm_id,
             Aabc::$app->domain->dm_domain,
             Aabc::$app->domain->dm_chude,
             Aabc::$app->domain->dm_length,
             Aabc::$app->domain->dm_status,
            //  Aabc::$app->domain->dm_recycle,
             
                     

             [                
                //'header' => '<a href="'.Aabc::$app->homeUrl.'sanpham">Reset</a>',
                'attribute' => Aabc::$app->domain->dm_id,
                //'headerOptions' => ['width' => '100'],                 
                'contentOptions' => [
                    'class' => 'omb',                    
                ],
                'format' => 'raw',
                'value' => function ($model) {                         
                    return '<div>'.$model[Aabc::$app->domain->dm_id].'</div><div class="omc" id="domain'.$model[Aabc::$app->domain->dm_id].'"><div class="omd">

                    <button type="button"  d-m="2"  class="mb btn btn-default" d-i="domain" d-u="update?id='.$model[Aabc::$app->domain->dm_id].'">'.Aabc::$app->MyConst->gridview_menu_suachitiet.'<span class="glyphicon glyphicon-pencil"></span></button>

                    <div class="gn"></div>
                    '.                        
                        (Aabc::$app->user->can('web') ?  ($model[Aabc::$app->domain->dm_status] == 2 ? '<button type="button" class="ml btn btn-default" d-i="domain" d-u="updatestatus?id='.$model[Aabc::$app->domain->dm_id].'">'.Aabc::$app->MyConst->gridview_menu_hienthi.'<span class="glyphicon glyphicon-eye-open"></span></button>' : '<button type="button" class="ml btn btn-default" d-i="domain" d-u="updatestatus?id='.$model[Aabc::$app->domain->dm_id].'">'.Aabc::$app->MyConst->gridview_menu_an.'<span class="glyphicon glyphicon-eye-open"></span></button>') : "" )

                    .'
                    <button type="button" class="br btn btn-default" d-i="domain" d-u="recycle?id='.$model[Aabc::$app->domain->dm_id].'">'.Aabc::$app->MyConst->gridview_menu_thungrac.'<span class="glyphicon glyphicon-trash"></span></button>

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


   

<div class="endgr">

<div class='per-page'>

<?= 
Html::dropDownList('t', Aabc::$app->request->get('t') != NULL ? Aabc::$app->request->get('t') : [10 => 10], [10 => 10, 20 => 20, 50 => 50, 100 => 100, 200 => 200], [    
    'class' => 'ipage btn btn-default',
    'id' => ''
])?></div>



 <div class='cas'>

     <select id="seldomain" class="btn btn-default">
         <option value="" selected="">--Chọn thao tác--</option>
                  <option value="1"><?=Aabc::$app->MyConst->gridview_selectmultiitem_an?></option>
        <option value="2"><?=Aabc::$app->MyConst->gridview_selectmultiitem_hienthi?></option>
                <option value="3"><?=Aabc::$app->MyConst->gridview_selectmultiitem_thungrac?></option>      
    </select>

    <?= Html::button(Aabc::$app->MyConst->gridview_selectmultiitem_thuchien, ['d-i'=>'domain','d-u'=>'recycleall','class' => 'btn btn-default bra', 'method' => 'POST']) ?>
</div>

</div>
<div style="clear: both"></div>

    <?php
 //Lên đầu trang khi next page
$this->registerJs(  
    " 
 
//changea('domain');

//footertable('domain');

//headertable('domain');


")
?>


</div>
