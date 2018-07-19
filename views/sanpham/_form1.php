<?php

use backend\models\Sanpham;


use aabc\helpers\Html;
use aabc\widgets\ActiveForm;
use backend\models\Sanphamngonngu;
use backend\models\Ngonngu;
use backend\models\Thuonghieu;

use aabc\bootstrap\Modal; /*Them*/
use aabc\helpers\ArrayHelper;

$_Chinhsach  = Aabc::$app->_model->Chinhsach;
$_Danhmuc  = Aabc::$app->_model->Danhmuc;
$_Image = Aabc::$app->_model->Image;

if(empty($html_ts)) $html_ts = '';

$new = new Sanphamngonngu();
?>
<script src="/ad/js/sortable.js"></script>
<script src="../ckeditor/ckeditor.js"></script>
<!-- <script src="./tt2/admin.js"></script>
<script src="./tt2/report-vendor.js"></script>
 -->

<script type="text/javascript">    
$.fn.modal.Constructor.prototype.enforceFocus = function() {
  modal_this = this
  $(document).on('focusin.modal', function (e) {
    if (modal_this.$element[0] !== e.target && !modal_this.$element.has(e.target).length 
    && !$(e.target.parentNode).hasClass('cke_dialog_ui_input_select') 
    && !$(e.target.parentNode).hasClass('cke_dialog_ui_input_text')) {
      modal_this.$element.focus()
    }
  })
};
</script>



<div class="<?=Sanpham::tt?>-form">
 <?php $form = ActiveForm::begin(   
    [
        'id' => Sanpham::tt.'-form',
        // 'enableClientValidation' => false,
        // 'enableAjaxValidation' => false,
        // 'validationUrl' => ['validate'],
        // 'validateOnBlur' => false,
        // 'validateOnChange' => false
        //'enableAjaxValidation' => true,
    ]
    );
?>
  
  <script type="text/javascript">
      $('[data-toggle="tooltip"]').tooltip();
  </script>

<div>
<div class="row"> 
    
    <div  id="spnoidung" class="tab-pane col-md-12 float-left">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#home">Thông tin cơ bản</a></li>            
            <li><a data-toggle="tab" href="#tab_anh">Ảnh sản phẩm</a></li>
            <li><a data-toggle="tab" href="#tab_thongso">Thông số sản phẩm</a></li>
            <li><a data-toggle="tab" href="#tab2">Nội dung chi tiết</a></li>
            <li><a data-toggle="tab" href="#thongso">Thông số kỹ thuật</a></li>
            <li><a data-toggle="tab" href="#tab_seo">Tùy chỉnh SEO</a></li>
            <li><a data-toggle="tab" href="#tab_khuyenmai">Khuyến mại</a></li>
        </ul>

        <div class="tab-content">
            <div id="home" class="tab-pane fade in active ">
                <fieldset class="ht htweb"> <!-- htsp-->
                    
                    <div class="col-md-5" style="/*border-left: 1px solid #ddd;*/">

                        
                                       
                            
                        <div class="col-md-12 col-sm-6 col-xs-12 pt100" style="height: 250px">
                            
                            <div id="imgcove">
                                <div <?= Aabc::$app->d->m ?>="2" id="mb <?= Sanpham::tt?>"  <?= Aabc::$app->d->u?> ="ga?i=icon" class="mb"   <?= Aabc::$app->d->i?> = <?= Aabc::$app->_model->__image ?> ></div>
                                <div class="image">
                                    <h3 style="margin: 80px 0 0 0;color: #ccc;">Chọn ảnh đại diện</h3>
                                </div>
                            </div>

                                <!-- class="imgcove" -->
                            <ul id="editable" class="hide"> 
                                <?php
                                    if(isset($model[Sanpham::sp_images])){
                                        $listimg = explode("-",$model[Sanpham::sp_images]);
                                        foreach ($listimg as $key => $value) {
                                            if($key == 0){
                                                $img = $_Image::find()->andWhere([Aabc::$app->_image->image_id => $value])->one();
                                                
                                                if(isset($img)){
                                                    echo '<li><input type="hidden" name="'.Aabc::$app->d->postimg.'[]" value="'.$value.'" /><img src="/thumb/75/75/'.$img[Aabc::$app->_image->image_tenfile]. '-' . $img[Aabc::$app->_image->image_id]. $img[Aabc::$app->_image->image_morong].'"><i class="js-remove">✖</i></li>';
                                                }                                            
                                                ?>
                                                <script type="text/javascript">
                                                $('#imgcove>.image').html("<img src=/uploads/<?= ($img[Aabc::$app->_image->image_tenfile]. '-' . $img[Aabc::$app->_image->image_id]. $img[Aabc::$app->_image->image_morong])?> >");
                                                </script>
                                                <?php
                                            }
                                        }                    
                                    }
                                ?>           
                            </ul>
                            <div class="selected-product-image one"><input /></div>                       
                        </div>

                                   
                        
