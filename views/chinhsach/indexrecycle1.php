<?php

use aabc\helpers\Html;
use aabc\grid\GridView;

use aabc\bootstrap\Modal; /*Them*/
use aabc\helpers\Url; /*Them*/
use aabc\helpers\ArrayHelper; /*Them*/
use aabc\widgets\ActiveForm;
/*use app\models\Dskh; */



/* @var $this aabc\web\View */
// use backend\models\ChinhsachSearch ;
// use backend\models\Chinhsach ;
/* @var $dataProvider aabc\data\ActiveDataProvider */

$this->title = 'Khuyến mại tặng kèm';
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="pjr<?= Aabc::$app->_model->__chinhsach?>"  <?=Aabc::$app->d->i  ?>="<?= Aabc::$app->_model->__chinhsach?>"  class="pj">


<div class="<?= Aabc::$app->_model->__chinhsach?>-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>



<p>
  
    <?php  
    $_Chinhsach = Aabc::$app->_model->Chinhsach; 
    $countgetAllRecycle1_1 = count($_Chinhsach::getAllRecycle1_1());
    
    if($countgetAllRecycle1_1 > 0){       
        echo '<button type="button"  '.Aabc::$app->d->ct.'="'.$countgetAllRecycle1_1.'" '.Aabc::$app->d->u.' ="da_km" class="btn btn-default bda" '.Aabc::$app->d->i.' ="'.Aabc::$app->_model->__chinhsach.'"><span class="glyphicon glyphicon-ban-circle mden"></span>Xóa tất cả</button>';
    }
     ?>

</p>




    <?= GridView::widget([ 
        'id' => 'grr'.Aabc::$app->_model->__chinhsach,
        'options' => ['class' => 'gr'],
        'summary' => "<div class='sy'>(Từ {begin} - {end} trong {totalCount})</div>",
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [


             Aabc::$app->_chinhsach->cs_id,
             Aabc::$app->_chinhsach->cs_type,
             Aabc::$app->_chinhsach->cs_ten,
            //  Aabc::$app->_chinhsach->cs_code,
            //  Aabc::$app->_chinhsach->cs_ghichu,
            //  Aabc::$app->_chinhsach->cs_typetyle,
            //  Aabc::$app->_chinhsach->cs_tylechietkhau,
            //  Aabc::$app->_chinhsach->cs_apdungcho,
            //  Aabc::$app->_chinhsach->cs_dieukien,
            //  Aabc::$app->_chinhsach->cs_noidungdieukien,
            //  Aabc::$app->_chinhsach->cs_status,
            //  Aabc::$app->_chinhsach->cs_recycle,
            //  Aabc::$app->_chinhsach->cs_ngaytao,
            //  Aabc::$app->_chinhsach->cs_ngaybatdau,
            //  Aabc::$app->_chinhsach->cs_ngayketthuc,
          
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
                    $_Chinhsach = Aabc::$app->_model->Chinhsach; 
                    $countgetAllRecycle1_1 = count($_Chinhsach::getAllRecycle1_1());                                      
                    return '<div class="text-center" ><button   '.Aabc::$app->d->type.'="_km"   '.Aabc::$app->d->ct.' ="'.$countgetAllRecycle1_1.'"  '.Aabc::$app->d->i.' ="'.Aabc::$app->_model->__chinhsach.'" '.Aabc::$app->d->u.' ="res_km?id='.$model[Aabc::$app->_chinhsach->cs_id].'"  type="button" class="be glyphicon glyphicon-floppy-open" ></button></div>';                    
                }, 
            ],


            [           
                'label' => 'Xóa',  
                'headerOptions' => ['width' => '100'],
                'format' => 'raw',
                'value' => function ($model) {   
                    $_Chinhsach = Aabc::$app->_model->Chinhsach; 
                    $countgetAllRecycle1_1 = count($_Chinhsach::getAllRecycle1_1());                     
                    return '<div class="text-center" ><button  '.Aabc::$app->d->type.'="_km"   '.Aabc::$app->d->ct.'="'.$countgetAllRecycle1_1.'"  '.Aabc::$app->d->i.' ="'.Aabc::$app->_model->__chinhsach.'" '.Aabc::$app->d->u.' ="d_km?id='.$model[Aabc::$app->_chinhsach->cs_id].'"  type="button" class="bd glyphicon glyphicon-ban-circle" ></button></div>'; 
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
