<?php

use aabc\helpers\Html;
use aabc\grid\GridView;

use aabc\bootstrap\Modal; /*Them*/
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
<div id="pjr<?= Aabc::$app->_model->__image?>"  <?=Aabc::$app->d->i  ?>="<?= Aabc::$app->_model->__image?>"  class="pj">


<div class="<?= Aabc::$app->_model->__image?>-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>



<p>
  
    <?php  
    $_Image = Aabc::$app->_model->Image; 
    $countgetAllRecycle1 = count($_Image::getAllRecycle1());
    
    if($countgetAllRecycle1 > 0){       
        echo '<button type="button"  '.Aabc::$app->d->ct.'="'.$countgetAllRecycle1.'"  '.Aabc::$app->d->u.' ="da" class="btn btn-default bda" '.Aabc::$app->d->i.' ="'.Aabc::$app->_model->__image.'"><span class="glyphicon glyphicon-ban-circle mden"></span>Xóa tất cả</button>';
    }
     ?>

</p>
<style type="text/css">
    #pjrimage .gr img{
        width: 75px !important;   
        height: auto;
    }
</style>



    <?= GridView::widget([ 
        'id' => 'grr'.Aabc::$app->_model->__image,
        'options' => ['class' => 'gr'],
        'summary' => "<div class='sy'>(Từ {begin} - {end} trong {totalCount})</div>",
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,`
        'columns' => [


             [                
                'header' => 'Ảnh',
                // 'attribute' => 'Image',
                'headerOptions' => ['width' => '50'],                 
                'contentOptions' => [                                       
                ],
                'format' => 'raw',
                'value' => function ($model) {                         
                    return '<img width="75" src="'.Url::to('/thumb/75/75/' . $model[Aabc::$app->_image->image_tenfile] . '-' . $model[Aabc::$app->_image->image_id]   . $model[Aabc::$app->_image->image_morong], true).'?t='.Time().'" />';                                      
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
                'label' => 'Khôi phục',                  
                'headerOptions' => ['width' => '100'],
                'format' => 'raw',
                'value' => function ($model) { 
                    $_Image = Aabc::$app->_model->Image; 
                    $countgetAllRecycle1 = count($_Image::getAllRecycle1());
                    return '<div class="text-center" ><button  '.Aabc::$app->d->ct.' ="'.$countgetAllRecycle1.'"  '.Aabc::$app->d->i.' ="'.Aabc::$app->_model->__image.'" '.Aabc::$app->d->u.' ="res?id='.$model[Aabc::$app->_image->image_id].'"  type="button" class="be glyphicon glyphicon-floppy-open" ></button></div>';                    
                }, 
            ],


            [           
                'label' => 'Xóa',  
                'headerOptions' => ['width' => '100'],
                'format' => 'raw',
                'value' => function ($model) { 
                    $_Image = Aabc::$app->_model->Image; 
                    $countgetAllRecycle1 = count($_Image::getAllRecycle1());           
                    return '<div class="text-center" ><button '.Aabc::$app->d->ct.'="'.$countgetAllRecycle1.'"  '.Aabc::$app->d->i.' ="'.Aabc::$app->_model->__image.'" '.Aabc::$app->d->u.' ="d?id='.$model[Aabc::$app->_image->image_id].'"  type="button" class="bd glyphicon glyphicon-ban-circle" ></button></div>'; 
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


   

</div>

</div>