<!-- 
                            <div class="col-md-12 col-sm-6  col-xs-12 pt160">
                                <?php     
                                    
                                    // echo $form->field($model, Sanpham::sp_id_danhmuc,['options' => ['class' => '']])->dropDownList($_Danhmuc::getDanhmucOption($_Danhmuc::TINHNANG),[
                                            
                                    //         'multiple'=>'multiple',
                                    //         Aabc::$app->d->ty => 'checkbox',
                                    //          //Aabc::$app->d->ty => 'ra',
                                    //         // Aabc::$app->d->c => 'one',
                                    //         Aabc::$app->d->add => 'ip_tn',
                                    //         // d-add chỉ cần cho d-u, còn d-i của url sẽ được lấy ở fk- bên dưới

                                    //         Aabc::$app->d->i => Sanpham::tt,
                                    //         Aabc::$app->d->t => 'sea',//Search
                                    //         'class' => 'mulr',                        
                                    //         // 'id' => Sanpham::tt.'-sp_id_thuonghieu'
                                    //         'id' => 'fk-'.Aabc::$app->_model->__danhmuc.'-tn'
                                    //     ])->label('Thông số kỹ thuật'); 
                                ?>
                                 <i class="hdtip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="- Các thông số kỹ thuật, tính năng của sản phẩm." aria-invalid="false"></i>
                            </div>
 -->

<!-- 


                            <div class="col-md-12 col-sm-6  col-xs-12 pt160">
                                <?php     
                                   
                                    
                                    // echo $form->field($model, Sanpham::sp_id_danhmuc,['options' => ['class' => '']])->dropDownList($_Danhmuc::getDanhmucOption($_Danhmuc::NOIBAT),[                                    
                                    //         'multiple'=>'multiple',
                                    //         Aabc::$app->d->ty => 'checkbox',
                                    //         // Aabc::$app->d->ty => 'ra',
                                    //         // Aabc::$app->d->c => 'one',
                                    //          Aabc::$app->d->t => 'show',
                                    //         //Aabc::$app->d->add => 'ip_dm',
                                    //         // d-add chỉ cần cho d-u, còn d-i của url sẽ được lấy ở fk- bên dưới
                                    //         Aabc::$app->d->i => Sanpham::tt,
                                    //         Aabc::$app->d->t => 'sea',//Search
                                    //         'class' => 'mulr',                        
                                    //         // 'id' => Sanpham::tt.'-sp_id_thuonghieu'
                                    //         'id' => 'fk-'.Aabc::$app->_model->__danhmuc.'-dm'
                                    //     ])->label('Hiển thị nổi bật');
         
                                ?>
                                <i class="hdtip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="- Danh sách nổi bật hiển thị ngoài trang người dùng.<br/>- Sản phẩm có thể thuộc một hoặc nhiều danh sách." aria-invalid="false"></i>
                            </div>
                            -->


<!-- 
                             <div class="col-md-12 col-sm-6  col-xs-12 pt160">

                                <?php  
                                    // echo $form->field($model, Sanpham::sp_id_chinhsach,['options' => ['class' => '']])->dropDownList($_Chinhsach::getOption($_Chinhsach::KHUYENMAI),[
                                            
                                    //         'multiple'=>'multiple',
                                    //         Aabc::$app->d->ty => 'checkbox',
                                            
                                    //         // Aabc::$app->d->ty => 'ra',
                                    //         // Aabc::$app->d->c => 'one',
                                    //         // Aabc::$app->d->add => 'ip',
                                    //         // d-add chỉ cần cho d-u, còn d-i của url sẽ được lấy ở fk- bên dưới

                                    //         Aabc::$app->d->i => Sanpham::tt,
                                    //         Aabc::$app->d->t => 'sea',//Search
                                    //         'class' => 'mulr',                        
                                    //         // 'id' => Sanpham::tt.'-sp_id_thuonghieu'
                                    //         'id' => 'fk-'.Aabc::$app->_model->__chinhsach.'-km'
                                    //     ])->label('Khuyến mại tặng kèm'); 
                                ?>
                                <i class="hdtip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="- Các Chương trình khuyến mại tặng kèm khi khách hàng mua sản phẩm này.<br/>- Một sản phẩm có thể có cùng lúc nhiều chương trình khuyến mại khác nhau.<br/>- Các chương trình áp dụng cho <b>Tất cả sản phẩm</b> và <b>Danh mục sản phẩm</b> sẽ được ghim lên trên và được chọn tự động." aria-invalid="false"></i>
                            </div> -->




