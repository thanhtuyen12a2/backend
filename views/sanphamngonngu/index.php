<?php

use aabc\helpers\Html;
use aabc\grid\GridView;

use aabc\bootstrap\Modal; /*Them*/
use aabc\helpers\Url; /*Them*/
use aabc\helpers\ArrayHelper; /*Them*/
use aabc\widgets\ActiveForm;
/*use app\models\Dskh; */

use aabc\widgets\Pjax;
/* @var $this aabc\web\View */
/* @var $searchModel backend\models\SanphamngonnguSearch */
/* @var $dataProvider aabc\data\ActiveDataProvider */

$this->title = 'Sanphamngonngus';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sanphamngonngu-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>  

        <?=  Html::button('Create Sanphamngonngu', ['value'=>Url::to(Aabc::$app->homeUrl.'sanphamngonngu/create'),'class' => 'btn btn-success modalButtonone','id'=>'modalButtonsanphamngonngu']) ?>
    </p>

    <?php
        Modal::begin([
                'header'=>'',
                'id'=>'modal',
                'size'=>'modal-lg',
                'clientOptions' => ['backdrop' => 'static', 'keyboard' => false] 

            ]);
        echo "<div id='modalContent'></div>";
        Modal::end();
    ?>

 <?php
 //js code:  Khi Pjax thì Modal vẫn hoạt động
$this->registerJs(
"$(document).on('ready pjax:success', function() {
        $('.modalButton').click(function(e){  
            $.ajax({
                cache: false,
                url: $(this).attr('value'),
                type: 'POST',                               
                success: function (data) {                  
                    $('#modal').modal('show')
                        .find('#modalContent')
                        .html(data);
                },
                error: function () {
                    alert('Có lỗi xảy ra');
                }
            });
       });



       $('.buttondelete').click(function(e){             
            if (confirm('Bạn chắc chắn muốn xóa ?')) {   
                $.ajax({
                    cache: false,
                    url: $(this).attr('value'),
                    type: 'POST',                               
                    success: function (data) {                  
                         if(data == 'thanhcong'){                  
                            $.pjax.reload({container:'#pjsanphamngonngu'});
                            alert('Thành công');                            
                        }
                        if(data == 'thatbai'){
                            alert('Thất bại');
                        }
                    },
                    error: function () {
                        alert('Có lỗi xảy ra');
                    }                
                }); // end ajax call
            } 
        });

    });
")
?>


<?php Pjax::begin(["enablePushState" => false,"id" => "pjsanphamngonngu" ,"clientOptions" => ["method"=> "GET",] ]); ?>
Hiển thị
<?= 
Html::dropDownList('t', Aabc::$app->request->get('t') != NULL ? Aabc::$app->request->get('t') : [20 => 20], [5 => 5, 10 => 10, 20 => 20, 50 => 50, 100 => 100, 200 => 200], [
    'onchange' => '  
        $.pjax.reload({
            url: updateQueryStringParameter($("#urlpjax").html().replace(/&amp;/g, "&"),"t",$(this).val()),
            container: "#pjsanphamngonngu",
        });
    ', 
    'class' => '',
    'id' => 't'
])?> <br/>
    <?= Html::button('Xóa lựa chọn', ['value'=>Url::to(Aabc::$app->homeUrl.'sanphamngonngu/deleteall'),'class' => '','id'=>'buttonsanphamngonngudeleteall', 'method' => 'POST']) ?>


<?php
 
$this->registerJs(
"$('button#buttonsanphamngonngudeleteall').on('click', function(e) {            
     
        var ids = $('#gridsanphamngonngu').aabcGridView('getSelectedRows');  
        if(ids != ''){   
        if (confirm('Bạn chắc chắn muốn xóa ?')) {   
        $.ajax({
            url: $(this).attr('value'),
            type: $(this).attr('method'),
            data: {selects: ids},
            success: function (data) {
                if(data == 'thanhcong'){                  
                    $.pjax.reload({container:'#pjsanphamngonngu'});                
                    alert('Thành công');
                }
                if(data == 'thatbai'){
                    alert('Thất bại');
                }
            },
            error: function () {
                alert('Có lỗi xảy ra');
            }
        }); 
        } 
        }
    }).on('submit', function(e){
        e.preventDefault();
});
")
?>



    <?= GridView::widget([ 
        'id' => 'gridsanphamngonngu',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [


    //[
        //'class' => 'aabc\grid\CheckboxColumn',             
            //'checkboxOptions' => function($model) {
            //    if($model->id == 7){
            //        return ['value' => $model->id,
            //        //'checked' => true,
            //        'class' => 'cssitem',
            //        //'disabled' => true,
            //        ];
            //    }
            //    return ['value' => $model->id];
                
            //},

            //'cssClass' => 'cssall',
            //'name' => 'tuyen', 
      //],

     


            'spnn_idsanpham',
            'spnn_idngonngu',
            'spnn_ten',
            'spnn_noidung:ntext',
            'spnn_gioithieu:ntext',
            // 'spnn_tieudeseo',
            // 'spnn_motaseo',
          

             [                
                'attribute' => '#',
                'headerOptions' => ['width' => '70'],
                'format' => 'raw',
                'value' => function ($model) {  
                        
                    return '<button title="Cập nhật"  type="button" class="modalButton glyphicon glyphicon-pencil" value="'.Aabc::$app->homeUrl.'sanphamngonngu/update?spnn_idsanpham='.$model->spnn_idsanpham.'&spnn_idngonngu='.$model->spnn_idngonngu.'"></button>

                    <button title="Xóa" type="button" class="buttondelete glyphicon glyphicon-trash" value="'.Aabc::$app->homeUrl.'sanphamngonngu/delete?spnn_idsanpham='.$model->spnn_idsanpham.'&spnn_idngonngu='.$model->spnn_idngonngu.'"></button>';                                      
                }, 
            ],

        ],


        'pager' => [
            'firstPageLabel' => 'First',
            'lastPageLabel' => 'Last',
            'maxButtonCount'=>3, // Số page hiển thị ví dụ: (First  1 2 3 Last)
        ],

 ]); ?>


    <?php
 //Lên đầu trang khi next page
$this->registerJs(  
    " $('ul.pagination').click(function () {       
            $('html body').animate({ scrollTop: 0 }, '1500');
        });
    ")
    ?>


   
<?php Pjax::end(); ?></div>
