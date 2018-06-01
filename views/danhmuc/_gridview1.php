<?php
use aabc\helpers\Html;   
use aabc\grid\GridView;

use aabc\helpers\Url; /*Them*/
use aabc\helpers\ArrayHelper; /*Them*/
use aabc\widgets\ActiveForm;

?>



    <?= GridView::widget([ 
        'id' => 'gr'.Aabc::$app->_model->__danhmuc,
        'options' => ['class' => 'gr'],
        'emptyText' => Aabc::$app->MyConst->gridview_khongthayketqua,
        'summary' => "<div class='sy'>(Từ {begin} - {end} trong {totalCount})</div>",
        'dataProvider' => $dataProvider,
        'rowOptions' => function($model){            
            $class = '';
            if ($model[Aabc::$app->_danhmuc->dm_status] == '2'){
                $class = 'an';
            }
            return ['class'=>$class];
        },
        //'filterModel' => $searchModel,
        'columns' => [


         [
            'class' => 'aabc\grid\CheckboxColumn',             
                'checkboxOptions' => function($model) {                  
                   return ['value' => $model[Aabc::$app->_danhmuc->dm_id]];                    
                },
                'headerOptions' => ['width' => '32'],
                'cssClass' => 'ca',
                'name' => 'tuyen', 
          ],

     


             // Aabc::$app->_danhmuc->dm_id,
             // Aabc::$app->_danhmuc->dm_ten,
             

              [                
                  'header' => 'Danh mục sản phẩm',                    
                  'format' => 'raw',                  
                  'value' => function ($model) { 
                      if($model[Aabc::$app->_danhmuc->dm_level] == 0 ){
                          return '<b>'.Html::encode($model[Aabc::$app->_danhmuc->dm_char]).'</b>';    
                      }else{
                          return Html::encode($model[Aabc::$app->_danhmuc->dm_char]);    
                      }
                      
                  }, 
              ],

            //  Aabc::$app->_danhmuc->dm_idcha,
            //  Aabc::$app->_danhmuc->dm_icon,
            //  Aabc::$app->_danhmuc->dm_background,
             
               [                
                  'header' => 'Thứ tự',                    
                  'format' => 'raw',                  
                  'value' => function ($model) { 
                      
                          return Html::encode($model[Aabc::$app->_danhmuc->dm_thutu]);    
                                            
                  }, 
              ],

             // Aabc::$app->_danhmuc->dm_thutu,
             // Aabc::$app->_danhmuc->dm_sothutu,
             // Aabc::$app->_danhmuc->dm_ghichu,
             Aabc::$app->_danhmuc->dm_link,
            //  Aabc::$app->_danhmuc->dm_status,
            //  Aabc::$app->_danhmuc->dm_recycle,
            //  Aabc::$app->_danhmuc->dm_type,
            //  Aabc::$app->_danhmuc->dm_groupmenu,
                     

             [                
                //'header' => '<a href="'.Aabc::$app->homeUrl.'sanpham">Reset</a>',
                'attribute' => Aabc::$app->_danhmuc->dm_id,
                //'headerOptions' => ['width' => '100'],                 
                'contentOptions' => [
                    'class' => 'omb',                    
                ],
                'format' => 'raw',
                'value' => function ($model) {                         
                    return '<div>'.$model[Aabc::$app->_danhmuc->dm_id].'</div><div class="omc" id="'.Aabc::$app->_model->__danhmuc.$model[Aabc::$app->_danhmuc->dm_id].'"><div class="omd">

                    <button type="button"  '.Aabc::$app->d->m.'="2"  class="mb btn btn-default" '.Aabc::$app->d->i.'='.Aabc::$app->_model->__danhmuc.'  '.Aabc::$app->d->u.'="u?id='.$model[Aabc::$app->_danhmuc->dm_id].'">'.Aabc::$app->MyConst->gridview_menu_suachitiet.'<span class="glyphicon glyphicon-pencil"></span></button>

                      <div class="gn"></div>

                     <button type="button" class="ml btn btn-default" '.Aabc::$app->d->i.'="'.Aabc::$app->_model->__danhmuc.'" '.Aabc::$app->d->u.'="ut?id='.$model[Aabc::$app->_danhmuc->dm_id].'&t=u">'.Aabc::$app->MyConst->gridview_menu_up.'<span class="glyphicon glyphicon-triangle-top"></span></button>

                     <button type="button" class="ml btn btn-default" '.Aabc::$app->d->i.'="'.Aabc::$app->_model->__danhmuc.'" '.Aabc::$app->d->u.'="ut?id='.$model[Aabc::$app->_danhmuc->dm_id].'">'.Aabc::$app->MyConst->gridview_menu_down.'<span class="glyphicon glyphicon-triangle-bottom"></span></button>


                    <div class="gn"></div>
                    '.                        
                        (Aabc::$app->user->can('web') ?  ($model[Aabc::$app->_danhmuc->dm_status] == 2 ? '<button type="button" class="ml btn btn-default" '.Aabc::$app->d->i.'='.Aabc::$app->_model->__danhmuc.'   '.Aabc::$app->d->u.'="us?id='.$model[Aabc::$app->_danhmuc->dm_id].'">'.Aabc::$app->MyConst->gridview_menu_hienthi.'<span class="glyphicon glyphicon-eye-open"></span></button>' : '<button type="button" class="ml btn btn-default" '.Aabc::$app->d->i.'='.Aabc::$app->_model->__danhmuc.'   '.Aabc::$app->d->u.'="us?id='.$model[Aabc::$app->_danhmuc->dm_id].'">'.Aabc::$app->MyConst->gridview_menu_an.'<span class="glyphicon glyphicon-eye-open"></span></button>') : "" )

                    .'
                    <button type="button" class="br btn btn-default" '.Aabc::$app->d->i.'='.Aabc::$app->_model->__danhmuc.'  '.Aabc::$app->d->u.'="rec?id='.$model[Aabc::$app->_danhmuc->dm_id].'">'.Aabc::$app->MyConst->gridview_menu_thungrac.'<span class="glyphicon glyphicon-trash"></span></button>

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

            'maxButtonCount'=>1, // Số page hiển thị ví dụ: (First  1 2 3 Last)
        ],

 ]); ?>

<div class="endgr">

<div class='per-page'>

<?= 
Html::dropDownList('t', Aabc::$app->request->get('t') != NULL ? Aabc::$app->request->get('t') : [10 => 10], [10 => 10, 20 => 20, 50 => 50, 100 => 100, 200 => 200], [    
    'class' => 'ipage btn btn-default',
    'id' => ''
])?></div>

<div class="sy0"></div>

 <div class='cas'>

     <select id="sel<?= Aabc::$app->_model->__danhmuc?>" class="btn btn-default">
         <option value="" selected="">--Chọn thao tác--</option>
                  <option value="1"><?=Aabc::$app->MyConst->gridview_selectmultiitem_an?></option>
        <option value="2"><?=Aabc::$app->MyConst->gridview_selectmultiitem_hienthi?></option>
                <option value="3"><?=Aabc::$app->MyConst->gridview_selectmultiitem_thungrac?></option>      
    </select>

     <?= Html::button(Aabc::$app->MyConst->gridview_selectmultiitem_thuchien, [Aabc::$app->d->i => Aabc::$app->_model->__danhmuc, Aabc::$app->d->u =>'reca','class' => 'btn btn-default bra', 'method' => 'POST']) ?>
</div>

</div>