<!-- 
                             <div class="col-md-12 col-sm-6  col-xs-12 pt160">

                                <?php  
                                    // echo $form->field($model, Sanpham::sp_id_chinhsach,['options' => ['class' => '']])->dropDownList($_Chinhsach::getOption($_Chinhsach::BAOHANH),[
                                            
                                    //         'multiple'=>'multiple',
                                    //         Aabc::$app->d->ty => 'checkbox',
                                            
                                    //         // Aabc::$app->d->ty => 'ra',
                                    //         // Aabc::$app->d->c => 'one',
                                    //         // Aabc::$app->d->add => 'ip',
                                    //         // d-add chỉ cần cho d-u, còn d-i của url sẽ được lấy ở fk- bên dưới

                                    //         Aabc::$app->d->i => Sanpham::tt,
                                    //         Aabc::$app->d->t => 'sea',//Search
                                    //         'class' => 'mulr',                        
                                    //         // 'id' => Sanpham::tt.'-sp_id_thuonghieu'
                                    //         'id' => 'fk-'.Aabc::$app->_model->__chinhsach.'-bh'
                                    //     ])->label('Chính sách bảo hành'); 
                                ?>
                                <i class="hdtip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="- Các Chương trình Bảo hành khi khách hàng mua sản phẩm này.<br/>- Một sản phẩm có thể có cùng lúc nhiều chương trình Bảo hành khác nhau.<br/>- Các chương trình áp dụng cho <b>Tất cả sản phẩm</b> và <b>Danh mục sản phẩm</b> sẽ được ghim lên trên và được chọn tự động." aria-invalid="false"></i>
                            </div> -->
                


