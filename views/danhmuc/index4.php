<?php

use aabc\helpers\Html;   
use aabc\grid\GridView;

//use aabc\bootstrap\Modal; /*Them*/
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

<div id="pj<?=Aabc::$app->_model->__danhmuc?>"    <?=Aabc::$app->d->i?>=<?= Aabc::$app->_model->__danhmuc?> class="pj">


<div class="<?=Aabc::$app->_model->__danhmuc?>-index">

    

     <div class="content-left  col-md-2">
         <div class="dnn">
            <fieldset>               
              
            </fieldset>  
            <div class="bhelp">
                <button class="btn btn-default bhelp"  <?= Aabc::$app->d->st?> ="1"    <?= Aabc::$app->d->gr?> ="1" >Hướng dẫn sử dụng</button>
            </div>
        </div>
    </div>



  <div class="content-right  col-md-10">

    <div class="content-right-top">       
        <?php      
        $_Danhmuc = Aabc::$app->_model->Danhmuc;        
        $demthungrac = count($_Danhmuc::getAllRecycle1_4());

            echo '<button  '.Aabc::$app->d->m.' = "2"  type="button"  '.($demthungrac > 0 ? : 'disabled').'  id="mb'.Aabc::$app->_model->__danhmuc.'r" '.Aabc::$app->d->u.'="ir_mn" class="btn btn-danger mb" '.Aabc::$app->d->i.'= '.Aabc::$app->_model->__danhmuc .'><span class="glyphicon glyphicon-trash mden"></span>'.Aabc::$app->MyConst->view_btn_thungrac.' ('.$demthungrac.')</button>';
        
        

         echo '<button type="button" '.Aabc::$app->d->m.' = "3" id="mb'.Aabc::$app->_model->__danhmuc.'"  '.Aabc::$app->d->u .'="c" class="btn btn-success mb"   '. Aabc::$app->d->i.'='.Aabc::$app->_model->__danhmuc.'><span class="glyphicon glyphicon-plus mtrang"></span>'.Aabc::$app->MyConst->view_btn_them.'</button>';

         ?>
    </div>

  
    
    <?= $this->render('_gridview4', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]) ?>


   

</div>

   

</div>
