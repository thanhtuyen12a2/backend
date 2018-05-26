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
/* @var $searchModel backend\modules\rbac\models\AuthassignmentSearch */
/* @var $dataProvider aabc\data\ActiveDataProvider */

$this->title = 'Authassignments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="authassignment-index">

    <h1>Phân nhóm quyền cho người dùng</h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>  

        <?=  Html::button('Create Authassignment', ['value'=>Url::to(Aabc::$app->homeUrl.'rbac/authassignment/create'),'class' => 'btn btn-success modalButton','id'=>'modalButtonauthassignment']) ?>
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
                            $.pjax.reload({container:'#pjauthassignment'});
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


<?php Pjax::begin(["enablePushState" => false,"id" => "pjauthassignment" ,"clientOptions" => ["method"=> "GET",] ]); ?>
Hiển thị
<?= 
Html::dropDownList('t', Aabc::$app->request->get('t') != NULL ? Aabc::$app->request->get('t') : [20 => 20], [5 => 5, 10 => 10, 20 => 20, 50 => 50, 100 => 100, 200 => 200], [
    'onchange' => '  
        $.pjax.reload({
            url: updateQueryStringParameter($("#urlpjax").html().replace(/&amp;/g, "&"),"t",$(this).val()),
            container: "#pjauthassignment",
        });
    ', 
    'class' => '',
    'id' => 't'
])?> 


<?php
 
$this->registerJs(
"$('button#buttonauthassignmentdeleteall').on('click', function(e) {            
     
        var ids = $('#gridauthassignment').aabcGridView('getSelectedRows');  
        if(ids != ''){   
        if (confirm('Bạn chắc chắn muốn xóa ?')) {   
        $.ajax({
            url: $(this).attr('value'),
            type: $(this).attr('method'),
            data: {selects: ids},
            success: function (data) {
                if(data == 'thanhcong'){                  
                    $.pjax.reload({container:'#pjauthassignment'});                
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
        'id' => 'gridauthassignment',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [


   


            'item_name',
            'user_id',
            //'created_at',
          

             [                
                'attribute' => '#',
                'headerOptions' => ['width' => '70'],
                'format' => 'raw',
                'value' => function ($model) {  
                    return '<button title="Cập nhật"  type="button" class="modalButton glyphicon glyphicon-pencil" value="'.Aabc::$app->homeUrl.'rbac/authassignment/update?item_name='.$model->item_name.'&user_id='.$model->user_id.'"></button>

                    <button title="Xóa" type="button" class="buttondelete glyphicon glyphicon-trash" value="'.Aabc::$app->homeUrl.'rbac/authassignment/delete?item_name='.$model->item_name.'&user_id='.$model->user_id.'"></button>';                                      
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