<!-- 
                            <div class="col-md-12 col-sm-6  col-xs-12 pt160">

                                <?php     
                                    
                                    // echo $form->field($model, Sanpham::sp_id_chinhsach,['options' => ['class' => '']])->dropDownList($_Chinhsach::getOption($_Chinhsach::GIAOHANG),[
                                            
                                    //         'multiple'=>'multiple',
                                    //         Aabc::$app->d->ty => 'checkbox',
                                            
                                    //         // Aabc::$app->d->ty => 'ra',
                                    //         // Aabc::$app->d->c => 'one',
                                    //         // Aabc::$app->d->add => 'ip',
                                    //         // d-add chỉ cần cho d-u, còn d-i của url sẽ được lấy ở fk- bên dưới

                                    //         Aabc::$app->d->i => Sanpham::tt,
                                    //         Aabc::$app->d->t => 'sea',//Search
                                    //         'class' => 'mulr',                        
                                    //         // 'id' => Sanpham::tt.'-sp_id_thuonghieu'
                                    //         'id' => 'fk-'.Aabc::$app->_model->__chinhsach.'-gh'
                                    //     ])->label('Chính sách giao hàng'); 
                                ?>
                                <i class="hdtip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="- Các Chương trình Giao hàng khi khách hàng mua sản phẩm này.<br/>- Một sản phẩm chỉ nên để 1 chính sách Giao hàng.<br/>- Các chương trình áp dụng cho <b>Tất cả sản phẩm</b> và <b>Danh mục sản phẩm</b> sẽ được ghim lên trên và được chọn tự động." aria-invalid="false"></i>
                            </div> -->
                




                    </div>
                   


                    <div class="col-md-7">

                        <div class="col-md-12 col-sm-6 col-xs-12 pt100">
                            <?php                         

                                $keys = [
                                    Sanphamngonngu::spnn_idsanpham,
                                    Sanphamngonngu::spnn_idngonngu,
                                ]; 

                                $thuoctinhs = [
                                    Sanphamngonngu::spnn_ten,
                                    Sanphamngonngu::spnn_gioithieu,
                                    // Sanphamngonngu::spnn_tieudeseo, 
                                    // Sanphamngonngu::spnn_motaseo,             
                                ]; 
    
                                $new = Sanphamngonngu::M;
                               
                                 Aabc::$app->MyComponent->dangonngu($data,$form,$keys,$thuoctinhs,$model[Sanpham::sp_id],$new,'tsp','');
                            ?>
                        </div>


                        <div class="col-md-6 col-sm-6  col-xs-12 pt120">   
                            <?php        
                                echo $form->field($model, Sanpham::sp_gia,['options' => ['class' => 'giakm']])->textInput(['maxlength' => true,'class' => 'form-control', 'placeholder' => ''])->label('Giá bán');        
                            ?>
                            <i class="hdtip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="bottom" data-html="true" data-toggle="tooltip" data-original-title="- Giá bán hiển thị với người dùng.<br/>- Sẽ được sử dụng trong hóa đơn.<br/>- Bắt buộc bạn phải điền." aria-invalid="false"></i>
                        </div>


                        <div class="col-md-6 col-sm-6  col-xs-12 pt120">
                            <?php //class: nbr la chi nhan so ?>
                          <?= $form->field($model, Sanpham::sp_giakhuyenmai,['options' => ['class' => 'giany']])->textInput(['maxlength' => true,'class' => ' form-control'])->label('Giá niêm yết') ?>
                            <i class="hdtip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="bottom" data-html="true" data-toggle="tooltip" data-original-title="- Giá này khi hiện thị sẽ bị gạch ngang, chỉ có tác dụng so sánh với giá Bán và không sử dụng trong đơn hàng.<br/>- Bạn có thể điền giá hoặc để trống." aria-invalid="false"></i>
                        </div>


                        <!-- <div class="col-md-6 col-sm-6  col-xs-12 pt120">
                            <?php // $form->field($model, Sanpham::sp_masp,['options' => ['class' => ''],'enableClientValidation' => true])->textInput(['maxlength' => true,'class' => 'uppercase form-control']) ?>
                            <?php //echo $form->field($model, Sanpham::sp_masp,['options' => ['class' => ''],'enableClientValidation' => true,'enableAjaxValidation' => true])->textInput(['maxlength' => true,'class' => 'uppercase form-control']) ?>


                            <i class="hdtip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="- Mã số, mã vạch của sản phẩm." aria-invalid="false"></i>
                        </div> -->


                        <div class="xd"></div>

                        <div class="col-md-6 col-sm-6  col-xs-12 pt120">
                            <?php                  
                                if($model[Sanpham::sp_conhang] == NULL) $model[Sanpham::sp_conhang] = '1';
                                echo $form->field($model, Sanpham::sp_conhang,['options' => ['class' => '']])->dropDownList( Sanpham::getConhangOptionColor(),[
                                        //'multiple'=>'multiple', 
                                        // Aabc::$app->d->s => 'search',
                                        Aabc::$app->d->t => 'show', 
                                        Aabc::$app->d->ty => 'ra',
                                        Aabc::$app->d->i => Sanpham::tt,
                                        'class' => 'mulr',      
                                        Aabc::$app->d->c => 'one',                        
                                         'id' => Sanpham::tt.'_sp_conhang_select'
                                    ]); 
                                ?>
                            <i class="hdtip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="- Tình trạng hoạt động kinh doanh của sản phẩm." aria-invalid="false"></i>
                        </div>  

                                               
                        <div class="col-md-6 col-sm-6  col-xs-12 pt120">
                            <?php  
                                echo $form->field($model, Sanpham::sp_noibat,['options' => ['class' => '']])->dropDownList($_Danhmuc::getNoibatOption(),[
                                    'multiple'=>'multiple', 
                                    Aabc::$app->d->t => 'sea',//Search
                                    // Aabc::$app->d->t => 'show', 
                                    Aabc::$app->d->ty => 'checkbox',                    
                                    Aabc::$app->d->i => Sanpham::tt,
                                    'class' => 'mulr',      
                                    // Aabc::$app->d->c => 'one',                        
                                    'id' => 'fk-'.Aabc::$app->_model->__danhmuc.'-noibat',
                                ])->label('Nổi bật'); 


                            ?>
                            <i class="hdtip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="- Sản phẩm này sẽ hiển thị ra trang chủ tại các mục được chọn." aria-invalid="false"></i>
                        </div>

                         <div class="col-md-6 col-sm-6 col-xs-12 pt120">  
                            <?php   
                            if($model[Sanpham::sp_status] == NULL) $model[Sanpham::sp_status] = '1';                       
                            echo $form->field($model, Sanpham::sp_status,['options' => ['class' => '']])->dropDownList(Sanpham::getTrangthaiOptionColor(),[
                                    //'multiple'=>'multiple', 
                                    // Aabc::$app->d->s => 'search',  
                                    Aabc::$app->d->t => 'show',
                                    Aabc::$app->d->ty => 'ra',
                                    Aabc::$app->d->i => Sanpham::tt,
                                    'class' => 'mulr',      
                                    Aabc::$app->d->c => 'one',                        
                                    'id' => Sanpham::tt.'_sp_status2_select'
                                ]); 

                            //  if($model[Sanpham::sp_status] == NULL) $model[Sanpham::sp_status] = '1';                       
                            // echo $form->field($model, Sanpham::sp_status,['options' => ['class' => '']])->dropDownList(['' => '--Chọn--','1'=>'Hiển thị','2'=>'Ẩn'],[
                            //         'data-placement' => 'top' ,'data-trigger' => 'focus','data-html' => 'true', 'data-toggle' => 'tooltip','title' => 'Tùy chọn Hiển thị bài viết trên website.',
                            //         //'multiple'=>'multiple', 
                            //         // Aabc::$app->d->s => 'search',  
                            //         Aabc::$app->d->ty => 'ra',
                            //         Aabc::$app->d->i => Sanpham::tt,
                            //         'class' => 'mulr',      
                            //         Aabc::$app->d->c => 'one',                        
                            //         'id' => Sanpham::tt.'_sp_status2_select'
                            //     ]); 
                          
                            ?>
                            <i class="hdtip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="- Tùy chọn Hiển thị bài viết trên website." aria-invalid="false"></i>
                        </div> 


                    </div> 

                    





                </fieldset>
            </div>


