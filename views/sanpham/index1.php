<?php

use common\cont\D;
use backend\models\Sanpham;

use aabc\helpers\Html;
use aabc\grid\GridView;

// use aabc\bootstrap\Modal; /*Them*/
use aabc\helpers\Url; /*Them*/
use aabc\helpers\ArrayHelper; /*Them*/
use aabc\widgets\ActiveForm;

use backend\models\Thuonghieu;

$_Danhmuc = Aabc::$app->_model->Danhmuc;


$this->title = 'Sanphams';
$this->params['breadcrumbs'][] = $this->title;
?>


<?php
// if ($this->beginCache('sp-index')) {
    ?> 
<div id="pj<?= Sanpham::tt?>"    <?= D::i?>=<?= Sanpham::tt?> class="pj">
<div class="<?= Sanpham::tt?>-index">
    <div class="content-left  col-md-2">
         <div class="dnn">
            <fieldset>            
                <p>                     
                <?php  
                    echo '<span>'.Aabc::$app->MyConst->vindex_search_tenma.'</span>';
                    echo Html::input('text', 'sp_ten_ma', Aabc::$app->request->get('sp_ten_ma') != NULL ? urldecode(Aabc::$app->request->get('sp_ten_ma')) : '' , ['class' => 'form-control inpsea', 'placeholder' => 'Tìm theo '.Aabc::$app->MyConst->vindex_search_tenma]);

                ?>
                    <i class="glyphicon glyphicon-search"></i>
                </p>

                <div class="menucontent">

                <?php if(Aabc::$app->user->can('web')){ ?>
                 <p> 
                    <?php 
                        echo '<span>'.Sanpham::__sp_status.'</span>';
                        $status = Aabc::$app->request->get(Sanpham::sp_status);
                        $status = $status != NULL ? $status : ['' => '-- Chọn --'];
                        echo Html::dropDownList(Sanpham::sp_status, $status , Sanpham::getTrangthaiOption() , [
                            'multiple'=>'multiple',
                            D::i =>   Sanpham::tt,
                            D::ty => 'ra',
                            D::c => 'one',
                            D::s => 'rel',
                            'class' => 'mulr',
                            'id' =>  Sanpham::tt.'_status_select'
                        ]);

                    ?>
                 </p>

                 <?php } ?>

