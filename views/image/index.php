<?php

use aabc\helpers\Html;   
use aabc\grid\GridView;

//use aabc\bootstrap\Modal; /*Them*/
use aabc\helpers\Url; /*Them*/
use aabc\helpers\ArrayHelper; /*Them*/
use aabc\widgets\ActiveForm;
/*use app\models\Dskh; */


/* @var $this aabc\web\View */
// use backend\models\ImageSearch ;
// use backend\models\Image ;
/* @var $dataProvider aabc\data\ActiveDataProvider */

$this->title = 'Images';
$this->params['breadcrumbs'][] = $this->title;
?>

<style type="text/css">
    #pj<?=Aabc::$app->_model->__image?> .gr img{
        width: 75px !important;   
        height: auto;
    }
</style>


<div id="pj<?=Aabc::$app->_model->__image?>"    <?=Aabc::$app->d->i?>=<?= Aabc::$app->_model->__image?> class="pj">


<div class="<?=Aabc::$app->_model->__image?>-index">

    

     <div class="content-left  col-md-2">
         <div class="dnn">
            <fieldset>               
              
            </fieldset>  
            <div class="bhelp">
                <button class="btn btn-default bhelp"  <?= Aabc::$app->d->st?> ="1"    <?= Aabc::$app->d->gr?> ="1" >Hướng dẫn sử dụng</button>
            </div>
        </div>
    </div>



  <div class="content-right  col-md-10">

    <div class="content-right-top">
        <?php
        $_Image = Aabc::$app->_model->Image;
        $demthungrac = count($_Image::getAllRecycle1());
            echo '<button type="button"  '.($demthungrac > 0 ? : 'disabled').'  id="mb'.Aabc::$app->_model->__image.'r" '.Aabc::$app->d->u.'="ir" class="btn btn-danger mb" '.Aabc::$app->d->i.'= '.Aabc::$app->_model->__image .'><span class="glyphicon glyphicon-trash mden"></span>'.Aabc::$app->MyConst->view_btn_thungrac.' ('.$demthungrac.')</button>';
         ?>

            <?php $form = ActiveForm::begin([
                    'id' => Aabc::$app->_model->__image.'-form',
                    'options' => ['enctype' => 'multipart/form-data'],
            ]) ?>    
                    <?= '<button type="button" id="hnameht" class="btn btn-success"><span class="glyphicon glyphicon-plus mtrang"></span>'.Aabc::$app->MyConst->view_btn_themanh.'</button>';
                    ?>

                    <?= $form->field($model, Aabc::$app->_up->imageFiles.'[]')->fileInput(['id' => 'file-input','multiple' => true, 'accept' => 'image/*']) ?>
                    <button id="file-submit">Submit</button>
            <?php ActiveForm::end() ?>
    </div>




<script type="text/javascript">   
    $('#hnameht').bind("click" , function () {
        $('#file-input').click();
    });


    $('#file-input').on('change', function(e) {
        $('#file-submit').click();
        // loadimg();
        // var form = $('form#<?=Aabc::$app->_model->__image?>-form');        
        // var formData = new FormData(document.querySelector('form#<?=Aabc::$app->_model->__image?>-form'));
        // $.ajax({
        //     url: form.attr("action"),
        //     type: form.attr("method"),
        //     data: formData,
        //     processData: false,
        //     contentType: false,
        //     success: function (data) {
        //         reload('<?=Aabc::$app->_model->__image?>');
        //         if(data == 1){ 
        //             popthanhcong('');
        //         }else{
        //             popthatbai('');
        //         }
        //     },
        //     error: function () {
        //         reload('<?=Aabc::$app->_model->__image?>');
        //         poploi();
        //     }
        // });
    })

    $('form#<?=Aabc::$app->_model->__image?>-form').on('beforeSubmit', function(e) {
       loadimg();
            var form = $('form#<?=Aabc::$app->_model->__image?>-form');        
            var formData = new FormData(document.querySelector('form#<?=Aabc::$app->_model->__image?>-form'));
            $.ajax({
                url: form.attr("action"),
                type: form.attr("method"),
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    reload('<?=Aabc::$app->_model->__image?>','i');




                    if(data == 1){ 
                        popthanhcong('');
                    }else{
                        popthatbai('');
                    }
                },
                error: function () {
                    reload('<?=Aabc::$app->_model->__image?>');
                    poploi();
                }
            });
    }).on('submit', function(e){
        e.preventDefault();
    });