<div id="tab_thongso" class="tab-pane fade ">  
    <fieldset class="ht htsp">             
        <div class="col-md-6 col-sm-6  col-xs-12 pt160">
            <?php    
                //Tim List Chinh sach ap dung rieng cho Danh muc nay , gan ListChinhSach vao ten Danh muc,  
                $danhmuc = $_Danhmuc::getAll1_1();
                foreach ($danhmuc as $keydm => $valuedm) {
                    $listcs = $valuedm->getChinhsachList();                                       
                    $listcs_html = '';
                    foreach ($listcs as $keydmcs => $valuedmcs) {
                        $listcs_html .= '#@' . $valuedmcs[Aabc::$app->_chinhsach->cs_id];
                    }
                    $danhmuc[$keydm][Aabc::$app->_danhmuc->dm_char] = $danhmuc[$keydm][Aabc::$app->_danhmuc->dm_char] . $listcs_html;
                } 

                $danhmuc = ['' => '---Chọn---'] + ArrayHelper::map($danhmuc,Aabc::$app->_danhmuc->dm_id,Aabc::$app->_danhmuc->dm_char);                        

                // echo $form->field($model, Sanpham::sp_id_danhmuc,['options' => ['class' => '']])->dropDownList($danhmuc,[
                //         'multiple'=>'multiple',
                //         Aabc::$app->d->ty => 'checkbox',
                //         // Aabc::$app->d->ty => 'ra',
                //         // Aabc::$app->d->c => 'one',
                //         Aabc::$app->d->add => 'ip',
                //         // d-add chỉ cần cho d-u, còn d-i của url sẽ được lấy ở fk- bên dưới
                //         Aabc::$app->d->i => Sanpham::tt,
                //         Aabc::$app->d->t => 'sea',//Search
                //         'class' => 'mulr',                        
                //         // 'id' => Sanpham::tt.'-sp_id_thuonghieu'
                //         'id' => 'fk-'.Aabc::$app->_model->__danhmuc
                //     ])->label(Sanpham::__sp_id_danhmuc .' sản phẩm'); 


                echo $form->field($model, Sanpham::sp_id_danhmuc,['options' => ['class' => '']])->dropDownList($danhmuc,[
                    //'multiple'=>'multiple', 
                    Aabc::$app->d->t => 'sea',//Search
                    // Aabc::$app->d->t => 'show', 
                    Aabc::$app->d->ty => 'ra',                    
                    Aabc::$app->d->i => Sanpham::tt,
                    'class' => 'mulr',      
                    Aabc::$app->d->c => 'one',                        
                    'id' => 'fk-'.Aabc::$app->_model->__danhmuc
                ])->label('Danh mục sản phẩm'); 

            ?>
            
        </div>
        
        <div class="clearfix"></div>
        <div id="select_ts">
            <?= $html_ts ?>
        </div>

        <style type="text/css">
            #select_ts h4 {
                color: #0c7fb3;
                border-bottom: 1px solid;
                margin-right: 60px;
                font-weight: bold;
            }
            #select_ts label {
                width: 100%;
                padding: 5px 5px 5px 20px;
                position: relative;
                cursor: pointer;
            }

            #select_ts label input {
                position: absolute;
                top: 3px;
                left: 0;
            }
            #select_ts div>span{
                position: absolute;
                right: 65px;
                top: 10px;
                color: #aaa;
                cursor: pointer;
            }
            #select_ts div>span:hover{                
                color: #ff7f00;
            }
            #select_ts .col-md-3 {
                margin: 0 0 20px 0;
            }
        </style>

        <script type="text/javascript">
            $('#fk-danhmuc-pa').change(function(){
                var id = $(this).find('input[name="Sanpham_235[<?= Sanpham::sp_id_danhmuc;?>]"]:checked').val()
                $.ajax({
                    cache: false,
                    url: "<?= Sanpham::tt.'/'.Sanpham::action_thongso  ?>",
                    type: 'POST',  
                    data: {
                        dm: id,
                    },                          
                    success: function (data) {                         
                        $('#select_ts').html(data.html)
                    },
                    error: function () {                        
                        poploi();
                    }                
                });
            })
        </script>
            
        <?php 

            // echo '<pre>';
            // print_r($model[Sanpham::sp_id_danhmuc]);
            // echo '</pre>';

        ?>

    </fieldset>
</div> 

<style type="text/css">
    .del-album{
        height: 30px;
        line-height: 23px;
        cursor: pointer;
    }
    .l-album {
        border-bottom: 1px solid #eee;
        margin: 0 0 10px 0;
    }
    .add-album{
        height: 30px;
        line-height: 23px;
        cursor: pointer;   
    }
    
</style>

