<?php

use aabc\helpers\Html;   
use aabc\grid\GridView;
use aabc\widgets\ListView;

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

if(empty($icon)) $icon = '';

?>

<div id="pj<?=Aabc::$app->_model->__image?>"    <?=Aabc::$app->d->i?>=<?= Aabc::$app->_model->__image?> class="pj gmi">
<?php if($icon == 'icon'){ ?>
    <h1>Chọn ảnh</h1>
<?php } ?>

<div class="<?= Aabc::$app->_model->__image?>-index">
    <style type="text/css">
        button{
            cursor: pointer !important;
        }
        #search_btn{
            cursor: pointer !important;
            margin: 0 0 10px 0;
            color: #fff;
            background-color: #5cb85c;
            border-color: #4cae4c;
            padding: 5px 10px;
            width: auto;
            text-align: center;
            font-size: 14px;
            border: 0;
            text-decoration: none;
            vertical-align: baseline;
            position: static;
            transition: none;
            font: normal normal normal 12px Arial,Helvetica,Tahoma,Verdana,Sans-Serif;
            white-space: nowrap;
            cursor: auto;
            float: none;
        }
        a#search_btn>span{
            font-family: 'Glyphicons Halflings' !important;
            color: #FFF;
        }
    </style>
   <?php $form = ActiveForm::begin([
                    'action' => Aabc::$app->homeUrl . Aabc::$app->_model->__image . '/i',
                    'id' => Aabc::$app->_model->__image.'-form',
                    'options' => [
                        'enctype' => 'multipart/form-data',
                        'class' => 'pull-left',
                    ],

            ]) ?>    
                    <?= '<button type="button" id="pophnameht" >'.Aabc::$app->MyConst->view_btn_themanh.'</button>';
                    ?>                                      

                    <?= $form->field($model, Aabc::$app->_up->imageFiles.'[]')->fileInput(['id' => 'file-input','multiple' => true, 'accept' => 'image/*']) ?>
                    <button id="file-submit">Submit</button>
            <?php ActiveForm::end() ?>

            <div class="pull-right">

                <?php 
                    $d_u = '';
                    if(!empty($_GET['s'])) $d_u = $_GET['s'];
                ?>

                <input value="<?= $d_u?>" id="search_img" placeholder="Tìm kiếm theo tên ảnh..." type="text" name="search_img" style="padding: 3px 5px; font-size: 12px; border: 1px solid #aaa;width: 200px;background: #FFF;">
                                
                <a href="/ad/?k=image&amp;f=ga&amp;i=icon&s=<?= $d_u?>" id="search_btn" data-page="1" d-u="" d-i="ga"><span style="padding: 0 7px 0 0;" class="glyphicon glyphicon-search"></span>Tìm kiếm</a>

            </div>

            <script type="text/javascript">   
                $('#pophnameht').bind("click" , function () {
                    $('#file-input').click();
                });

                $('#file-input').on('change', function(e) {
                    $('#file-submit').click();        
                })

                $('#search_img').on('change', function(e) {
                    v = $('#search_img').val()
                    a = 'ga?i=icon&s=' + v
                    $('#search_btn').attr('d-u',a)
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
                                reload('<?=Aabc::$app->_model->__image?>','ga<?php if(isset($icon)){echo "?i=icon";}?><?= (empty($element)?"":"&e={$element}") ?>','<?=Aabc::$app->_model->__image?>');
                                console.log('CHo nay')
                                if(data == 1){ 
                                    popthanhcong('');
                                    // alert('1');
                                }else{
                                    popthatbai('');
                                }
                            },
                            error: function () {
                                // reload('<?=Aabc::$app->_model->__image?>');
                                poploi();
                            }
                        });
                }).on('submit', function(e){
                    e.preventDefault();
                });

            </script>


    <?php 
 //    echo  GridView::widget([ 
 //        'id' => 'gr'.Aabc::$app->_model->__image,
 //        'options' => ['class' => 'gr'],
 //        'emptyText' => Aabc::$app->MyConst->gridview_khongthayketqua,
 //        'summary' => "<div class='sy'>(Từ {begin} - {end} trong {totalCount})</div>",
 //        'dataProvider' => $dataProvider,
 //        'rowOptions' => function($model){            
 //            $class = '';
 //            if ($model[Aabc::$app->_image->image_status] == '2'){
 //                $class = 'an';
 //            }
 //            return ['class'=>$class];
 //        },
 //        //'filterModel' => $searchModel,
 //        'columns' => [


 //         [
 //            'class' => 'aabc\grid\CheckboxColumn',             
 //                'checkboxOptions' => function($model) {                  
 //                   return ['value' => $model[Aabc::$app->_image->image_id]];                    
 //                },
 //                'headerOptions' => ['width' => '32'],
 //                'cssClass' => 'ca',
 //                'name' => 'tuyen', 
 //          ],

     


 //             Aabc::$app->_image->image_id,
 //             Aabc::$app->_image->image_tenfile,
 //             Aabc::$app->_image->image_link,
 //            //  Aabc::$app->_image->image_recycle,
 //            //  Aabc::$app->_image->image_status,
 //            //  Aabc::$app->_image->image_byte,
                     

 //             [                
 //                //'header' => '<a href="'.Aabc::$app->homeUrl.'sanpham">Reset</a>',
 //                'attribute' => Aabc::$app->_image->image_id,
 //                //'headerOptions' => ['width' => '100'],                 
 //                'contentOptions' => [
 //                    'class' => 'omb',                    
 //                ],
 //                'format' => 'raw',
 //                'value' => function ($model) {                         
 //                    return '<div>'.$model[Aabc::$app->_image->image_id].'</div><div class="omc" id="'.Aabc::$app->_model->__image.$model[Aabc::$app->_image->image_id].'"><div class="omd">

 //                    <button type="button"  '.Aabc::$app->d->m.'="2"  class="mb btn btn-default" '.Aabc::$app->d->i.'='.Aabc::$app->_model->__image.'  '.Aabc::$app->d->u.'="u?id='.$model[Aabc::$app->_image->image_id].'">'.Aabc::$app->MyConst->gridview_menu_suachitiet.'<span class="glyphicon glyphicon-pencil"></span></button>

 //                    <div class="gn"></div>
 //                    '.                        
 //                        (Aabc::$app->user->can('web') ?  ($model[Aabc::$app->_image->image_status] == 2 ? '<button type="button" class="ml btn btn-default" '.Aabc::$app->d->i.'='.Aabc::$app->_model->__image.'   '.Aabc::$app->d->u.'="us?id='.$model[Aabc::$app->_image->image_id].'">'.Aabc::$app->MyConst->gridview_menu_hienthi.'<span class="glyphicon glyphicon-eye-open"></span></button>' : '<button type="button" class="ml btn btn-default" '.Aabc::$app->d->i.'='.Aabc::$app->_model->__image.'   '.Aabc::$app->d->u.'="us?id='.$model[Aabc::$app->_image->image_id].'">'.Aabc::$app->MyConst->gridview_menu_an.'<span class="glyphicon glyphicon-eye-open"></span></button>') : "" )

 //                    .'
 //                    <button type="button" class="br btn btn-default" '.Aabc::$app->d->i.'='.Aabc::$app->_model->__image.'  '.Aabc::$app->d->u.'="rec?id='.$model[Aabc::$app->_image->image_id].'">'.Aabc::$app->MyConst->gridview_menu_thungrac.'<span class="glyphicon glyphicon-trash"></span></button>

 //                    </div></div>';                                      
 //                }, 
 //            ],

        


 //        ],


 //         //« » ‹ ›
 //        'pager' => [
 //            'firstPageLabel' => '«',
 //            'prevPageLabel'  => '‹',
 //            'nextPageLabel' => '›',
 //            'lastPageLabel' => '»',

 //            'maxButtonCount'=>1, // Số page hiển thị ví dụ: (First  1 2 3 Last)
 //        ],

 // ]); 

 ?>

