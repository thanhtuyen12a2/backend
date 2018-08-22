<?php

use common\cont\D;
use backend\models\Sanpham;

use aabc\helpers\Html;
use aabc\grid\GridView;

use aabc\helpers\Url; /*Them*/
use aabc\helpers\ArrayHelper; /*Them*/
use aabc\widgets\ActiveForm;

use backend\models\Thuonghieu;

$this->title = 'Sanphams';
$this->params['breadcrumbs'][] = $this->title;
?>

<div id="pj<?= Sanpham::tt?>"    <?= D::i?>=<?= Sanpham::tt?> class="pj">
<div class="<?= Sanpham::tt?>-index">
    <div class="content-left  col-md-2">
         <div class="dnn">
            <fieldset>
            
                <p>                     
                <?php  
                    echo '<span>'.Aabc::$app->MyConst->vindex_search_tenma_2.'</span>';
                    echo Html::input('text', 'sp_ten_ma', Aabc::$app->request->get('sp_ten_ma') != NULL ? urldecode(Aabc::$app->request->get('sp_ten_ma')) : '' , ['class' => 'form-control inpsea', 'placeholder' => 'Tìm theo '.Aabc::$app->MyConst->vindex_search_tenma_2]);

                ?>
                    <i class="glyphicon glyphicon-search"></i>
                </p>

                <div class="menucontent">

                <?php if(Aabc::$app->user->can('web')){ ?>
                 <p> 
                    <?php 
                        // echo '<span>'.Sanpham::__sp_status.'</span>';
                        // echo Html::dropDownList(Sanpham::sp_status, Aabc::$app->request->get(Sanpham::sp_status) != NULL ? Aabc::$app->request->get(Sanpham::sp_status) : ['' => Aabc::$app->MyConst->vindex_search_chon], ['' => Aabc::$app->MyConst->vindex_search_chon, 1 => Aabc::$app->MyConst->model_table1_item_hienthi, 2 =>  Aabc::$app->MyConst->model_table1_item_an], [                
                        //     'multiple'=>'multiple',
                        //     Aabc::$app->d->i =>  Aabc::$app->_model->__sanpham,
                        //     Aabc::$app->d->ty => 'ra',
                        //     Aabc::$app->d->c => 'one',
                        //     Aabc::$app->d->s => 'rel',
                        //     'class' => 'mulr',
                        //     'id' => Aabc::$app->_model->__sanpham.'_status_select'
                        // ]);

                    ?>
                 </p>

                 <?php } ?>


               
                 <p> 
                <?php    
                    // echo '<span>Chuyên mục</span>';
                    //  $_Danhmuc = Aabc::$app->_model->Danhmuc;
                    //  $th = $_Danhmuc::getAll1_2();   

                    // echo Html::dropDownList(Aabc::$app->_danhmuc->dm_id.'_cm', Aabc::$app->request->get(Aabc::$app->_danhmuc->dm_id.'_cm') != NULL ? Aabc::$app->request->get(Aabc::$app->_danhmuc->dm_id.'_cm') : ['' => Aabc::$app->MyConst->vindex_search_chon], ArrayHelper::map($th, 'dm_id', 'dm_ten'), [
                    //     // 'class' => 'btn btn-default',
                    //     'multiple'=>'multiple',
                    //     Aabc::$app->d->ty => 'checkbox',
                    //     Aabc::$app->d->i => Aabc::$app->_model->__sanpham,
                    //     Aabc::$app->d->s => 'rel',
                    //     'class' => 'mulr',
                    //     'id' => Aabc::$app->_model->__sanpham.'_chuyenmuc_select'
                    // ]);
                ?>
                </p> 

                



                </div>
            </fieldset>  
            <!-- <div class="bhelp">
                <button class="btn btn-default bhelp" <?php //echo Aabc::$app->d->st?>="1" <?php //echo Aabc::$app->d->gr?>="1">Hướng dẫn sử dụng</button>
            </div> -->
        </div>

        
       
    </div>




    <div class="content-right  col-md-10">
        <div class="content-right-top">            
        <?php      
             
              $demthungrac = count(Sanpham::getAllRecycle1_2());                                
                // echo  '<button type="button" '.($demthungrac > 0 ? : 'disabled').' '. D::i .'="sanpham" class="btn btn-danger mb" '.D::u.'="indexrecycle"><span class="glyphicon glyphicon-trash mtrang"></span>'.Aabc::$app->MyConst->view_btn_thungrac.' ('.$demthungrac.')</button>';  

                echo '<button '.D::m.' = "2" type="button"  '.($demthungrac > 0 ? : 'disabled').'  id="mb'. Sanpham::tt.'r" '.D::u.'="ir_b" class="btn btn-danger mb" '.D::i.'= '. Sanpham::tt .'><span class="glyphicon glyphicon-trash mden"></span>'.Aabc::$app->MyConst->view_btn_thungrac.' ('.$demthungrac.')</button>';
        
        

             echo '<button type="button" '.D::m.' = "" id="mb'. Sanpham::tt.'"  '.D::u .'="c_b" class="btn btn-success mb"   '. D::i.'='. Sanpham::tt.'><span class="glyphicon glyphicon-plus mtrang"></span>Viết bài mới</button>';

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
                
                'headerOptions' => ['width' => '500px'], 
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

             




            //     'sp_view',
            //     'sp_ngaytao',
            //     'sp_ngayupdate',
            //     'sp_idnguoitao',
            //     'sp_idnguoiupdate',

                    // Sanpham::sp_id_ncc,
                    //   [                
                    //     'attribute' => Sanpham::sp_id_ncc,
                    //     // 'attribute' => Aabc::$app->_thuonghieu->thuonghieu_ten,
                    //     // 'headerOptions' => ['width' => '200'],              
                    //     'format' => 'raw',               
                    //     'value' => 'spIdNcc.'.Aabc::$app->_nhacungcap->ncc_ten,

                    // ],



                    // 'sp_id_thuonghieu',
                    //  [                
                    //     'attribute' => Sanpham::sp_id_thuonghieu,
                    //     // 'attribute' => Aabc::$app->_thuonghieu->thuonghieu_ten,
                    //     // 'headerOptions' => ['width' => '200'],              
                    //     'format' => 'raw',               
                    //     'value' => 'spIdThuonghieu.'.Aabc::$app->_thuonghieu->thuonghieu_ten,

                    // ],
                    

                    //  [                
                    //     'attribute' => 'spIdNhomsanpham.nsp_tennhom',   
                    //     // 'headerOptions' => ['width' => '200'],              
                    //     'format' => 'raw',               
                    //     'value' => 'spIdNhomsanpham.nsp_tennhom',

                    // ],

                     [                
                        'header' => 'Chuyên mục',  
                        // 'headerOptions' => ['width' => '500px'], 
                        // 'visible' => Aabc::$app->user->can('web'),            
                        'format' => 'raw',
                        'filterInputOptions' => [
                            'class' => 'form-control',                    
                         ],  
                        'value' => function ($model) { 
                            $_Danhmuc = Aabc::$app->_model->Danhmuc;

                            $danhmuc = $model->getDanhmucList($_Danhmuc::BAIVIET);

                            $return = '';
                            foreach ($danhmuc as $key => $value) {
                                if($return) $return = $return . ', ';
                                $return = $return . $value[Aabc::$app->_danhmuc->dm_ten];
                            }
                            return Html::encode($return);
                        }, 
                    ],



                    [                
                        'header' => 'Danh mục sản phẩm',  
                        // 'headerOptions' => ['width' => '500px'], 
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





                    // 'sp_gia',
                    // 'sp_giakhuyenmai',
                    // Sanpham::sp_soluong,
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
                'headerOptions' => ['width' => '100'], 
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
                        'label' => 'Ngày tạo',
                        'headerOptions' => ['width' => '160'], 
                        'attribute' => Sanpham::sp_ngaytao,  
                        // 'visible' => Aabc::$app->user->can('web'),            
                        'format' => 'raw',
                        'filterInputOptions' => [
                            'class' => 'form-control',                    
                         ],
                        'value' => function ($model) {  
                            // return date("d-m-Y", strtotime($model[Sanpham::sp_ngaytao]));                        
                            return '<div class="text-center">' .date("H:i d-m-Y ", strtotime($model[Sanpham::sp_ngaytao])). '</div>';

                        }, 

                    ],


            // [                
            //     'attribute' => Sanpham::sp_conhang, 
            //     // 'headerOptions' => ['width' => '100'],  
            //      // 'header' => 'sp_conhang'
            //     // 'contentOptions' => ['class' => 'text-center'],

            //     // 'headerOptions' => ['width' => '200'],              
            //     'format' => 'raw',
            //     'filterInputOptions' => [
            //         'class'       => 'form-control',                    
            //      ],
            //     'value' => function ($model) {                          
            //         if($model[Sanpham::sp_conhang] == 1){
            //             return '<div class="text-center bg-success">'. Aabc::$app->MyConst->model_table1_item_conhang.'</div>';
            //         }elseif($model[Sanpham::sp_conhang] == 2){
            //             return '<div class="text-center bg-danger">'. Aabc::$app->MyConst->model_table1_item_tamhet.'</div>';
            //         }else{
            //             return '<div class="text-center bg-default">'. Aabc::$app->MyConst->model_table1_item_ngungkinhdoanh.'</div>';
            //         }

            //     }, 

            // ],





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
                    return '<div>'.$model[Sanpham::sp_ma].'</div><div class="omc" id="'.Aabc::$app->_model->__sanpham.$model[Sanpham::sp_id].'"><div class="omd">

                    <button '.D::i.'="'. Sanpham::tt.'" class="mb btn btn-default" '.D::u.'="u_b?id='.$model[Sanpham::sp_id].'">'.Aabc::$app->MyConst->gridview_menu_suachitiet.'<span class="glyphicon glyphicon-pencil"></span></button>
                    
                    <div class="gn"></div>

                    <button type="button" class="clk btn btn-default" '.Aabc::$app->d->lk.'="'.Url::to('' .$model[Sanpham::sp_linkseo] . '-'.D::url_bv . $model[Sanpham::sp_id].'.html' , true).'">'.Aabc::$app->MyConst->gridview_menu_copyduongdan.'<span class="glyphicon glyphicon-link"></span></button>

                     <div class="gn"></div>

                    '.  
                        (Aabc::$app->user->can('web') ? ($model[Sanpham::sp_status] == 2 ? '<button '.D::i.'="'. Sanpham::tt.'" class="ml btn btn-default" '.D::u.'="ut_b?id='.$model[Sanpham::sp_id].'">'.Aabc::$app->MyConst->gridview_menu_hienthi.'<span class="glyphicon glyphicon-eye-open"></span></button>' : '<button '.D::i.'="'. Sanpham::tt.'" class="ml btn btn-default" '.D::u.'="ut_b?id='.$model[Sanpham::sp_id].'">'.Aabc::$app->MyConst->gridview_menu_an.'<span class="glyphicon glyphicon-eye-open"></span></button>') : "" )
                    .'
                    <button '.D::i.'="'. Sanpham::tt.'" class="br btn btn-default" '.D::u.'="rec_b?id='.$model[Sanpham::sp_id].'">'.Aabc::$app->MyConst->gridview_menu_thungrac.'<span class="glyphicon glyphicon-trash"></span></button>

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
Html::dropDownList('t', Aabc::$app->request->get('t') != NULL ? Aabc::$app->request->get('t') : [10 => 10], [10 => 10, 20 => 20, 50 => 50, 100 => 100, 200 => 200], [    
    'class' => 'ipage btn btn-default',
    'id' => ''
])?>