<div id="tab_anh" class="tab-pane fade clearfix" style="padding: 10px 0;">    
    <div class="list-album">
        <?php 
            if(!empty($model[Sanpham::sp_album])) $model[Sanpham::sp_album] = json_decode($model[Sanpham::sp_album], true);
            foreach ($model[Sanpham::sp_album] as $key => $album) {
                echo Aabc::$app->controller->renderPartial('add-album',[
                    'album' => $album,
                    'random' => $key,
                ]);                
            }
        ?>        
    </div>
    
    <div class="col-md-12 clearfix">
        <span class="btn btn-default add-album" <?= Aabc::$app->d->u .'='. Sanpham::addalbum ?>  <?= Aabc::$app->d->i.'='.Sanpham::tt ?> ><span class="glyphicon text-success glyphicon-plus"></span> Thêm album</span>
    </div>
</div>



    <div id="thongso" class="tab-pane fade clearfix">  
        <fieldset class="ht htsp"> 

            <div id="noidung" class="tab-pane col-md-12 float-right">     
                <?php              
                    $ngonngu = null;

                    $ids = [            
                        Sanphamngonngu::spnn_idsanpham, 
                        Sanphamngonngu::spnn_idngonngu, 
                        Sanphamngonngu::t,//Chi co trong Text
                    ];
                    $thuoctinh = [
                        Sanphamngonngu::spnn_noidungbosung,
                        Sanphamngonngu::spnn_noidungbosung_2,                                
                    ]; 

                    $new = Sanphamngonngu::M;

                    Aabc::$app->MyComponent->dangonngutext($data,$form,$ids,$thuoctinh,$model[Sanpham::sp_id],$new,'tabthongso');  
              
                 ?>
            </div>  

        </fieldset>
    </div> 



    <div id="tab2" class="tab-pane fade ">  
        <fieldset class="ht htsp"> 

        <div id="noidung" class="tab-pane col-md-12 float-right">     
            <?php              
                $ngonngu = null;

                $ids = [            
                    Sanphamngonngu::spnn_idsanpham, 
                    Sanphamngonngu::spnn_idngonngu, 
                    Sanphamngonngu::t,//Chi co trong Text
                ];
                $thuoctinh = [
                    Sanphamngonngu::spnn_noidung,
                ]; 

                $new = Sanphamngonngu::M;

                Aabc::$app->MyComponent->dangonngutext($data,$form,$ids,$thuoctinh,$model[Sanpham::sp_id],$new,'tabnoidung');  
          
             ?>
        </div>  

        </fieldset>
    </div> 





            <div id="tab_seo" class="tab-pane fade ">  
                <fieldset class="ht htweb">
                <div  class="col-md-12 col-sm-6 col-xs-12">

                    <div class="col-md-12 col-sm-6 col-xs-12 pt100">
                        <?php
                            $keys = [
                                Sanphamngonngu::spnn_idsanpham,
                                Sanphamngonngu::spnn_idngonngu,
                            ];
                            $thuoctinhs = [                                
                                Sanphamngonngu::spnn_tieudeseo, 
                                Sanphamngonngu::spnn_motaseo,             
                            ]; 
                            $new = Sanphamngonngu::M;                           
                            Aabc::$app->MyComponent->dangonngu($data,$form,$keys,$thuoctinhs,$model[Sanpham::sp_id],$new,'tsp_seo','');
                        ?>
                    </div>

                    <!-- <div class="col-md-12"> -->
                        <div class="col-md-12 col-sm-6 col-xs-12 pt120">
                        <?php echo $form->field($model, Sanpham::sp_linkseo ,['options' => ['class' => '']])->textarea(['maxlength' => true ,'placeholder' => 'Đường dẫn bài viết' ,'data-html' => 'true','data-placement' => 'top','data-trigger' => 'focus', 'data-toggle' => 'tooltip', 'title' => 'Đường dẫn bài viết']) ?>
                        </div>
                    <!-- </div> -->


                   <!--  <fieldset class="ht htseo htweb">
                        <legend>Hiển trị trên Google</legend>
                            <div class="col-md-12">
                            <?php // $form->field($model, Html::encode(Sanpham::sp_tensp),['options' => ['encode' => true,'class' => 'form-group']])->textarea(['rows' => '2','placeholder' => 'Tiêu đề bài viết' ,'maxlength' => true,'data-html' => 'true','data-placement' => 'top','data-trigger' => 'focus', 'data-toggle' => 'tooltip', 'title' => 'Tiêu đề bài viết.'])->label(Sanpham::__sp_tensp) ?> 
                            </div>
                            <div class="col-md-12">    
                                <?php //echo $form->field($model, Sanpham::sp_linkseo ,['options' => ['class' => '']])->textarea(['maxlength' => true ,'placeholder' => 'Đường dẫn bài viết' ,'data-html' => 'true','data-placement' => 'top','data-trigger' => 'focus', 'data-toggle' => 'tooltip', 'title' => 'Đường dẫn bài viết']) ?>
                            </div>
                            <div class="col-md-12">    
                                <?php // $form->field($model, Sanpham::sp_motaseo ,['options' => ['class' => 'form-group']])->textarea(['maxlength' => true ,'placeholder' => 'Mô tả seo' ,'data-html' => 'true','data-placement' => 'top','data-trigger' => 'focus', 'data-toggle' => 'tooltip', 'title' => 'Mô tả seo']) ?>
                            </div>
                    </fieldset> -->
                </div>

                </fieldset>
            </div>


            <div id="tab_khuyenmai" class="tab-pane fade ">  
                <fieldset class="ht htsp"> 

                    <div id="noidung" class="tab-pane col-md-12 float-right">     
                        <?php              
                            $ngonngu = null;

                            $ids = [            
                                Sanphamngonngu::spnn_idsanpham, 
                                Sanphamngonngu::spnn_idngonngu, 
                                Sanphamngonngu::t,//Chi co trong Text
                            ];
                            $thuoctinh = [
                                // Sanphamngonngu::spnn_noidungbosung,
                                Sanphamngonngu::spnn_noidungbosung_3,                                
                            ]; 

                            $new = Sanphamngonngu::M;

                            Aabc::$app->MyComponent->dangonngutext($data,$form,$ids,$thuoctinh,$model[Sanpham::sp_id],$new,'tab_khuyenmai');  
                      
                         ?>
                    </div>  

                </fieldset>
            </div> 



            <div class="clearfix"></div>
        </div>
    </div>
    
     



