<?php

use aabc\helpers\Html;
use aabc\grid\GridView;

use aabc\bootstrap\Modal; /*Them*/
use aabc\helpers\Url; /*Them*/
use aabc\helpers\ArrayHelper; /*Them*/
use aabc\widgets\ActiveForm;
/*use app\models\Dskh; */



/* @var $this aabc\web\View */
// use backend\models\ItemhelpSearch ;
 use backend\models\Itemhelp ;
/* @var $dataProvider aabc\data\ActiveDataProvider */

$this->title = 'Itemhelps';
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="pjritemhelp"  d-i="itemhelp"  class="pj">


<div class="itemhelp-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>



<p>
  
    <?php  
    $countgetAllRecycle1 = count(Itemhelp::getAllRecycle1());
    
    if($countgetAllRecycle1 > 0){       
        echo '<button type="button"  d-h="2"  d-ct="'.count(Itemhelp::getAllRecycle1()).'" d-u="deleteall" class="btn btn-default bda" d-i="itemhelp"><span class="glyphicon glyphicon-ban-circle mden"></span>Xóa tất cả</button>';
    }
     ?>

</p>




    <?= GridView::widget([ 
        'id' => 'grritemhelp',
        'options' => ['class' => 'gr'],
        'summary' => "<div class='sy'>(Từ {begin} - {end} trong {totalCount})</div>",
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [


            'ih_id',
            'ih_action',
            'ih_check',
            // 'ih_focus',
            // 'ih_noidung:ntext',
            // 'ih_sothutu',
            // 'ih_id_grouphelp',
          
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
                    return '<div class="text-center" ><button  d-h="2"  d-ct="'.count(Itemhelp::getAllRecycle1()).'"  d-i="itemhelp" d-u="restore?id='.$model->ih_id.'" title="Khôi phục"  type="button" class="be glyphicon glyphicon-floppy-open" ></button></div>';                    
                }, 
            ],


            [           
                'label' => 'Xóa hẳn',  
                'headerOptions' => ['width' => '100'],
                'format' => 'raw',
                'value' => function ($model) {                          
                    return '<div class="text-center" ><button  d-h="2"  d-ct="'.count(Itemhelp::getAllRecycle1()).'"  d-i="itemhelp" d-u="delete?id='.$model->ih_id.'" title="Xóa" type="button" class="bd glyphicon glyphicon-ban-circle" ></button></div>'; 
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

    <?php
 //Lên đầu trang khi next page
$this->registerJs(  
    "    

   
    changea('ritemhelp');



    ")
    ?>



</div>
