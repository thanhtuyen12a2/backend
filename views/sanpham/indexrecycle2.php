<?php

use aabc\helpers\Html;
use aabc\grid\GridView;

use aabc\bootstrap\Modal; /*Them*/
use aabc\helpers\Url; /*Them*/
use aabc\helpers\ArrayHelper; /*Them*/
use aabc\widgets\ActiveForm;
/*use app\models\Dskh; */

use common\cont\D;
use backend\models\Sanpham;

// use aabc\widgets\Pjax;
// use backend\models\Sanpham;
/* @var $this aabc\web\View */
/* @var $searchModel backend\models\SanphamSearch */
/* @var $dataProvider aabc\data\ActiveDataProvider */

$this->title = 'Thùng rác Sản phẩm - Hàng hóa';
$this->params['breadcrumbs'][] = $this->title;
?>

<div id="pjr<?= Sanpham::tt?>" <?= D::i?>=<?= Sanpham::tt?>  class="pj pjr">


  <div class="<?= Aabc::$app->_model->__sanpham?>-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<p>
    <?php 
         $_Sanpham = Aabc::$app->_model->Sanpham;   
        $countgetAllRecycle1_2 = count($_Sanpham::getAllRecycle1_2());

        if($countgetAllRecycle1_2 > 0){       
            echo '<button type="button"  '.D::ct.' ="'.$countgetAllRecycle1_2.'"  '.D::u.'="da_b" class="btn btn-default bda" '.Aabc::$app->d->type.'="_b"   '.D::i.'='. Sanpham::tt.' ><span class="glyphicon glyphicon-ban-circle mden"></span>Xóa tất cả</button>';
        }
     ?>
</p>

    <?= GridView::widget([ 
        'id' => 'grr'.Aabc::$app->_model->__sanpham,
        'options' => ['class' => 'gr'],
        'summary' => "<div class='sy'>(Từ {begin} - {end} trong {totalCount})</div>",
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [

            [                
                'label' => 'ID',                                
                'format' => 'raw',
                'value' => function ($model) { 
                    return $model->sp_id;
                }, 
            ],

            [                
                'label' => 'Tên sản phẩm',                                
                'format' => 'raw',
                'value' => function ($model) { 
                    return Html::encode($model->sp_tensp);
                }, 
            ],

             [                
                'label' => 'Mã sản phẩm/ Barcode',                                
                'format' => 'raw',
                'value' => function ($model) { 
                    return $model->sp_masp;
                }, 
            ],
            
          

             [                
                'label' => 'Khôi phục',                  
                'headerOptions' => ['width' => '100'],
                'format' => 'raw',
                'value' => function ($model) {  
                      $_Sanpham = Aabc::$app->_model->Sanpham;   
                    $countgetAllRecycle1_2 = count($_Sanpham::getAllRecycle1_2());                        
                    return '<div class="text-center" ><button '.Aabc::$app->d->type.'="_b"  '.D::i.'='. Sanpham::tt.'  '.Aabc::$app->d->ct.'="'.$countgetAllRecycle1_2.'"  '.Aabc::$app->d->u.'="res_b?id='.$model->sp_id.'" title="Khôi phục"  type="button" class="be glyphicon glyphicon-floppy-open" ></button></div>';                    
                }, 
            ],


            [           
                'label' => 'Xóa hẳn',  
                'headerOptions' => ['width' => '100'],
                'format' => 'raw',
                'value' => function ($model) {    
                     $_Sanpham = Aabc::$app->_model->Sanpham;   
                    $countgetAllRecycle1_2 = count($_Sanpham::getAllRecycle1_2());                      
                    return '<div class="text-center" ><button '.Aabc::$app->d->type.'="_b"  '.D::i.'='. Sanpham::tt.'  '.Aabc::$app->d->ct.'="'.$countgetAllRecycle1_2.'" '.Aabc::$app->d->u.'="d_b?id='.$model->sp_id.'" title="Xóa" type="button" class="bd glyphicon glyphicon-ban-circle" ></button></div>'; 
                }, 
            ],

        ],

        //« » ‹ ›
        'pager' => [
            'firstPageLabel' => '«',
            'lastPageLabel' => '»',

            'nextPageLabel' => '›',
            'prevPageLabel'  => '‹',
            
            'maxButtonCount'=>1, // Số page hiển thị ví dụ: (First  1 2 3 Last)
        ],


 ]); ?>

</div>
<div class="xd"></div>




</div>