</div>








<div class="form-group right">
    <button <?= Aabc::$app->d->i?> = <?= Sanpham::tt ?> type="submit" class="btn btn-default haserror lvt"><span class="glyphicon glyphicon-floppy-disk mxanh"></span>Lưu và Thêm</button>

    <button type="submit" class="btn btn-default haserror"><span class="glyphicon glyphicon-floppy-disk mxanh"></span>Lưu</button>

    <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-ban-circle mdo"></span>Đóng</button>
</div>

<?php ActiveForm::end(); ?>

</div>





<script type="text/javascript">                
    (function () {
        'use strict';
        var byId = function (id) { return document.getElementById(id); },
            loadScripts = function (desc, callback) {
                var deps = [], key, idx = 0;

                for (key in desc) {
                    deps.push(key);
                }

                (function _next() {
                    var pid,
                        name = deps[idx],
                        script = document.createElement('script');

                    script.type = 'text/javascript';
                    script.src = desc[deps[idx]];

                    pid = setInterval(function () {
                        if (window[name]) {
                            clearTimeout(pid);

                            deps[idx++] = window[name];

                            if (deps[idx]) {
                                _next();
                            } else {
                                callback.apply(null, deps);
                            }
                        }
                    }, 30);

                    document.getElementsByTagName('head')[0].appendChild(script);
                })()
            },

            console = window.console;

        var editableList = Sortable.create(byId('editable'), {
            animation: 150,
            filter: '.js-remove',
            onFilter: function (evt) {
                evt.item.parentNode.removeChild(evt.item);
            }
        }); 
    }
    )();
</script>