</div>
<div class="sy0"></div>

<div class='cas'>

     <select id="sel<?=  Sanpham::tt?>" class="btn btn-default">
        <option value="" selected=""><?=Aabc::$app->MyConst->gridview_selectmultiitem_chonthaotac?></option>
                
        <option value="22" <?= D::m?>="3" <?=Aabc::$app->d->u?>=<?= Sanpham::thaydoidanhmuc?> <?= D::i?>=<?=Sanpham::tt ?> method='POST' >Thay đổi Danh mục sản phẩm</option>

        <option value="21" <?= D::m?>="3" <?=Aabc::$app->d->u?>=<?= Sanpham::thaydoichuyenmuc?> <?= D::i?>=<?=Sanpham::tt ?> method='POST' >Thay đổi Chuyên mục</option>

    

        <?php if(Aabc::$app->user->can('web')){ ?>
        <option value="1"><?=Aabc::$app->MyConst->gridview_selectmultiitem_an?></option>
        <option value="2"><?=Aabc::$app->MyConst->gridview_selectmultiitem_hienthi?></option>
        <?php }?>
        <option value="3"><?=Aabc::$app->MyConst->gridview_selectmultiitem_thungrac?></option>        
    </select>

    <?= Html::button(Aabc::$app->MyConst->gridview_selectmultiitem_thuchien, [D::u =>'reca_b','class'=>'bra btn btn-default', D::i =>  Sanpham::tt, 'method' => 'POST']) ?>
</div>
</div>


</div>


   
<?php //Pjax::end(); ?>
</div>

</div>

