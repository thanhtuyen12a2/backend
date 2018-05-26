<?php

use aabc\helpers\Html;
use aabc\grid\GridView;

use aabc\bootstrap\Modal; /*Them*/
use aabc\helpers\Url; /*Them*/
use aabc\helpers\ArrayHelper; /*Them*/
use aabc\widgets\ActiveForm;
/*use app\models\Dskh; */



/* @var $this aabc\web\View */
// use backend\models\DomainSearch ;
 use backend\models\Domain ;
/* @var $dataProvider aabc\data\ActiveDataProvider */

$this->title = 'Domains';
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="pjrdomain"  <?= Aabc::$app->d->i?>="domain"  class="pj">


<div class="domain-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>



<p>
  
    <?php  
    $countgetAllRecycle1 = count(Domain::getAllRecycle1());
    
    if($countgetAllRecycle1 > 0){       
        echo '<button type="button"  '.Aabc::$app->d->ct.'="'.count(Domain::getAllRecycle1()).'" '.Aabc::$app->d->u.'="deleteall" class="btn btn-default bda" '.Aabc::$app->d->i.'="domain"><span class="glyphicon glyphicon-ban-circle mden"></span>Xóa tất cả</button>';
    }
     ?>

</p>




    <?= GridView::widget([ 
        'id' => 'grrdomain',
        'options' => ['class' => 'gr'],
        'summary' => "<div class='sy'>(Từ {begin} - {end} trong {totalCount})</div>",
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [


             Aabc::$app->domain->dm_id,
             Aabc::$app->domain->dm_domain,
             Aabc::$app->domain->dm_length,
            //  Aabc::$app->domain->dm_status,
            //  Aabc::$app->domain->dm_recycle,
            //  Aabc::$app->domain->dm_tiemnang,
            //  Aabc::$app->domain->dm_chude,
            //  Aabc::$app->domain->dm_email:email,
          
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
                    return '<div class="text-center" ><button  '.Aabc::$app->d->ct.' = "'.count(Domain::getAllRecycle1()).'"  '.Aabc::$app->d->i.'="domain" '.Aabc::$app->d->u.'="restore?id='.$model[Aabc::$app->domain->dm_id].'"  type="button" class="be glyphicon glyphicon-floppy-open" ></button></div>';                    
                }, 
            ],


            [           
                'label' => 'Xóa',  
                'headerOptions' => ['width' => '100'],
                'format' => 'raw',
                'value' => function ($model) {                          
                    return '<div class="text-center" ><button '.Aabc::$app->d->ct.'="'.count(Domain::getAllRecycle1()).'"  '.Aabc::$app->d->i.'="domain" '.Aabc::$app->d->u.'="delete?id='.$model[Aabc::$app->domain->dm_id].'"  type="button" class="bd glyphicon glyphicon-ban-circle" ></button></div>'; 
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

   
    //changea('rdomain');



    ")
    ?>



</div>
