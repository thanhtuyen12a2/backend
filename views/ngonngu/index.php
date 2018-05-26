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
/* @var $searchModel backend\models\NgonnguSearch */
/* @var $dataProvider aabc\data\ActiveDataProvider */

$this->title = 'Ngonngus';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ngonngu-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>  

        <?php  
        if(Aabc::$app->user->can('backend-ngonngu-create')){
            echo Html::button('Create Ngonngu', ['value'=>Url::to(Aabc::$app->homeUrl.'ngonngu/create'),'class' => 'btn btn-success modalButton','id'=>'modalButtonngonngu']);
        }
        ?>
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
"
// $(document).on('ready pjax:success', function() {        
         $('.modalButton').click(function(e){ 
            loadimg();
            $.ajax({
                cache: false,
                url: $(this).attr('value'),
                type: 'POST',  
                data: {
                    modal:'modal',                   
                },                              
                success: function (data) {                                      
                    $('#modal').modal('show')
                        .find('#modalContent')
                        .html(data);                    
                    unloadimg();
                },
                error: function () {
                    poploi();                    
                }
            });
       });

       $('.nnstatus').click(function(e){              
            $.ajax({
                cache: false,
                url: $(this).attr('name'),
                type: 'POST',                               
                success: function (data) {   
                    if(data == 'thanhcong'){ 
                       popthanhcong('Cập nhật');         
                    }
                    if(data == 'thatbai'){
                        popthatbai('Cập nhật');
                    }
                    $.pjax.reload({container:'#pjngonngu'}); 
                },
                error: function () {
                    $.pjax.reload({container:'#pjngonngu'}); 
                    poploi();
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
                            $.pjax.reload({container:'#pjngonngu'});
                            popthanhcong('Xóa');
                          
                        }
                        if(data == 'thatbai'){                            
                            popthatbai('Xóa');
                        }
                    },
                    error: function () {
                        poploi();
                    }                
                }); // end ajax call
            } 
        });

    // });
")
?>


<?php Pjax::begin(['options' => ['class' => 'pj'], "enablePushState" => false,"id" => "pjngonngu" ,"clientOptions" => ["method"=> "GET",] ]); ?>
Hiển thị
<?= 
Html::dropDownList('t', Aabc::$app->request->get('t') != NULL ? Aabc::$app->request->get('t') : [20 => 20], [5 => 5, 10 => 10, 20 => 20, 50 => 50, 100 => 100, 200 => 200], [
    'onchange' => '  
        $.pjax.reload({
            url: updateQueryStringParameter($("#urlpjax").html().replace(/&amp;/g, "&"),"t",$(this).val()),
            container: "#pjngonngu",
        });
    ', 
    'class' => '',
    'id' => 't'
])?> 

    <?= GridView::widget([ 
        'id' => 'gridngonngu',
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [

    
            [   
                'attribute' => 'ID',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->ngonngu_id;
                },
            ],
         
            'ngonngu_ten',
            'ngonngu_code',           

            [
                'attribute' => 'ngonngu_trangthai',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::checkbox(Aabc::$app->homeUrl.'ngonngu/updatestatus?id='.$model->ngonngu_id, $model->ngonngu_trangthai, ['value' => $model->ngonngu_trangthai, 'class' => 'nnstatus']);
                },
            ],
            
            [
                'attribute' => 'ngonngu_macdinh',
                'format' => 'raw',
                'value' => function ($model) {
                    if($model->ngonngu_trangthai == '1'){
                        return Html::radio(Aabc::$app->homeUrl.'ngonngu/updatedefault?id='.$model->ngonngu_id, $model->ngonngu_macdinh, ['value' => $model->ngonngu_macdinh, 'class' => 'nnstatus']);
                    }else{
                        return '';
                    }                    
                },
            ],

          

             [                
                'attribute' => '#',
                'headerOptions' => ['width' => '70'],
                'format' => 'raw',
                'value' => function ($model) {                          
                    if(Aabc::$app->user->can('backend-ngonngu-delete')){
                        return '<button title="Cập nhật"  type="button" class="modalButton glyphicon glyphicon-pencil" value="'.Aabc::$app->homeUrl.'ngonngu/update?id='.$model->ngonngu_id.'"></button>
                            <button title="Xóa" type="button" class="buttondelete glyphicon glyphicon-trash" value="'.Aabc::$app->homeUrl.'ngonngu/delete?id='.$model->ngonngu_id.'"></button>';
                    }else{
                        return '<button title="Cập nhật"  type="button" class="modalButton glyphicon glyphicon-pencil" value="'.Aabc::$app->homeUrl.'ngonngu/update?id='.$model->ngonngu_id.'"></button>';                        
                    }
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

        $('#gridngonngu a').each(function( index, value ) {            
            $(this).attr('id',  $(this).attr('href'));
            $(this).attr('href', 'javascript:void(0)');
        });
    ")
    ?>


   
<?php Pjax::end(); ?></div>