</script>
  






    <?= GridView::widget([ 
        'id' => 'gr'.Aabc::$app->_model->__image,
        'options' => ['class' => 'gr'],        
        'emptyText' => Aabc::$app->MyConst->gridview_khongthayanh,
        'summary' => "<div class='sy'>(Từ {begin} - {end} trong {totalCount})</div>",
        'dataProvider' => $dataProvider,
        'rowOptions' => function($model){            
            $class = '';
            if ($model[Aabc::$app->_image->image_status] == '2'){
                $class = 'an';
            }
            return ['class'=>$class];
        },
        //'filterModel' => $searchModel,
        'columns' => [
                

             [
                'class' => 'aabc\grid\CheckboxColumn',             
                    'checkboxOptions' => function($model) {                  
                       return ['value' => $model[Aabc::$app->_image->image_id]];                    
                    },
                    'headerOptions' => ['width' => '32'],
                    'cssClass' => 'ca',
                    'name' => 'tuyen', 
              ],

               [
                    'class' => 'aabc\grid\SerialColumn', 
                    'headerOptions' => ['width' => '20'],                       
                ],

     
           [                
                'header' => 'Ảnh',
                // 'attribute' => 'Image',
                'headerOptions' => ['width' => '50'],                 
                'contentOptions' => [                                       
                ],
                'format' => 'raw',
                'value' => function ($model) {                         
                    return '<img src="'.Url::to('/thumb/75/75/' . $model[Aabc::$app->_image->image_tenfile] . '-' . $model[Aabc::$app->_image->image_id]   . $model[Aabc::$app->_image->image_morong], true).'?t='.Time().'" />';                                      
                }, 
            ],

             // Aabc::$app->_image->image_tenfile,
             // Aabc::$app->_image->image_link,
            //  Aabc::$app->_image->image_recycle,
            //  Aabc::$app->_image->image_status,
            [   
                'header' => 'Tên file',
                // 'attribute' => 'File name',                
                'format' => 'raw',
                'value' => function ($model) {                         
                    return $model[Aabc::$app->_image->image_tenfile];                                      
                }, 
            ],                      

            [   
                'header' => 'Đường dẫn',
                // 'attribute' => 'Link',                
                'format' => 'raw',
                'value' => function ($model) {                         
                    return Url::to('' .$model[Aabc::$app->_image->image_link] . $model[Aabc::$app->_image->image_tenfile] . '-' . $model[Aabc::$app->_image->image_id]   . $model[Aabc::$app->_image->image_morong], true);                                      
                }, 
            ],

            [   
                'header' => Aabc::$app->_image->__image_size,
                // 'attribute' => Aabc::$app->_image->image_byte,
                'format' => 'raw',
                'value' => function ($model) {                         
                    return $model[Aabc::$app->_image->image_size];                                      
                }, 
            ],



             [                
                'header' => Aabc::$app->_image->__image_byte,
                // 'attribute' => Aabc::$app->_image->image_id,
                //'headerOptions' => ['width' => '100'],                 
                'contentOptions' => [
                    'class' => 'omb',                    
                ],
                'format' => 'raw',
                'value' => function ($model) {                         
                    return '<div>'.$model[Aabc::$app->_image->image_byte]. ' KiB' . '</div><div class="omc" id="'.Aabc::$app->_model->__image.$model[Aabc::$app->_image->image_id].'"><div class="omd">

                     <button type="button" class="clk btn btn-default" '.Aabc::$app->d->lk.'="'.Url::to('' .$model[Aabc::$app->_image->image_link] . $model[Aabc::$app->_image->image_tenfile] . '-' . $model[Aabc::$app->_image->image_id]   . $model[Aabc::$app->_image->image_morong], true).'">'.Aabc::$app->MyConst->gridview_menu_copyduongdan.'<span class="glyphicon glyphicon-link"></span></button>

                    <div class="gn"></div>

                    <button type="button"  '.Aabc::$app->d->m.'=""  class="mb btn btn-default" '.Aabc::$app->d->i.'='.Aabc::$app->_model->__image.'  '.Aabc::$app->d->u.'="v?id='.$model[Aabc::$app->_image->image_id].'">'.Aabc::$app->MyConst->gridview_menu_xemchitiet.'<span class="glyphicon glyphicon-eye-open"></span></button>


                    <button type="button"  '.Aabc::$app->d->m.'="2"  class="mb btn btn-default" '.Aabc::$app->d->i.'='.Aabc::$app->_model->__image.'  '.Aabc::$app->d->u.'="u?id='.$model[Aabc::$app->_image->image_id].'">'.Aabc::$app->MyConst->gridview_menu_suatenanh.'<span class="glyphicon glyphicon-pencil"></span></button>

                    <div class="gn"></div>
                    
                    <button type="button" class="br btn btn-default" '.Aabc::$app->d->m.'=""  '.Aabc::$app->d->i.'='.Aabc::$app->_model->__image.'  '.Aabc::$app->d->u.'="rec?id='.$model[Aabc::$app->_image->image_id].'">'.Aabc::$app->MyConst->gridview_menu_thungrac.'<span class="glyphicon glyphicon-trash"></span></button>

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
     <select id="sel<?= Aabc::$app->_model->__image?>" class="btn btn-default">
        <option value="" selected=""><?=Aabc::$app->MyConst->gridview_selectmultiitem_chonthaotac?></option>
        <option value="11" <?=Aabc::$app->d->m?>="2"  <?=Aabc::$app->d->i?>="<?=Aabc::$app->_model->__image?>"  <?=Aabc::$app->d->u?> = 'ua'  method='POST'><?=Aabc::$app->MyConst->gridview_selectmultiitem_suatenanh?></option>      
        <option value="3"><?=Aabc::$app->MyConst->gridview_selectmultiitem_thungrac?></option>      
    </select>

    <?= Html::button(Aabc::$app->MyConst->gridview_selectmultiitem_thuchien, [Aabc::$app->d->i => Aabc::$app->_model->__image, Aabc::$app->d->u =>'reca','class' => 'btn btn-default bra', 'method' => 'POST']) ?>
</div>

</div>
</div>

   

</div>