<script type="text/javascript">

    // selectmur('sanpham_sp_status2_select');
    // selectmur('sanpham_sp_conhang_select');        
    // selectmur('sanpham-sp_id_nhomsanpham');
    // selectmur('sanpham-sp_id_thuonghieu');


    // $('.sanpham-form .mulr-body input[type=radio]').change(function() {         
    //     changeinputmulr('sanpham',this);
    // });

    //  $('.sanpham-form .mulr-body input[type=text]').on('input',function() { 
    //     changeinputsearch('sanpham',this);
    // });

    // var pj_id_nhomsanpham = 'sanpham-sp_id_nhomsanpham';
 //    $('#'+pj_id_nhomsanpham).change(function () {  
 //        var idselect = $("#"+pj_id_nhomsanpham+" option:selected" ).val();
 //        var textselect = $("#"+pj_id_nhomsanpham+" option:selected" ).text();
        
 //        if(idselect == '' && textselect != ''){
 //         $('#'+pj_id_nhomsanpham+' :nth-child(1)').prop('selected', true);
 //            loadimg();
 //            $.ajax({
 //                cache: false,
 //                url: '<?php //echo Aabc::$app->homeUrl ?>nhomsanpham/create',
 //                data: {
 //                    modal:'modal2', 
 //                    pjid:pj_id_nhomsanpham,                  
 //                },
 //                type: 'POST',                               
 //                success: function (data) {                                      
 //                    $('#modal2').modal('show')
 //                        .find('#modalContent2')
 //                        .html(data);                    
 //                    unloadimg();
 //                },
 //                error: function () {
 //                    poploi();                    
 //                }
 //            });
 //        }
 //    })


    // $('#<?php //Sanpham::tt?>-sp_masp').change(function () {                
    //     var idthis = $(this).attr('id');        
    //     returnparent($(this),'FORM');
    //     var form = parent;  
    //     var formData = form.serialize();

        
    //     var divparent = $(this).parent();  
    //     divparent = $(divparent).parent();  
    //     // console.log(divparent);
    //     $.ajax({
    //         url: form.attr("action"),
    //         type: 'POST',
    //         data: {
    //             check:$(this).val(),
    //         },            
    //         success: function (data) { 
    //             if(data == 'ok'){ 
    //                 $(divparent).find('.ferror').html('');
    //                 $(divparent).removeClass('has-error');  
    //                 $(divparent).addClass('has-success');  
    //                 $('#<?php //Sanpham::tt?>-form button[type="submit"]').attr("disabled", false);
    //             }
    //             if(data == 'tontai'){
    //                 $(divparent).find('.ferror').html('Đã bị trùng');
    //                 $(divparent).removeClass('has-success');  
    //                 $(divparent).addClass('has-error'); 
    //                 $('#<?php //Sanpham::tt?>-form button[type="submit"]').attr("disabled", true);
    //             }
    //         },
    //         error: function () {
    //             poploi();
    //         }
    //     });
    // })


    $('#<?= Sanpham::t?>-<?= Sanpham::sp_tensp?>').on('keyup keypress',function(){
        $('#<?= Sanpham::t?>-<?= Sanpham::sp_linkseo?>').val(urlfriendly($(this).val()));
        // $('#<?=Aabc::$app->_model->__sanphamngonngu?>-0-spnn_ten').val($(this).val());
        // $('#<?=Aabc::$app->_model->__sanphamngonngu?>-0-spnn_tieudeseo').val($(this).val());
    });

    $('#<?= Sanphamngonngu::t?>-0-<?= Sanphamngonngu::spnn_ten?>').on('keyup keypress',function(){
        var text = $(this).val()
        $('#<?= Sanphamngonngu::t?>-0-<?= Sanphamngonngu::spnn_tieudeseo?>').val(text)
        $('#<?= Sanpham::t?>-<?=Sanpham::sp_linkseo?>').val(urlfriendly(text));
        $('#<?= Sanpham::t?>-<?=Sanpham::sp_tensp?>').val(text);

        autoheight('#<?=Sanpham::t?>-<?=Sanpham::sp_linkseo?>');
        autoheight('#<?=Sanpham::t?>-<?=Sanpham::sp_tensp?>');
        // $('#<?=Aabc::$app->_model->__sanphamngonngu?>-0-spnn_tieudeseo').val($(this).val());
    });


    $('#<?= Sanphamngonngu::t?>-0-<?= Sanphamngonngu::spnn_gioithieu?>').on('keyup keypress',function(){
        var text = $(this).val()
        $('#<?= Sanphamngonngu::t?>-0-<?= Sanphamngonngu::spnn_motaseo?>').val(text)
        
    });


    $('#modal #<?=Sanpham::tt?>-form input').on('keyup keypress', function(e){
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13){
            e.preventDefault();
            return false;
        }
    });


    $('#modal #<?=Sanpham::tt?>-form .ht textarea').on('keyup keypress', function(e){
        autoheight(this);
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13){
            e.preventDefault();
            return false;
        }
    });

    $('#modal #<?=Sanpham::tt?>-form .ht textarea').on('mousedown', function(e){
        autoheight(this);       
    });

    setTimeout( function(){ 
        $('#modal #<?=Sanpham::tt?>-form .ht textarea').each(function (){
            autoheight(this);           
        });
     }, 500);
    setTimeout( function(){ 
        $('#modal #<?=Sanpham::tt?>-form .ht textarea').each(function (){
            autoheight(this);
        });
     }, 1500);


$('form#<?=Sanpham::tt?>-form').on('beforeSubmit', function(e) {
    $(this).find('button[type=submit]').attr('disabled','disabled');
    loadimg();
    var form = $(this);
    var formData = form.serialize();
    $.ajax({
        url: form.attr("action"),
        type: form.attr("method"),
        data: formData,
        success: function (data) {
            if(data == 1){  

                <?php 
                    if($model->isNewRecord){
                        // echo 'reload("'.Sanpham::tt.'",updateQueryStringParameter(getdu("'.Sanpham::tt.'").replace(/&amp;/g, "&"),"sort","-'.Sanpham::sp_id.'"));';
                        // index?sort=-sp_id
                        echo 'reload("'.Sanpham::tt.'","'.Sanpham::index_sp.'?sort=-'.Sanpham::sp_id.'");';
                    }else{
                        echo "reload('".Sanpham::tt."');";
                    }
                ?>
                
                popthanhcong('','#modal');

                lvtok('<?=Sanpham::tt?>'); 
            }else{
                // $(this).find('button[type=submit]').addClass('active');
                reload('<?=Sanpham::tt?>');
                popthatbai('');
            }                
        },
        error: function () {
            // $(this).find('button[type=submit]').addClass('active');
            poploi();                
        }
    });
}).on('submit', function(e){
    $(this).find('button[type=submit]').attr('disabled','disabled');
    e.preventDefault();
});

    // setTimeout(function () {
    //     $('.sanpham-update script').remove();
    //     // $('body script').remove();
    // },1000)
</script>