<!-- 

                 <p> 
                <?php     

                // echo '<span>'.Sanpham::__sp_conhang.'</span>';
                    
                // $conhang = Aabc::$app->request->get(Sanpham::sp_conhang);
                // $conhang = $conhang != NULL ? $conhang : ['' => '-- Chọn --'];

                //     echo Html::dropDownList(Sanpham::sp_conhang, $conhang , Sanpham::getConhangOption() , [
                //             // 'class' => 'btn btn-default',
                //             'multiple'=>'multiple',
                //             D::ty => 'ch',
                //             D::i =>  Sanpham::tt,
                //             D::s => 'rel',
                //             'class' => 'mulr',
                //             'id' =>  Sanpham::tt.'_conhang_select'
                //         ]);



                 ?>
                  </p>



                <p> 
                <?php    
                    // echo '<span>Danh mục</span>';
                     
                      
                    // $danhmuc = Aabc::$app->request->get(Aabc::$app->_danhmuc->dm_id);
                    // $danhmuc =  $danhmuc != NULL ? $danhmuc : ['' => '-- Chọn --'];

                    // echo Html::dropDownList(Aabc::$app->_danhmuc->dm_id,$danhmuc, $_Danhmuc::getDanhmucOption($_Danhmuc::BAIVIET), [
                    //     // 'class' => 'btn btn-default',
                    //     'multiple'=>'multiple',
                    //     D::ty => 'checkbox',
                    //     D::i =>  Sanpham::tt,
                    //     D::s => 'rel',
                    //     'class' => 'mulr',
                    //     'id' =>  Sanpham::tt.'_danhmuc_select'
                    // ]);
                ?>
                </p> 

                <p> 
                <?php    
                    // echo '<span>Nổi bật</span>';                     
                    // $noibat = Aabc::$app->request->get(Aabc::$app->_danhmuc->dm_id.'_dm');
                    // $noibat = $noibat != NULL ? $noibat : ['' => '-- Chọn --'];
                    // echo Html::dropDownList(Aabc::$app->_danhmuc->dm_id.'_dm', $noibat , $_Danhmuc::getDanhmucOption($_Danhmuc::NOIBAT), [
                    //     // 'class' => 'btn btn-default',
                    //         'multiple'=>'multiple',
                    //         D::ty => 'checkbox',
                    //         D::i =>  Sanpham::tt,
                    //         D::s => 'rel',
                    //         'class' => 'mulr',
                    //         'id' =>  Sanpham::tt.'_noibat_select'
                    //     ]);
                ?>
                </p>   --> 








                <!--  <p> 
                <?php    
                    // echo '<span>'.Sanpham::__sp_id_thuonghieu.'</span>';
                    //  $_Thuonghieu = Aabc::$app->_model->Thuonghieu;
                    //  $th = $_Thuonghieu::getAllRecycle0();   
                    // echo Html::dropDownList(Sanpham::sp_id_thuonghieu, Aabc::$app->request->get(Sanpham::sp_id_thuonghieu) != NULL ? Aabc::$app->request->get(Sanpham::sp_id_thuonghieu) : ['' => Aabc::$app->MyConst->vindex_search_chon], ArrayHelper::map($th, 'thuonghieu_id', 'thuonghieu_ten'), [
                    //     // 'class' => 'btn btn-default',
                    //     'multiple'=>'multiple',
                    //     D::ty => 'checkbox',
                    //     D::i =>  Sanpham::tt,
                    //     D::s => 'rel',
                    //     'class' => 'mulr',
                    //     'id' =>  Sanpham::tt.'_thuonghieu_select'
                    // ]);
                ?>
                </p>    -->
                </div>
            </fieldset>  
           <!--  <div class="bhelp">
                <button class="btn btn-default bhelp" <?php // D::st?>="1" <?php // D::gr?>="1">Hướng dẫn sử dụng</button>
            </div> -->
        </div>

        
       
    </div>




    <div class="content-right  col-md-10">
        <div class="content-right-top">            
             <?php     
                         
                $demthungrac = Sanpham::getAllRecycle1_1();                                
                // echo  '<button type="button" '.($demthungrac > 0 ? : 'disabled').' '. D::i .'="sanpham" class="btn btn-danger mb" '.D::u.'="indexrecycle"><span class="glyphicon glyphicon-trash mtrang"></span>'.Aabc::$app->MyConst->view_btn_thungrac.' ('.$demthungrac.')</button>';  

                echo '<button '.D::m.' = "2" type="button"  '.($demthungrac > 0 ? : 'disabled').'  id="mb'. Sanpham::tt.'r" '.D::u.'="ir" class="btn btn-danger mb" '.D::i.'= '. Sanpham::tt .'><span class="glyphicon glyphicon-trash mden"></span>'.Aabc::$app->MyConst->view_btn_thungrac.' ('.$demthungrac.')</button>';
        
        

             echo '<button type="button" '.D::m.' = "" id="mb'. Sanpham::tt.'"  '.D::u .'="c" class="btn btn-success mb"   '. D::i.'='. Sanpham::tt.'><span class="glyphicon glyphicon-plus mtrang"></span>'.Aabc::$app->MyConst->view_btn_them.'</button>';

            ?>
         </div>

    <?= GridView::widget([ 
        'id' => 'gr'. Sanpham::tt,       
        'options' => ['class' => 'gr'],
        'emptyText' => Aabc::$app->MyConst->gridview_khongthayketqua,
        'summary' => "<div class='sy'>(Từ {begin} - {end} trong {totalCount})</div>",
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'rowOptions' => function($model){            
            $class = '';
            // if ($model[Sanpham::sp__status == '2'){
            //     $class = 'an';
            // }
            return ['class'=>$class];
        },



        'columns' => [
            //  [
            //     'class' => 'aabc\grid\SerialColumn',
            //     // 'headerOptions' => ['width' => '32'],
            //     'contentOptions' => ['style' => 'max-width:20px;'],
            // ],

            [                
                'class' => 'aabc\grid\CheckboxColumn',  
                'headerOptions' => ['width' => '32'],           
                'checkboxOptions' => function($model) {                   
                   return ['value' => $model[Sanpham::sp_id]];                    
                },
                'cssClass' => 'ca',
                'name' => 'tuyen', 
            ],

             [
                    'class' => 'aabc\grid\SerialColumn', 
                    'headerOptions' => ['width' => '20'],                       
                ],
            

            [
                // 
                // 'header' => '<a href="/20170715/ad/sanpham/i?k=k5&f=g8&sort=sp_3tensp">sort</a>',
                // 'attribute' => Sanpham::sp_tensp, 
                'label' => 'Tên sản phẩm',
                'attribute' => Sanpham::sp_tensp,
                
                'headerOptions' => ['width' => '300'], 
                'format' => 'raw',
                'filterInputOptions' => [
                    'class'       => 'form-control',                    
                ],
                //'visible' => \Aabc::$app->user->can('posts.owner.view'),
                //'visible' =>  !Aabc::$app->user->isGuest,
                // 'visible' =>  !1,
                'value' => function ($model) {                          
                    // return '<img src="'.$model[Sanpham::sp_linkanhdaidien].'" />'. Html::encode($model[Sanpham::sp_tensp]); 

                    $return = '';
                    if(isset($model[Sanpham::sp_images])){
                        $listimg = explode("-",$model[Sanpham::sp_images]);
                        $value = $listimg[0];
                        $_Image = Aabc::$app->_model->Image;
                        $img = $_Image::find()->andWhere([Aabc::$app->_image->image_id => $value])->one();
                        if(isset($img)){
                            $return = '<img src="/thumb/75/75/'.$img[Aabc::$app->_image->image_tenfile]. '-' . $img[Aabc::$app->_image->image_id]. $img[Aabc::$app->_image->image_morong].'" />';
                        }                                            
                    }                       
                    return($return . Html::encode($model[Sanpham::sp_tensp])); 
                },
            ],

           

            //  [                
                
            //     'attribute' => Sanpham::sp_masp,   
            //     // 'headerOptions' => ['width' => '200'],              
            //     'format' => 'raw',
            //     'filterInputOptions' => [
            //         'class'       => 'form-control',                    
            //      ],
            //     'value' => function ($model) {                          
            //         return $model[Sanpham::sp_masp];                                      
            //     }, 

            // ],


            // 'sp_linkseo',
            // 'sp_linkanhdaidien',
            //     'sp_status',
                
            //     'sp_conhang',

             
                [                
                        'header' => 'Danh mục',  
                        // 'visible' => Aabc::$app->user->can('web'),            
                        'format' => 'raw',
                        'filterInputOptions' => [
                            'class' => 'form-control',                    
                         ],  
                        'value' => function ($model) { 
                            $_Danhmuc = Aabc::$app->_model->Danhmuc;

                            $danhmuc = $model->getDanhmucList($_Danhmuc::SANPHAM);

                           

                            $return = '';
                            foreach ($danhmuc as $key => $value) {
                                if($return) $return = $return . ', ';
                                $return = $return . $value[Aabc::$app->_danhmuc->dm_ten];
                            }
                            return Html::encode($return);
                        }, 
                    ],



                    // [                
                    //     'header' => 'Nổi bật',  
                    //     // 'visible' => Aabc::$app->user->can('web'),            
                    //     'format' => 'raw',
                    //     'filterInputOptions' => [
                    //         'class' => 'form-control',                    
                    //      ],  
                    //     'value' => function ($model) { 
                    //         $_Danhmuc = Aabc::$app->_model->Danhmuc;
                    //         $danhmuc = $model->getDanhmucList($_Danhmuc::NOIBAT);
                    //         $return = '';
                    //         foreach ($danhmuc as $key => $value) {
                    //             if($return) $return = $return . ', ';
                    //             $return = $return . $value[Aabc::$app->_danhmuc->dm_ten];
                    //         }
                    //         return Html::encode($return);
                    //     }, 
                    // ],





            
                    //   [                
                    //     'attribute' => Sanpham::sp_id_ncc,
                    //     // 'attribute' => Aabc::$app->_thuonghieu->thuonghieu_ten,
                    //     // 'headerOptions' => ['width' => '200'],              
                    //     'format' => 'raw',               
                    //     'value' => 'spIdNcc.'.Aabc::$app->_nhacungcap->ncc_ten,

                    // ],



                  
                    //  [                
                    //     'attribute' => Sanpham::sp_id_thuonghieu,
                    //     // 'attribute' => Aabc::$app->_thuonghieu->thuonghieu_ten,
                    //     // 'headerOptions' => ['width' => '200'],              
                    //     'format' => 'raw',               
                    //     'value' => 'spIdThuonghieu.'.Aabc::$app->_thuonghieu->thuonghieu_ten,

                    // ],
                    



                     [                

                        'attribute' => Sanpham::sp_gia,
                        // 'attribute' => 'sp_gia', 
                        //'visible' => Aabc::$app->user->can('web'),            
                        'format' => 'raw',
                        'filterInputOptions' => [
                            'class' => 'form-control',                    
                         ],
                        'value' => function ($model) { 
                            if(is_numeric($model[Sanpham::sp_gia])){
                                return number_format($model[Sanpham::sp_gia]);    
                            }else{
                                return $model[Sanpham::sp_gia];
                            }
                        }, 

                    ],


                    // 'sp_gia',
                    // 'sp_giakhuyenmai',
                    //Sanpham::sp_soluong,
                    // 'sp_soluongfake',
                    // // 'sp_id_khohang',
                    // 'sp_id_baohanh',
                    // 'sp_id_giaohang',
                    // 'sp_soluotmua',
            
            //  [                
            //     'header' => '<a href="'.Aabc::$app->homeUrl.'sanpham">Reset</a>',
            //     //// 'attribute' => '#',
            //     'headerOptions' => ['width' => '70'],                
            //     'format' => 'raw',
            //     'value' => function ($model) {                         
            //         return '<button title="Cập nhật"  type="button" class="mb glyphicon glyphicon-pencil" d-u="'.Aabc::$app->homeUrl.'sanpham/update?id='.$model[Sanpham::sp_id.'"></button>

            //         <button title="Xóa" type="button" class="br glyphicon glyphicon-trash" d-u="'.Aabc::$app->homeUrl.'sanpham/recycle?id='.$model[Sanpham::sp_id.'"></button>';                                      
            //     }, 
            // ],


            //  [                
            //     'attribute' => 'sp_id',                
            //     'format' => 'raw',
            //     'filterInputOptions' => [
            //         'class'       => 'form-control',
            //         'placeholder' => 'Lọc theo id sản phẩm'
            //      ],
            //     'value' => function ($model) {                          
            //         return $model[Sanpham::sp_id;                                      
            //     }, 
            // ],



             [           
                'label' => 'Hiển thị',
                'attribute' => Sanpham::sp_status, 
                'visible' => Aabc::$app->user->can('web'),

                // 'contentOptions' => ['class' => 'text-center'],

                // 'headerOptions' => ['width' => '200'],              
                'format' => 'raw',
                'filterInputOptions' => [
                    'class'       => 'form-control',                    
                 ],
                'value' => function ($model) {                     
                    return $model->getTrangthaiLabelColor($model[Sanpham::sp_status]);                    
                }, 

            ],



            [                
                
                'attribute' => Sanpham::sp_conhang, 
                // 'headerOptions' => ['width' => '100'],  
                 // 'header' => 'sp_conhang'
                // 'contentOptions' => ['class' => 'text-center'],

                // 'headerOptions' => ['width' => '200'],              
                'format' => 'raw',
                'filterInputOptions' => [
                    'class'       => 'form-control',                    
                 ],
                'value' => function ($model) {                
                    return $model->getConhangLabelColor($model[Sanpham::sp_conhang]);
                }, 

            ],





             [                
                //'header' => '<a href="'.Aabc::$app->homeUrl.'sanpham">Reset</a>',
                'attribute' => Sanpham::sp_id,
                  // 'headerOptions' => ['width' => '100'], 
                // 'headerOptions' => ['width' => '100'],  
                // 'headerOptions' => ['width' => '30px'],
                'contentOptions' => [
                    'class' => 'omb',                    
                ],
                'format' => 'raw',
                'value' => function ($model) {                         
                    return '<div>'.$model[Sanpham::sp_ma].'</div><div class="omc" id="'. Sanpham::tt.$model[Sanpham::sp_id].'"><div class="omd">
                    

                    <button '.D::i.'="'. Sanpham::tt.'" class="mb btn btn-default" '.D::u.'="u?id='.$model[Sanpham::sp_id].'">'.Aabc::$app->MyConst->gridview_menu_suachitiet.'<span class="glyphicon glyphicon-pencil"></span></button>

                    <button class="btn btn-default"><a class="olk" d-h="/link.html" href="">Xem trên trình duyệt</a><span class="glyphicon glyphicon-pencil"></span></button>
                    
                    <div class="gn"></div>
                    '.  
                        (Aabc::$app->user->can('web') ? ($model[Sanpham::sp_status] == 2 ? '<button '.D::i.'="'. Sanpham::tt.'" class="ml btn btn-default" '.D::u.'="ut?id='.$model[Sanpham::sp_id].'">'.Aabc::$app->MyConst->gridview_menu_hienthi.'<span class="glyphicon glyphicon-eye-open"></span></button>' : '<button '.D::i.'="'. Sanpham::tt.'" class="ml btn btn-default" '.D::u.'="ut?id='.$model[Sanpham::sp_id].'">'.Aabc::$app->MyConst->gridview_menu_an.'<span class="glyphicon glyphicon-eye-open"></span></button>') : "" )
                    .'
                    <button '.D::i.'="'. Sanpham::tt.'" class="br btn btn-default" '.D::u.'="rec?id='.$model[Sanpham::sp_id].'">'.Aabc::$app->MyConst->gridview_menu_thungrac.'<span class="glyphicon glyphicon-trash"></span></button>

                    </div></div>';                                      
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

<div class="endgr">
<div class='per-page'>
<?= 
Html::dropDownList('t', $t != NULL ? $t : [20 => 20], [10 => 10, 20 => 20, 50 => 50, 100 => 100, 200 => 200], [    
    'class' => 'ipage btn btn-default',
    'id' => ''
])?>

</div>
<div class="sy0"></div>

<div class='cas'>

     <select id="sel<?=  Sanpham::tt?>" class="btn btn-default">
        <option value="" selected=""><?=Aabc::$app->MyConst->gridview_selectmultiitem_chonthaotac?></option>
        <?php if(Aabc::$app->user->can('web')){ ?>
        <option value="1"><?=Aabc::$app->MyConst->gridview_selectmultiitem_an?></option>
        <option value="2"><?=Aabc::$app->MyConst->gridview_selectmultiitem_hienthi?></option>
        <?php }?>
        <option value="3"><?=Aabc::$app->MyConst->gridview_selectmultiitem_thungrac?></option>        
    </select>

    <?= Html::button(Aabc::$app->MyConst->gridview_selectmultiitem_thuchien, [D::u =>'reca','class'=>'bra btn btn-default', D::i =>  Sanpham::tt, 'method' => 'POST']) ?>
</div>
</div>


</div>


   
<?php //Pjax::end(); ?>
</div>

</div>



<?php
 // $this->endCache();
        // }
    ?>