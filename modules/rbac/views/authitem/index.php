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
/* @var $searchModel backend\modules\rbac\models\AuthitemSearch */
/* @var $dataProvider aabc\data\ActiveDataProvider */

$this->title = 'Authitems';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="authitem-index">

    <h1>Tạo quyền và nhóm quyền</h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>  

        <?=  Html::button('Create Authitem', ['value'=>Url::to(Aabc::$app->homeUrl.'rbac/authitem/create'),'class' => 'btn btn-success modalButton','id'=>'modalButtonauthitem']) ?>
    </p>

    <?php
        Modal::begin([
                'header'=>'',
                'id'=>'modal',
                'size'=>'modal-md',
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

       $('.authitemset').click(function(e){              
            $.ajax({
                cache: false,
                url: $(this).attr('name'),
                type: 'POST',                               
                success: function (data) {   
                    if(data == 'thanhcong'){ 
                       popthanhcong('Xét quyền');         
                    }
                    if(data == 'thatbai'){
                        popthatbai('Xét quyền');
                    }
                    $.pjax.reload({container:'#pjauthitem'}); 
                },
                error: function () {
                    $.pjax.reload({container:'#pjauthitem'}); 
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
                            $.pjax.reload({container:'#pjauthitem'});
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

    });
")
?>


<?php Pjax::begin(["enablePushState" => false,"id" => "pjauthitem" ,"clientOptions" => ["method"=> "GET",] ]); ?>
Hiển thị
<?= 
Html::dropDownList('t', Aabc::$app->request->get('t') != NULL ? Aabc::$app->request->get('t') : [20 => 20], [5 => 5, 10 => 10, 20 => 20, 50 => 50, 100 => 100, 200 => 200], [
    'onchange' => '  
        $.pjax.reload({
            url: updateQueryStringParameter($("#urlpjax").html().replace(/&amp;/g, "&"),"t",$(this).val()),
            container: "#pjauthitem",
        });
    ', 
    'class' => '',
    'id' => 't'
])?> <br/>
    <?= Html::button('Xóa lựa chọn', ['value'=>Url::to(Aabc::$app->homeUrl.'rbac/authitem/deleteall'),'class' => '','id'=>'buttonauthitemdeleteall', 'method' => 'POST']) ?>



<?php
 
$this->registerJs(
"$('button#buttonauthitemdeleteall').on('click', function(e) {            
     
        var ids = $('#gridauthitem').aabcGridView('getSelectedRows');  
        if(ids != ''){   
        if (confirm('Bạn chắc chắn muốn xóa ?')) {   
        $.ajax({
            url: $(this).attr('value'),
            type: $(this).attr('method'),
            data: {selects: ids},
            success: function (data) {
                if(data == 'thanhcong'){                  
                    $.pjax.reload({container:'#pjauthitem'});                
                    popthanhcong('Xóa');
                }
                if(data == 'thatbai'){
                    popthatbai('Xóa');
                }
            },
            error: function () {
                poploi();
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
        'id' => 'gridauthitem',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [


    [
        'class' => 'aabc\grid\CheckboxColumn',             
            'checkboxOptions' => function($model) {
                // if($model->id == 7){
                //     return ['value' => $model->id,
                //     //'checked' => true,
                //     'class' => 'cssitem',
                //     //'disabled' => true,
                //     ];
                // }
                return ['value' => $model->name];
                
            },

            'cssClass' => 'cssall',
            //'name' => 'tuyen', 
      ],

     


            //'name',
            [
               'attribute' => 'name',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->name .'('.$model->authitemcount.')';
                },
            ],
            //'type',
            //'description:ntext',
            //'rule_name',
            //'data',
            // 'created_at',
            // 'updated_at',
          
             [               
                
                'attribute' => 'Dev (Development)',
                'format' => 'raw',
                'value' => function ($model) {
                    if($model->name == 'dev'){
                        return '';
                    }else{
                        return Html::checkbox(Aabc::$app->homeUrl.'rbac/authitem/updatedev?name='.$model->name.'&parent=dev', $model->authitemdev, ['value' => $model->name, 'class' => 'authitemset']);
                    }
                },
            ],

             [               
                
                'attribute' => 'Admin (Website)',
                'format' => 'raw',
                'value' => function ($model) {
                    if($model->name == 'admin' OR $model->name == 'dev'  OR $model->name == 'manager'){
                        return '';
                    }else{
                        return Html::checkbox(Aabc::$app->homeUrl.'rbac/authitem/updatedev?name='.$model->name.'&parent=admin', $model->authitemadmin, ['value' => $model->name, 'class' => 'authitemset']);
                    }
                },
            ],

             [     
                'attribute' => 'Manager (Software)',
                'format' => 'raw',
                'value' => function ($model) {
                    if($model->name == 'admin' OR $model->name == 'dev' OR $model->name == 'manager'){
                        return '';
                    }else{
                        return Html::checkbox(Aabc::$app->homeUrl.'rbac/authitem/updatedev?name='.$model->name.'&parent=manager', $model->authitemmanager, ['value' => $model->name, 'class' => 'authitemset']);
                    }
                },
            ],

             [      
                'attribute' => 'User',
                'format' => 'raw',
                'value' => function ($model) {
                    if($model->name == 'user' OR $model->name == 'admin' OR $model->name == 'dev' OR $model->name == 'manager'){
                        return '';
                    }else{
                        return Html::checkbox(Aabc::$app->homeUrl.'rbac/authitem/updatedev?name='.$model->name.'&parent=user', $model->authitemuser, ['value' => $model->name, 'class' => 'authitemset']);
                    }
                },
            ],
            


             [                
                'attribute' => '#',
                'headerOptions' => ['width' => '70'],
                'format' => 'raw',
                'value' => function ($model) {  
                    return '<button title="Cập nhật"  type="button" class="modalButton glyphicon glyphicon-pencil" value="'.Aabc::$app->homeUrl.'rbac/authitem/update?name='.$model->name.'"></button>

                    <button title="Xóa" type="button" class="buttondelete glyphicon glyphicon-trash" value="'.Aabc::$app->homeUrl.'rbac/authitem/delete?id='.$model->name.'"></button>';                                      
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
    " $('#gridauthitem ul.pagination').click(function () {       
            $('html body').animate({ scrollTop: 0 }, '1500');
        });

        //  $('#gridauthitem a').each(function( index, value ) {            
        //     $(this).attr('id',  $(this).attr('href'));
        //     $(this).attr('href', 'javascript:void(0)');
        // });
    ")
    ?>


   
<?php Pjax::end(); ?></div>
