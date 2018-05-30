<?php

use aabc\helpers\Html;   
use aabc\grid\GridView;
use common\cont\D;

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
                <br/>
                <div class="menucontent">              
                <p> 
                    <?php 
                        $_Danhmuc = Aabc::$app->_model->Danhmuc;
                        echo '<span>Danh mục sản phẩm</span>';
                        $status = Aabc::$app->request->get('dmsp');
                        $status = $status != NULL ? $status : ['' => '-- Chọn --'];
                        echo Html::dropDownList('dmsp', $status , $_Danhmuc::getDanhmucOption(1), [                
                              // 'multiple'=>'multiple',
                              D::i =>  Aabc::$app->_model->__danhmuc,
                              D::ty => 'ra',
                              D::c => 'one',
                              D::s => 'rel',
                              D::t => 'sea',
                              'class' => 'mulr',
                              'id' =>  Aabc::$app->_model->__danhmuc.'_dmsp_select'
                          ]);

                    ?>
                 </p>


                  <p> 
                    <?php 
                        $_Danhmuc = Aabc::$app->_model->Danhmuc;

                        if(empty(Aabc::$app->request->get('dmsp'))){
                            $all = $_Danhmuc::getDanhmucOption(1);                
                            reset($all);
                            $first_key = key($all);
                            $dmsp = $first_key;
                        }else{
                           $dmsp = Aabc::$app->request->get('dmsp');
                        }

                        $data_ts = $_Danhmuc::find()->andWhere(['dm_level' => 1, 'dm_dmsp' => $dmsp])->all();
                        $value_ts = Aabc::$app->request->get('ts');
                        if($data_ts){
                          $data_ts = ['' => '--- Chọn ---'] + ArrayHelper::map($data_ts, Aabc::$app->_danhmuc->dm_id, 'dm_ten');
                        }else{
                          $data_ts = [];
                          $value_ts = '';
                        }                        

                        echo '<span>Thông số</span>';
                        
                        $value_ts = (!empty($value_ts) ? $value_ts : ['' => '--- Chọn ---']);
                        echo Html::dropDownList('ts', $value_ts , $data_ts , [                
                              // 'multiple'=>'multiple',
                              D::i =>  Aabc::$app->_model->__danhmuc,
                              D::ty => 'ra',
                              D::c => 'one',
                              D::s => 'rel',
                              D::t => 'sea',
                              'class' => 'mulr',
                              'id' =>  Aabc::$app->_model->__danhmuc.'_ts_select'
                          ]);
                    ?>

                    <script type="text/javascript">
                     $(document).ready(function(){                        
                        $('#danhmuc_ts_select-pa').click();
                    })
                    </script>

                 </p>
               </div>
            </fieldset>  
            <!-- <div class="bhelp">
                <button class="btn btn-default bhelp"  <?php //Aabc::$app->d->st?> ="1"    <?php // Aabc::$app->d->gr?> ="1" >Hướng dẫn sử dụng</button>
            </div> -->
        </div>
    </div>



  <div class="content-right  col-md-10">

    <div class="content-right-top">       
        <?php      
        $_Danhmuc = Aabc::$app->_model->Danhmuc;        
        $demthungrac = count($_Danhmuc::getAllRecycle1_4());

            echo '<button  '.Aabc::$app->d->m.' = "2"  type="button"  '.($demthungrac > 0 ? : 'disabled').'  id="mb'.Aabc::$app->_model->__danhmuc.'r" '.Aabc::$app->d->u.'="ir_tn" class="btn btn-danger mb" '.Aabc::$app->d->i.'= '.Aabc::$app->_model->__danhmuc .'><span class="glyphicon glyphicon-trash mden"></span>'.Aabc::$app->MyConst->view_btn_thungrac.' ('.$demthungrac.')</button>';
        
        
          $danhmuc_daco_thongso =  $_Danhmuc::find()
                        ->select(['dm_dmsp'])
                        ->andWhere(['is not','dm_dmsp', null])
                        ->groupBy(['dm_dmsp'])
                        ->column();

          $all = $_Danhmuc::find()
                        ->andWhere([Aabc::$app->_danhmuc->dm_status => $_Danhmuc::ON])
                        ->andWhere([Aabc::$app->_danhmuc->dm_recycle => $_Danhmuc::NGOAITHUNGRAC])    
                        ->andWhere([Aabc::$app->_danhmuc->dm_type => 1])
                        ->andWhere(['not in','dm_id', $danhmuc_daco_thongso])
                        ->orderBy([Aabc::$app->_danhmuc->dm_sothutu=>SORT_ASC])
                        ->all();  
          if($all){
            echo '<button type="button" '.Aabc::$app->d->m.' = "3" id="mb'.Aabc::$app->_model->__danhmuc.'"  '.Aabc::$app->d->u .'="c_tn" class="btn btn-success mb"   '. Aabc::$app->d->i.'='.Aabc::$app->_model->__danhmuc.'><span class="glyphicon glyphicon-plus mtrang"></span>Thêm nhóm</button>';
          }

         ?>
    </div>

  

    <?= $this->render('_gridview5', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]) ?>


   

</div>

   

</div>
