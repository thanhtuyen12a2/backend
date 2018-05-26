<?php
use aabc\helpers\Html;   
use aabc\grid\GridView;

use aabc\helpers\Url; /*Them*/
use aabc\helpers\ArrayHelper; /*Them*/
use aabc\widgets\ActiveForm;

?>





    <?= GridView::widget([ 
        'id' => 'gr'.Aabc::$app->_model->__chinhsach,
        'options' => ['class' => 'gr'],
        'emptyText' => Aabc::$app->MyConst->gridview_khongthayketqua,
        'summary' => "<div class='sy'>(Từ {begin} - {end} trong {totalCount})</div>",
        'dataProvider' => $dataProvider,
        'rowOptions' => function($model){            
            $class = '';
            if ($model[Aabc::$app->_chinhsach->cs_status] == '2'){
                $class = 'an';
            }
            return ['class'=>$class];
        },
        //'filterModel' => $searchModel,
        'columns' => [


         [
            'class' => 'aabc\grid\CheckboxColumn',             
                'checkboxOptions' => function($model) {                  
                   return ['value' => $model[Aabc::$app->_chinhsach->cs_id]];                    
                },
                'headerOptions' => ['width' => '32'],
                'cssClass' => 'ca',
                'name' => 'tuyen', 
          ],

     


             // Aabc::$app->_chinhsach->cs_id,
             // Aabc::$app->_chinhsach->cs_type,
             Aabc::$app->_chinhsach->cs_ten,
            //  Aabc::$app->_chinhsach->cs_code,
             Aabc::$app->_chinhsach->cs_ghichu,
            //  Aabc::$app->_chinhsach->cs_typetyle,
            //  Aabc::$app->_chinhsach->cs_tylechietkhau,
            //  Aabc::$app->_chinhsach->cs_apdungcho,
            //  Aabc::$app->_chinhsach->cs_dieukien,
            //  Aabc::$app->_chinhsach->cs_noidungdieukien,
             Aabc::$app->_chinhsach->cs_status,
            //  Aabc::$app->_chinhsach->cs_recycle,
            //  Aabc::$app->_chinhsach->cs_ngaytao,
            //  Aabc::$app->_chinhsach->cs_ngaybatdau,
            //  Aabc::$app->_chinhsach->cs_ngayketthuc,
                     

             [                
                //'header' => '<a href="'.Aabc::$app->homeUrl.'sanpham">Reset</a>',
                'attribute' => Aabc::$app->_chinhsach->cs_id,
                //'headerOptions' => ['width' => '100'],                 
                'contentOptions' => [
                    'class' => 'omb',                    
                ],
                'format' => 'raw',
                'value' => function ($model) {                         
                    return '<div>'.$model[Aabc::$app->_chinhsach->cs_id].'</div><div class="omc" id="'.Aabc::$app->_model->__chinhsach.$model[Aabc::$app->_chinhsach->cs_id].'"><div class="omd">

                    <button type="button"  '.Aabc::$app->d->m.'="2"  class="mb btn btn-default" '.Aabc::$app->d->i.'='.Aabc::$app->_model->__chinhsach.'  '.Aabc::$app->d->u.'="u?id='.$model[Aabc::$app->_chinhsach->cs_id].'">'.Aabc::$app->MyConst->gridview_menu_suachitiet.'<span class="glyphicon glyphicon-pencil"></span></button>

                    <div class="gn"></div>
                    '.                        
                        (Aabc::$app->user->can('web') ?  ($model[Aabc::$app->_chinhsach->cs_status] == 2 ? '<button type="button" class="ml btn btn-default" '.Aabc::$app->d->i.'='.Aabc::$app->_model->__chinhsach.'   '.Aabc::$app->d->u.'="us?id='.$model[Aabc::$app->_chinhsach->cs_id].'">'.Aabc::$app->MyConst->gridview_menu_hienthi.'<span class="glyphicon glyphicon-eye-open"></span></button>' : '<button type="button" class="ml btn btn-default" '.Aabc::$app->d->i.'='.Aabc::$app->_model->__chinhsach.'   '.Aabc::$app->d->u.'="us?id='.$model[Aabc::$app->_chinhsach->cs_id].'">'.Aabc::$app->MyConst->gridview_menu_an.'<span class="glyphicon glyphicon-eye-open"></span></button>') : "" )

                    .'
                    <button type="button" class="br btn btn-default" '.Aabc::$app->d->i.'='.Aabc::$app->_model->__chinhsach.'  '.Aabc::$app->d->u.'="rec?id='.$model[Aabc::$app->_chinhsach->cs_id].'">'.Aabc::$app->MyConst->gridview_menu_thungrac.'<span class="glyphicon glyphicon-trash"></span></button>

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


  
