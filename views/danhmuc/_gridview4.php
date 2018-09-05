<?php
use aabc\helpers\Html;   
use aabc\grid\GridView;

use aabc\helpers\Url; /*Them*/
use aabc\helpers\ArrayHelper; /*Them*/
use aabc\widgets\ActiveForm;
use common\components\Tuyen;

$g = isset($_GET['g'])?$_GET['g']: 0;
if(in_array($g,[241])){
  $show_mini = 1;
}else{
  $show_mini = 0;
}

?>
<style type="text/css">
    h5{
      font-size: 14px;
      color: #434546;
    }

    <?php if($show_mini){ ?>
      .price-ship {
          width: calc(100% - 32px - 50px) !important;
      }
      
      .mini-chi{
        width: 50px;
      }
      .mini-chi>span {      
          padding: 10px;
          cursor: pointer;
      }

    <?php } ?>
</style>

<?php if($show_mini){ ?>
  <script type="text/javascript">
    $('.mini-chi>span').on('click',function(){
       var _this = $(this), new_class = '', remove_class = '', pa = _this.data('pa');
       if(_this.hasClass('glyphicon-chevron-right')){
          new_class = 'glyphicon-chevron-down';
          remove_class = 'glyphicon-chevron-right';
          $('.mini-chi-'+pa).removeClass('hide')
       }
       if(_this.hasClass('glyphicon-chevron-down')){
          new_class = 'glyphicon-chevron-right';
          remove_class = 'glyphicon-chevron-down';
          $('.mini-chi-'+pa).addClass('hide')
       }
       _this.removeClass(remove_class)
       _this.addClass(new_class)

    })
  </script>
<?php } ?>



    <?= GridView::widget([ 
        'id' => 'gr'.Aabc::$app->_model->__danhmuc,
        'options' => ['class' => 'gr'],
        'emptyText' => Aabc::$app->MyConst->gridview_khongthayketqua,
        'summary' => "<div class='sy'>(Từ {begin} - {end} trong {totalCount})</div>",
        'dataProvider' => $dataProvider,
        'rowOptions' => function($model) use($show_mini) {            
            $class = '';
            if ($model[Aabc::$app->_danhmuc->dm_status] == '2'){
                $class .= ' an';
            }

            if($show_mini && !empty($model->dm_level)){
               $class .= ' mini-chi-ite hide mini-chi-'.$model->dm_idcha .' '; //Mini child item
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

     
        //   [
        //     'class' => 'aabc\grid\SerialColumn',
        //     'headerOptions' => ['width' => '50'],
        //     // you may configure additional properties here
        // ],


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
                        $icon = '';
                        if(!empty($model->dm_icon)){
                          $icon = explode('#',$model->dm_icon);
                          $icon = '<div class="g-icon"><div class="'.(empty($icon['1'])?'':$icon['1']).'">'.Tuyen::_icon($icon['0']) .'</div></div>';
                        }

                        $background = empty($model->dm_background)?'':$model->dm_background;
                        if(!empty($background)){                                
                            $img = '';                                
                            $img = Tuyen::_dulieu('image',$background,'75x75');                            
                            if(!empty($img)){                                            
                                $background = '<img class="pull-left" src="'.$img.'" />';
                            }
                        }         

                        $tieude = Tuyen::_show_title($model);                        

                        $char = '|----- ';

                        if($model[Aabc::$app->_danhmuc->dm_level] == 0 ){                            
                            return $icon.$background.'<h5><b>'.Html::encode($tieude).'</b></h5>';
                        }elseif($model[Aabc::$app->_danhmuc->dm_level] == 1 ){
                            return '<b>'.$icon.$background.$char.Html::encode($tieude).'</b>';    
                        }else{
                            return '<i>'.$icon.$background.$char.$char.Html::encode($tieude).'</i>';
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

               [
                  'attribute' => 'dm_price',
                  'label' => 'Phí ship',
                  'visible' => ($g == 241),                
                  'value' => function($model){
                    return (number_format($model->dm_price));
                  }
               ],



             [
                'header' => 'link',
                'visible' => ($g != 241),                
                'value' => function($model){
                  return (json_encode($model->dm_link));
                }
             ],

             // Aabc::$app->_danhmuc->dm_link,
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
                'value' => function ($model) use($show_mini) {                         
                    return '<div>'.$model[Aabc::$app->_danhmuc->dm_id].'</div><div class="omc '.($show_mini?'price-ship':'').'" id="'.Aabc::$app->_model->__danhmuc.$model[Aabc::$app->_danhmuc->dm_id].'"><div class="omd">

                    <button type="button"  '.Aabc::$app->d->m.'="3"  class="mb btn btn-default" '.Aabc::$app->d->i.'='.Aabc::$app->_model->__danhmuc.'  '.Aabc::$app->d->u.'="u_mn?id='.$model[Aabc::$app->_danhmuc->dm_id].'">'.Aabc::$app->MyConst->gridview_menu_suachitiet.'<span class="glyphicon glyphicon-pencil"></span></button>

                      <div class="gn"></div>'.

                     '<button  '.Aabc::$app->d->m.'="3"  type="button" class="mb btn btn-default" '.Aabc::$app->d->i.'="'.Aabc::$app->_model->__danhmuc.'" '.Aabc::$app->d->u.'="c_mn?pa='.$model[Aabc::$app->_danhmuc->dm_id].'">Thêm mục con<span class="glyphicon glyphicon-plus"></span></button>'
                     

                      // if(){
                      //       echo '<h4>Nhóm: '.$model[Aabc::$app->_danhmuc->dm_char].'</h4>';    
                      //   }elseif($model[Aabc::$app->_danhmuc->dm_level] == 1 ){
                      //       echo '<b>'.$model[Aabc::$app->_danhmuc->dm_char].'</b> (Thông số)';    
                      //   }else{
                      //       echo '<i>'.$model[Aabc::$app->_danhmuc->dm_char].' (Giá trị</i>)';
                      //   }


                      .'<div class="gn"></div>


                     <button type="button" class="ml btn btn-default" '.Aabc::$app->d->i.'="'.Aabc::$app->_model->__danhmuc.'" '.Aabc::$app->d->u.'="ut_mn?id='.$model[Aabc::$app->_danhmuc->dm_id].'&t=u">'.Aabc::$app->MyConst->gridview_menu_up.'<span class="glyphicon glyphicon-triangle-top"></span></button>

                     <button type="button" class="ml btn btn-default" '.Aabc::$app->d->i.'="'.Aabc::$app->_model->__danhmuc.'" '.Aabc::$app->d->u.'="ut_mn?id='.$model[Aabc::$app->_danhmuc->dm_id].'">'.Aabc::$app->MyConst->gridview_menu_down.'<span class="glyphicon glyphicon-triangle-bottom"></span></button>


                    <div class="gn"></div>
                   
                    <button type="button" class="br btn btn-default"  '.Aabc::$app->d->type.'="_mn"  '.Aabc::$app->d->i.'='.Aabc::$app->_model->__danhmuc.'  '.Aabc::$app->d->u.'="rec_mn?id='.$model[Aabc::$app->_danhmuc->dm_id].'">'.Aabc::$app->MyConst->gridview_menu_thungrac.'<span class="glyphicon glyphicon-trash"></span></button>

                    </div></div>';                                      
                }, 
            ],

        
            [
                'header' => '',
                'visible' => $show_mini,
                'contentOptions' => [
                    'class' => 'mini-chi',
                ],
                'format' => 'raw',
                'value' => function ($model) { 
                    if($model->dm_level == 0)
                      return '<span data-pa="'.$model->dm_id.'" class="glyphicon glyphicon-chevron-right"></span>'; //Mini child
                    return '';
                }
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

     <?= Html::button(Aabc::$app->MyConst->gridview_selectmultiitem_thuchien, [Aabc::$app->d->i => Aabc::$app->_model->__danhmuc, Aabc::$app->d->u =>'reca_mn', Aabc::$app->d->type => '_mn','class' => 'btn btn-default bra', 'method' => 'POST']) ?>
</div>

</div>