<style type="text/css">
    .item [class*='col-md-'] {
        margin: 0;
        padding: 0;
    }

   .item {
        float: left;
        position: relative;
        margin: 4px 3px 4px 2px;
        text-align: center;
            font-size: 12px;
    }

    .list-view {
        float: left;
        width: 100%;

    }

    #pjimage .endgr {
        float: left;
        margin: 10px 0;
        width: 100%;
        text-align: center;
        background: transparent;
    }


     .image-to-choose .item::before {
        border: thin solid #DCDCDC;
        border-radius: 3px;
        z-index: 1;
        content: "";
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
    }
    

</style>

     <?php
     if(!empty($icon)){
        echo ListView::widget([
            'dataProvider' => $dataProvider,
            'emptyText' => Aabc::$app->MyConst->gridview_khongthayanh,
            'summary' => "<div class='sy'>(Từ {begin} - {end} trong tổng số {totalCount} ảnh.)</div>",
            'itemOptions' => ['class' => 'item'],        
            'itemView' => '_itemicon',
            'pager' => [
                'firstPageLabel' => '«',
                'prevPageLabel'  => '‹',
                'nextPageLabel' => '›',
                'lastPageLabel' => '»',
                'maxButtonCount'=>1, // Số page hiển thị ví dụ: (First  1 2 3 Last)
            ],
        ]);
     }else{
         echo ListView::widget([
            'dataProvider' => $dataProvider,
            'emptyText' => Aabc::$app->MyConst->gridview_khongthayanh,
            'summary' => "<div class='sy'>(Từ {begin} - {end} trong tổng số {totalCount} ảnh.)</div>",
            'itemOptions' => ['class' => 'item'],        
            'itemView' => '_item',
            'pager' => [
                'firstPageLabel' => '«',
                'prevPageLabel'  => '‹',
                'nextPageLabel' => '›',
                'lastPageLabel' => '»',
                'maxButtonCount'=>1, // Số page hiển thị ví dụ: (First  1 2 3 Last)
            ],
        ]);
    }
    ?>


   

<div class="endgr">

</div>
<div style="clear: both"></div>

</div>
</div>

<?php     
    if($icon == 'icon'){ ?>

    <div class="form-group right">        
        <button type="button" class="btn btn-primary chona" data-e="<?= $element?>" data-dismiss="modal" aria-hidden="true">Đồng ý</button>
        <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Bỏ qua</button>
    </div>

<?php } ?>