<?php

use aabc\helpers\Html;   
use aabc\grid\GridView;

//use aabc\bootstrap\Modal; /*Them*/
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

<div id="pj<?=Aabc::$app->_model->__sanpham3?>"    <?=Aabc::$app->d->i?>=<?= Aabc::$app->_model->__sanpham3?> class="pj">


<div class="<?= Aabc::$app->_model->__sanpham3?>-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


<p>  
        
        <button type="button"  <?=Aabc::$app->d->m  ?>="2" id="mb<?= Aabc::$app->_model->__sanpham3?>" <?=Aabc::$app->d->u  ?>  ="c" class="btn btn-default mb" <?=Aabc::$app->d->i  ?>="<?= Aabc::$app->_model->__sanpham3?>"><span class="glyphicon glyphicon-plus mxanh"></span><?=Aabc::$app->MyConst->view_btn_them?></button>
  

         <?php         
        $_Sanpham3 = Aabc::$app->_model->Sanpham3;        
        $demthungrac = count($_Sanpham3::getAllRecycle1());

            echo '<button type="button"  '.Aabc::$app->d->m.'="2"  '.($demthungrac > 0 ? : 'disabled').'  id="mb<?= Aabc::$app->_model->__sanpham3?>r" '.Aabc::$app->d->u.'="ir" class="btn btn-default mb" '.Aabc::$app->d->i.'="<?= Aabc::$app->_model->__sanpham3?>"><span class="glyphicon glyphicon-trash mden"></span>'.Aabc::$app->MyConst->view_btn_thungrac.' ('.$demthungrac.')</button>';
        
        ?>



    </p>



    <?= GridView::widget([ 
        'id' => 'gr'.Aabc::$app->_model->__sanpham3,
        'options' => ['class' => 'gr'],
        'emptyText' => Aabc::$app->MyConst->gridview_khongthayketqua,
        'summary' => "<div class='sy'>(Từ {begin} - {end} trong {totalCount})</div>",
        'dataProvider' => $dataProvider,
        'rowOptions' => function($model){            
            $class = '';
            if ($model[Aabc::$app->_sanpham3->sp_status] == '2'){
                $class = 'an';
            }
            return ['class'=>$class];
        },
        //'filterModel' => $searchModel,
        'columns' => [


         [
            'class' => 'aabc\grid\CheckboxColumn',             
                'checkboxOptions' => function($model) {                  
                   return ['value' => $model[Aabc::$app->_sanpham3->sp_id]];                    
                },
                'headerOptions' => ['width' => '32'],
                'cssClass' => 'ca',
                'name' => 'tuyen', 
          ],

     


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
                     

             [                
                //'header' => '<a href="'.Aabc::$app->homeUrl.'sanpham">Reset</a>',
                'attribute' => Aabc::$app->_sanpham3->sp_id,
                //'headerOptions' => ['width' => '100'],                 
                'contentOptions' => [
                    'class' => 'omb',                    
                ],
                'format' => 'raw',
                'value' => function ($model) {                         
                    return '<div>'.$model[Aabc::$app->_sanpham3->sp_id].'</div><div class="omc" id="'.Aabc::$app->_model->__sanpham3.$model[Aabc::$app->_sanpham3->sp_id].'"><div class="omd">

                    <button type="button"  '.Aabc::$app->d->m.'="2"  class="mb btn btn-default" '.Aabc::$app->d->i.'='.Aabc::$app->_model->__sanpham3.'  '.Aabc::$app->d->u.'="u?id='.$model[Aabc::$app->_sanpham3->sp_id].'">'.Aabc::$app->MyConst->gridview_menu_suachitiet.'<span class="glyphicon glyphicon-pencil"></span></button>

                    <div class="gn"></div>
                    '.                        
                        (Aabc::$app->user->can('web') ?  ($model[Aabc::$app->_sanpham3->sp_status] == 2 ? '<button type="button" class="ml btn btn-default" '.Aabc::$app->d->i.'='.Aabc::$app->_model->__sanpham3.'   '.Aabc::$app->d->u.'="us?id='.$model[Aabc::$app->_sanpham3->sp_id].'">'.Aabc::$app->MyConst->gridview_menu_hienthi.'<span class="glyphicon glyphicon-eye-open"></span></button>' : '<button type="button" class="ml btn btn-default" '.Aabc::$app->d->i.'='.Aabc::$app->_model->__sanpham3.'   '.Aabc::$app->d->u.'="us?id='.$model[Aabc::$app->_sanpham3->sp_id].'">'.Aabc::$app->MyConst->gridview_menu_an.'<span class="glyphicon glyphicon-eye-open"></span></button>') : "" )

                    .'
                    <button type="button" class="br btn btn-default" '.Aabc::$app->d->i.'='.Aabc::$app->_model->__sanpham3.'  '.Aabc::$app->d->u.'="rec?id='.$model[Aabc::$app->_sanpham3->sp_id].'">'.Aabc::$app->MyConst->gridview_menu_thungrac.'<span class="glyphicon glyphicon-trash"></span></button>

                    </div></div>';                                      
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


   

<div class="endgr">

<div class='per-page'>

<?= 
Html::dropDownList('t', Aabc::$app->request->get('t') != NULL ? Aabc::$app->request->get('t') : [10 => 10], [10 => 10, 20 => 20, 50 => 50, 100 => 100, 200 => 200], [    
    'class' => 'ipage btn btn-default',
    'id' => ''
])?></div>



 <div class='cas'>

     <select id="sel<?= Aabc::$app->_model->__sanpham3?>" class="btn btn-default">
         <option value="" selected="">--Chọn thao tác--</option>
                  <option value="1"><?=Aabc::$app->MyConst->gridview_selectmultiitem_an?></option>
        <option value="2"><?=Aabc::$app->MyConst->gridview_selectmultiitem_hienthi?></option>
                <option value="3"><?=Aabc::$app->MyConst->gridview_selectmultiitem_thungrac?></option>      
    </select>

     <?= Html::button(Aabc::$app->MyConst->gridview_selectmultiitem_thuchien, [Aabc::$app->d->i => Aabc::$app->_model->__sanpham3, Aabc::$app->d->u =>'recycleall','class' => 'btn btn-default bra', 'method' => 'POST']) ?>
</div>

</div>
<div style="clear: both"></div>



</div>
