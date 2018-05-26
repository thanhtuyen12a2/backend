<?php

use aabc\helpers\Html;
use aabc\grid\GridView;

use aabc\bootstrap\Modal; /*Them*/
use aabc\helpers\Url; /*Them*/
use aabc\helpers\ArrayHelper; /*Them*/
use aabc\widgets\ActiveForm;
/*use app\models\Dskh; */



/* @var $this aabc\web\View */
// use backend\models\DanhmucSearch ;
// use backend\models\Danhmuc ;
/* @var $dataProvider aabc\data\ActiveDataProvider */

$this->title = 'Danhmucs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="pjr<?= Aabc::$app->_model->__danhmuc?>"  <?=Aabc::$app->d->i  ?>="<?= Aabc::$app->_model->__danhmuc?>"  class="pj">


<div class="<?= Aabc::$app->_model->__danhmuc?>-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>



<p>
  
    <?php  
    $_Danhmuc = Aabc::$app->_model->Danhmuc; 
    $countgetAllRecycle1_3 = count($_Danhmuc::getAllRecycle1_3());
    
    if($countgetAllRecycle1_3 > 0){       
        echo '<button type="button"  '.Aabc::$app->d->ct.'="'.$countgetAllRecycle1_3.'" '.Aabc::$app->d->u.' ="da_dm" class="btn btn-default bda" '.Aabc::$app->d->i.' ="'.Aabc::$app->_model->__danhmuc.'"><span class="glyphicon glyphicon-ban-circle mden"></span>Xóa tất cả</button>';
    }
     ?>

</p>




    <?= GridView::widget([ 
        'id' => 'grr'.Aabc::$app->_model->__danhmuc,
        'options' => ['class' => 'gr'],
        'summary' => "<div class='sy'>(Từ {begin} - {end} trong {totalCount})</div>",
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [

  [ 
               'label' => 'ID',               
               'value' => function ($model) {                          
                   return $model[Aabc::$app->_danhmuc->dm_id];
               }, 
            ],

              [ 
               'label' => 'Tên danh mục nổi bật',               
               'value' => function ($model) {                          
                   return $model[Aabc::$app->_danhmuc->dm_char];
               }, 
            ],


             [                
                'label' => 'Khôi phục',                  
                'headerOptions' => ['width' => '100'],
                'format' => 'raw',
                'value' => function ($model) {  
                    $_Danhmuc = Aabc::$app->_model->Danhmuc; 
                    $countgetAllRecycle1_3 = count($_Danhmuc::getAllRecycle1_3());                                      
                    return '<div class="text-center" ><button  '.Aabc::$app->d->type.'="_dm"   '.Aabc::$app->d->ct.' ="'.$countgetAllRecycle1_3.'"  '.Aabc::$app->d->i.' ="'.Aabc::$app->_model->__danhmuc.'" '.Aabc::$app->d->u.' ="res_dm?id='.$model[Aabc::$app->_danhmuc->dm_id].'"  type="button" class="be glyphicon glyphicon-floppy-open" ></button></div>';                    
                }, 
            ],


            [           
                'label' => 'Xóa',  
                'headerOptions' => ['width' => '100'],
                'format' => 'raw',
                'value' => function ($model) {   
                    $_Danhmuc = Aabc::$app->_model->Danhmuc; 
                    $countgetAllRecycle1_3 = count($_Danhmuc::getAllRecycle1_3());                     
                    return '<div class="text-center" ><button  '.Aabc::$app->d->type.'="_dm"  '.Aabc::$app->d->ct.'="'.$countgetAllRecycle1_3.'"  '.Aabc::$app->d->i.' ="'.Aabc::$app->_model->__danhmuc.'" '.Aabc::$app->d->u.' ="d_dm?id='.$model[Aabc::$app->_danhmuc->dm_id].'"  type="button" class="bd glyphicon glyphicon-ban-circle" ></button></div>'; 
                }, 
            ],

        ],


         //« » ‹ ›
        'pager' => [
            'firstPageLabel' => '«',
            'prevPageLabel'  => '‹',
            'nextPageLabel' => '›',
            'lastPageLabel' => '»',

            'maxButtonCount'=>3, // Số page hiển thị ví dụ: (First  1 2 3 Last)
        ],


 ]); ?>


   

</div>

</div>
