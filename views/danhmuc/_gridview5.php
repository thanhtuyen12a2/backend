<?php
use aabc\helpers\Html;   
use aabc\grid\GridView;
use common\components\Tuyen;
use aabc\helpers\Url; /*Them*/
use aabc\helpers\ArrayHelper; /*Them*/
use aabc\widgets\ActiveForm;

$_Danhmuc = Aabc::$app->_model->Danhmuc;
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
                $class .= 'an ';
            }

            if($model[Aabc::$app->_danhmuc->dm_level] == 0 ){
                $class .= ' ';
            }elseif($model[Aabc::$app->_danhmuc->dm_level] == 1 ){
                $class .= 'lv-hide1 ';
            }else{
                $class .= 'lv-hide1 lv-hide2';
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
             // Aabc::$app->_danhmuc->dm_char,

               [                
                    'header' =>'Tiêu đề',  
                    // 'visible' => Aabc::$app->user->can('web'),            
                    'format' => 'raw',
                    // 'filterInputOptions' => [
                    //     'class' => 'form-control',                    
                    //  ],
                    'value' => function ($model) { 
                        if($model[Aabc::$app->_danhmuc->dm_level] == 0 ){
                            return '<h4>Nhóm thông số: '.Html::encode($model[Aabc::$app->_danhmuc->dm_char]).'</h4>';    
                        }elseif($model[Aabc::$app->_danhmuc->dm_level] == 1 ){
                            $icon = '';
                            if(!empty($model->dm_icon)){
                              $icon = explode('#',$model->dm_icon);
                              $icon = '<div class="g-icon"><div class="'.(empty($icon['1'])?'':$icon['1']).'">'.Tuyen::_icon($icon['0']) .'</div></div>';
                            }
                            return $icon.'<b style="line-height: 30px;">'.Html::encode($model[Aabc::$app->_danhmuc->dm_char]).'</b>';    
                        }else{
                            return '<i>'.Html::encode($model[Aabc::$app->_danhmuc->dm_char]).'</i>';
                        }
                        
                    }, 
                ],

            //  Aabc::$app->_danhmuc->dm_idcha,
            //  Aabc::$app->_danhmuc->dm_icon,
            //  Aabc::$app->_danhmuc->dm_background,
             
             // Aabc::$app->_danhmuc->dm_thutu,
             // Aabc::$app->_danhmuc->dm_sothutu,
             // Aabc::$app->_danhmuc->dm_level,
             // Aabc::$app->_danhmuc->dm_ghichu,
             // Aabc::$app->_danhmuc->dm_link,

            //  Aabc::$app->_danhmuc->dm_status,
            //  Aabc::$app->_danhmuc->dm_recycle,
            //  Aabc::$app->_danhmuc->dm_type,
            //  Aabc::$app->_danhmuc->dm_groupmenu,

             [
              'header' => 'Ghi chú',
                'value' => function ($model) use($_Danhmuc) {
                   return $model->dm_ghichu;
                }
             ],


            [
              'header' => 'Lực chọn',
                'value' => function ($model) use($_Danhmuc) {
                   if($model->dm_level == 1){
                      return $_Danhmuc::getMultiLabel($model->dm_multi);
                   }else{
                      return '';
                   }
                }
             ],



            [
              'header' => 'Tìm kiếm',
                'value' => function ($model) use($_Danhmuc) {
                   if($model->dm_level == 1){
                      return $_Danhmuc::getAllowsearchLabel($model->dm_allow_search);
                   }else{
                      return '';
                   }
                }
             ],



                
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

                    <button type="button"  '.Aabc::$app->d->m.'="3"  class="mb btn btn-default" '.Aabc::$app->d->i.'='.Aabc::$app->_model->__danhmuc.'  '.Aabc::$app->d->u.'="u_tn?id='.$model[Aabc::$app->_danhmuc->dm_id].'">'.Aabc::$app->MyConst->gridview_menu_suachitiet.'<span class="glyphicon glyphicon-pencil"></span></button>

                      <div class="gn"></div>'.

                      ($model[Aabc::$app->_danhmuc->dm_level] == 0  ? ('<button  '.Aabc::$app->d->m.'="3"  type="button" class="mb btn btn-default" '.Aabc::$app->d->i.'="'.Aabc::$app->_model->__danhmuc.'" '.Aabc::$app->d->u.'="c_tn?pa='.$model[Aabc::$app->_danhmuc->dm_id].'">Thêm thông số vào nhóm <b>'.$model['dm_ten'].'</b><span class="glyphicon glyphicon-plus"></span></button>') : '')
                      .''.

                      ($model[Aabc::$app->_danhmuc->dm_level] == 1  ? ('<button  '.Aabc::$app->d->m.'="3"  type="button" class="mb btn btn-default" '.Aabc::$app->d->i.'="'.Aabc::$app->_model->__danhmuc.'" '.Aabc::$app->d->u.'="c_tn?pa='.$model[Aabc::$app->_danhmuc->dm_id].'">Thêm giá trị cho thông số <b>'.$model['dm_ten'].'</b><span class="glyphicon glyphicon-plus"></span></button>') : '')

                      // if(){
                      //       echo '<h4>Nhóm: '.$model[Aabc::$app->_danhmuc->dm_char].'</h4>';    
                      //   }elseif($model[Aabc::$app->_danhmuc->dm_level] == 1 ){
                      //       echo '<b>'.$model[Aabc::$app->_danhmuc->dm_char].'</b> (Thông số)';    
                      //   }else{
                      //       echo '<i>'.$model[Aabc::$app->_danhmuc->dm_char].' (Giá trị</i>)';
                      //   }


                      .'<div class="gn"></div>


                     <button type="button" class="ml btn btn-default" '.Aabc::$app->d->i.'="'.Aabc::$app->_model->__danhmuc.'" '.Aabc::$app->d->u.'="ut_tn?id='.$model[Aabc::$app->_danhmuc->dm_id].'&t=u">'.Aabc::$app->MyConst->gridview_menu_up.'<span class="glyphicon glyphicon-triangle-top"></span></button>

                     <button type="button" class="ml btn btn-default" '.Aabc::$app->d->i.'="'.Aabc::$app->_model->__danhmuc.'" '.Aabc::$app->d->u.'="ut_tn?id='.$model[Aabc::$app->_danhmuc->dm_id].'">'.Aabc::$app->MyConst->gridview_menu_down.'<span class="glyphicon glyphicon-triangle-bottom"></span></button>


                    <div class="gn"></div>
                                       
                    <button type="button" class="br btn btn-default"  '.Aabc::$app->d->type.'="_tn"  '.Aabc::$app->d->i.'='.Aabc::$app->_model->__danhmuc.'  '.Aabc::$app->d->u.'="rec_tn?id='.$model[Aabc::$app->_danhmuc->dm_id].'">'.Aabc::$app->MyConst->gridview_menu_thungrac.'<span class="glyphicon glyphicon-trash"></span></button>

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

     <?= Html::button(Aabc::$app->MyConst->gridview_selectmultiitem_thuchien, [Aabc::$app->d->i => Aabc::$app->_model->__danhmuc, Aabc::$app->d->u =>'reca_tn', Aabc::$app->d->type => '_tn','class' => 'btn btn-default bra', 'method' => 'POST']) ?>
</div>

</div>