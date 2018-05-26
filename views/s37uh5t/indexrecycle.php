<?php

use aabc\helpers\Html;
use aabc\grid\GridView;

use aabc\bootstrap\Modal; /*Them*/
use aabc\helpers\Url; /*Them*/
use aabc\helpers\ArrayHelper; /*Them*/
use aabc\widgets\ActiveForm;
/*use app\models\Dskh; */



/* @var $this aabc\web\View */
// use backend\models\Sanpham3Search ;
// use backend\models\Sanpham3 ;
/* @var $dataProvider aabc\data\ActiveDataProvider */

$this->title = 'Sanpham3s';
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="pjr<?= Aabc::$app->_model->__sanpham3?>"  <?=Aabc::$app->d->i  ?>="<?= Aabc::$app->_model->__sanpham3?>"  class="pj">


<div class="<?= Aabc::$app->_model->__sanpham3?>-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>



<p>
  
    <?php  
    $_Sanpham3 = Aabc::$app->_model->Sanpham3; 
    $countgetAllRecycle1 = count($_Sanpham3::getAllRecycle1());
    
    if($countgetAllRecycle1 > 0){       
        echo '<button type="button"  '.Aabc::$app->d->ct.'="'.count($_Sanpham3::getAllRecycle1()).'" '.Aabc::$app->d->u.' ="da" class="btn btn-default bda" '.Aabc::$app->d->i.' ="'.Aabc::$app->_model->__sanpham3.'"><span class="glyphicon glyphicon-ban-circle mden"></span>Xóa tất cả</button>';
    }
     ?>

</p>




    <?= GridView::widget([ 
        'id' => 'grr'.Aabc::$app->_model->__sanpham3,
        'options' => ['class' => 'gr'],
        'summary' => "<div class='sy'>(Từ {begin} - {end} trong {totalCount})</div>",
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [


             Aabc::$app->_sanpham3->sp_id,
             Aabc::$app->_sanpham3->sp_tensp,
             Aabc::$app->_sanpham3->sp_masp,
            //  Aabc::$app->_sanpham3->sp_linkseo,
            //  Aabc::$app->_sanpham3->sp_linkanhdaidien,
            //  Aabc::$app->_sanpham3->sp_images:ntext,
            //  Aabc::$app->_sanpham3->sp_status,
            //  Aabc::$app->_sanpham3->sp_recycle,
            //  Aabc::$app->_sanpham3->sp_conhang,
            //  Aabc::$app->_sanpham3->sp_view,
            //  Aabc::$app->_sanpham3->sp_ngaytao,
            //  Aabc::$app->_sanpham3->sp_ngayupdate,
            //  Aabc::$app->_sanpham3->sp_idnguoitao,
            //  Aabc::$app->_sanpham3->sp_idnguoiupdate,
            //  Aabc::$app->_sanpham3->sp_id_ncc,
            //  Aabc::$app->_sanpham3->sp_id_thuonghieu,
            //  Aabc::$app->_sanpham3->sp_gia,
            //  Aabc::$app->_sanpham3->sp_giakhuyenmai,
            //  Aabc::$app->_sanpham3->sp_soluong,
            //  Aabc::$app->_sanpham3->sp_soluongfake,
            //  Aabc::$app->_sanpham3->sp_soluotmua,
          
            //[                
            //    'label' => 'Khôi phục',                                  
            //    'format' => 'raw',
            //    'value' => function ($model) {                          
            //        return $model->id;                    
            //    }, 
            //],


             [                
                'label' => 'Khôi phục',                  
                'headerOptions' => ['width' => '100'],
                'format' => 'raw',
                'value' => function ($model) { 
                    $_Sanpham3 = Aabc::$app->_model->Sanpham3;                          
                    return '<div class="text-center" ><button  '.Aabc::$app->d->ct.' ="'.count($_Sanpham3::getAllRecycle1()).'"  '.Aabc::$app->d->i.' ="'.Aabc::$app->_model->__sanpham3.'" '.Aabc::$app->d->u.' ="res?id='.$model[Aabc::$app->_sanpham3->sp_id].'"  type="button" class="be glyphicon glyphicon-floppy-open" ></button></div>';                    
                }, 
            ],


            [           
                'label' => 'Xóa',  
                'headerOptions' => ['width' => '100'],
                'format' => 'raw',
                'value' => function ($model) {    
                    $_Sanpham3 = Aabc::$app->_model->Sanpham3;                       
                    return '<div class="text-center" ><button '.Aabc::$app->d->ct.'="'.count($_Sanpham3::getAllRecycle1()).'"  '.Aabc::$app->d->i.' ="'.Aabc::$app->_model->__sanpham3.'" '.Aabc::$app->d->u.' ="d?id='.$model[Aabc::$app->_sanpham3->sp_id].'"  type="button" class="bd glyphicon glyphicon-ban-circle" ></button></div>'; 
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
