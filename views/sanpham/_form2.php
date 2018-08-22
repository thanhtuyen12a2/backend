<?php
use backend\models\Sanpham;

use aabc\helpers\Html;
use aabc\widgets\ActiveForm;
use backend\models\Sanphamngonngu;
use backend\models\Ngonngu;
use aabc\bootstrap\Modal; 
use aabc\helpers\ArrayHelper;
use backend\models\Thuonghieu;


$_Sanpham = Aabc::$app->_model->Sanpham;
$_Chinhsach  = Aabc::$app->_model->Chinhsach;
$_Danhmuc  = Aabc::$app->_model->Danhmuc;


$new = new Sanphamngonngu();
?>

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
            <div class="col-md-4">            
            <fieldset style="margin: 10px 0 0 0" class="ht htweb">
            <legend style="background: #2499ce;width: 100%;padding: 5px 10px;margin: 0;color: #FFF;">Thông tin cơ bản</legend>
            


                <div class="col-xs-12">
               

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
                   
                     Aabc::$app->MyComponent->dangonngu($data,$form,$keys,$thuoctinhs,$model[Sanpham::sp_id],$new,'tsp','_2');
                ?>

                </div>

                <div class="clearfix"></div>
                <div>
                    <div class="col-md-3 col-xs-3">
                        <?= '<button style="width: 98px;height: 98px;opacity: 0; z-index: 10;" type="button" '.Aabc::$app->d->m.' = "2" id="mb'.Sanpham::tt.'"  '.Aabc::$app->d->u .'="ga?i=icon" class="btn btn-success mb"   '. Aabc::$app->d->i.'='.Aabc::$app->_model->__image.'><span class="glyphicon glyphicon-plus mtrang"></span>Ảnh</button>'?>
                        <style>
                            ul#editable{
                                width: 98px;
                                border: 2px dashed #c1bfbf;
                            }
                            ul#editable .js-remove{
                                display: none;
                            }
                            ul#editable li{margin: 0;padding: 10px;z-index: 9;}
                            ul#editable img{border: none}
                        </style>
                        <ul id="editable"> 
                            <span style="position: absolute;top: 22px;left: 20px;color: #bbb;width: 70px;text-align: center;">Ảnh đại diện</span>
                            <?php
                                if(isset($model[Sanpham::sp_images])){
                                    $listimg = explode("-",$model[Sanpham::sp_images]);
                                    foreach ($listimg as $key => $value) {
                                        $_Image = Aabc::$app->_model->Image;
                                        $img = $_Image::find()->andWhere([Aabc::$app->_image->image_id => $value])->one();
                                        if(isset($img)){
                                            echo '<li><input type="hidden" name="'.Aabc::$app->d->postimg.'[]" value="'.$value.'" /><img src="/thumb/75/75/'.$img[Aabc::$app->_image->image_tenfile]. '-' . $img[Aabc::$app->_image->image_id]. $img[Aabc::$app->_image->image_morong].'"></li>';
                                        }
                                    }                    
                                }
                            ?>           
                        </ul>
                        <div class="selected-product-image one"><input /></div>

                    </div>



                    <div class="col-md-9 col-xs-9 pt100">  
                        <?php   
                        if($model[Sanpham::sp_status] == NULL) $model[Sanpham::sp_status] = '1';                       
                        echo $form->field($model, Sanpham::sp_status,['options' => ['class' => '']])
                        ->dropDownList(Sanpham::getTrangthaiOptionColor(),[
                                //'multiple'=>'multiple', 
                                // Aabc::$app->d->s => 'search', 
                                Aabc::$app->d->t => 'show', 
                                Aabc::$app->d->ty => 'ra',
                                Aabc::$app->d->i => Sanpham::tt,
                                'class' => 'mulr',      
                                Aabc::$app->d->c => 'one',                        
                                'id' => Sanpham::tt.'_sp_status2_select'
                            ])->label('Trạng thái'); 
                      
                        ?>
                    </div> 
                </div>

            <div class="clearfix"></div>
          
            <div class="col-md-12 col-sm-6  col-xs-12 pt100" style="margin: 10px 0 0 0;">
                <?php     
                    $_Danhmuc  = Aabc::$app->_model->Danhmuc;                
                    $danhmuc = $_Danhmuc::getAll1_2();                    
                    array_unshift($danhmuc,[
                        Aabc::$app->_danhmuc->dm_id => '',
                        Aabc::$app->_danhmuc->dm_char =>'---Chọn---',
                    ]);//Thêm vào đầu
                    echo $form->field($model, Sanpham::sp_id_chuyenmuc,['options' => ['class' => '']])->dropDownList(ArrayHelper::map($danhmuc,Aabc::$app->_danhmuc->dm_id,Aabc::$app->_danhmuc->dm_char),[
                            
                            'multiple'=>'multiple',
                            Aabc::$app->d->ty => 'checkbox',
                            
                            // Aabc::$app->d->ty => 'ra',
                            // Aabc::$app->d->c => 'one',
                        //    Aabc::$app->d->add => 'ip_cm',
                            // d-add chỉ cần cho d-u, còn d-i của url sẽ được lấy ở fk- bên dưới

                            Aabc::$app->d->i => Sanpham::tt,
                            Aabc::$app->d->t => 'sea',//Search
                            'class' => 'mulr',                        
                            // 'id' => Sanpham::tt.'-sp_id_thuonghieu'
                            'id' => 'fk-'.Aabc::$app->_model->__danhmuc.'-cm'
                        ])->label('Chuyên mục bài viết'); 
                ?>
            </div>
           

            
            <div class="col-md-12 col-sm-6  col-xs-12 pt100" style="margin: 10px 0 0 0;">
                <?php     
                    $_Danhmuc  = Aabc::$app->_model->Danhmuc;                
                    $danhmuc = $_Danhmuc::getAll1_1();                    
                    array_unshift($danhmuc,[
                        Aabc::$app->_danhmuc->dm_id => '',
                        Aabc::$app->_danhmuc->dm_char =>'---Chọn---',
                    ]);//Thêm vào đầu
                    echo $form->field($model, Sanpham::sp_id_danhmuc,['options' => ['class' => '']])->dropDownList(ArrayHelper::map($danhmuc,Aabc::$app->_danhmuc->dm_id,Aabc::$app->_danhmuc->dm_char),[
                            
                            'multiple'=>'multiple',
                            Aabc::$app->d->ty => 'checkbox',
                            
                            // Aabc::$app->d->ty => 'ra',
                            // Aabc::$app->d->c => 'one',
                        //    Aabc::$app->d->add => 'ip_cm',
                            // d-add chỉ cần cho d-u, còn d-i của url sẽ được lấy ở fk- bên dưới

                            Aabc::$app->d->i => Sanpham::tt,
                            Aabc::$app->d->t => 'sea',//Search
                            'class' => 'mulr',                        
                            // 'id' => Sanpham::tt.'-sp_id_thuonghieu'
                            'id' => 'fk-'.Aabc::$app->_model->__danhmuc.'-dmsp'
                        ])->label('Danh mục sản phẩm'); 
                ?>

                <i class="hdtip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="- Bài viết này sẽ được xuất hiện trong các sản phẩm thuộc các Danh mục sản phẩm được chọn." aria-invalid="false"></i>
            </div>






           


           



            <div class="col-md-12 col-sm-6 col-xs-12 pt100"> 
                <?php 
                    if($model[Sanpham::sp_ngaytao] == null){
                        $model[Sanpham::sp_ngaytao] = date("Y-m-d H:i");
                    }else{                 
                        $model[Sanpham::sp_ngaytao] = date("Y-m-d H:i", strtotime($model[Sanpham::sp_ngaytao]));               
                    }
                ?>


                <?= $form->field($model, Sanpham::sp_ngaytao,['options' => ['class' => '']])->widget(\dosamigos\datetimepicker\DateTimePicker::className(), [
                    // 'size' => 'ms',
                    // 'template' => '{input}',
                    'pickButtonIcon' => 'glyphicon glyphicon-time',
                    'pickButtonIcon' => 'glyphicon glyphicon-calendar',
                    'inline' => false,
                    'clientOptions' => [
                        // 'startView' => 1,
                        'minView' => 0,
                        // 'maxView' => 1,
                        'autoclose' => true,
                        // 'linkFormat' => 'HH:ii:ss dd-mm-yyyy', // if inline = true
                        // 'format' => 'HH:ii P', // if inline = false
                        // 'format' => ' hh:ii:ss dd-mm-yyyy',
                        'format' => 'yyyy-mm-dd hh:ii',

                        'todayBtn' => true
                    ]
                ])->label('Ngày đăng');?>
            </div>



            </fieldset>
            <br/>


            <fieldset class="ht ">
            <legend style="background: #2499ce;width: 100%;padding: 5px 10px;margin: 0;color: #FFF;">Tùy chỉnh SEO</legend>            
<!-- 
                <div class="col-md-12 col-sm-7">
                <?php // $form->field($model, Html::encode(Sanpham::sp_tensp),['options' => ['encode' => true,'class' => 'form-group']])->textarea(['rows' => '2','placeholder' => 'Tiêu đề bài viết' ,'maxlength' => true,'data-html' => 'true','data-placement' => 'top','data-trigger' => 'focus', 'data-toggle' => 'tooltip', 'title' => 'Tiêu đề bài viết.'])->label('Tiêu đề seo') ?> 
                </div>

                <div class="col-md-12 col-sm-7">    
                    <?php // $form->field($model, Sanpham::sp_linkseo ,['options' => ['class' => 'form-group']])->textarea(['maxlength' => true ,'placeholder' => 'Đường dẫn bài viết' ,'data-html' => 'true','data-placement' => 'top','data-trigger' => 'focus', 'data-toggle' => 'tooltip', 'title' => 'Đường dẫn bài viết']) ?>
                </div>
                <div class="col-md-12 col-sm-7">    
                    <?php //$form->field($model, Sanpham::sp_motaseo ,['options' => ['class' => 'form-group']])->textarea(['maxlength' => true ,'placeholder' => 'Mô tả seo' ,'data-html' => 'true','data-placement' => 'top','data-trigger' => 'focus', 'data-toggle' => 'tooltip', 'title' => 'Mô tả seo']) ?>
                </div> -->

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
                        <?php echo $form->field($model, Sanpham::sp_linkseo ,['options' => ['class' => '']])->textarea(['maxlength' => true , 'placeholder' => 'Đường dẫn bài viết' ,'data-html' => 'true','data-placement' => 'top','data-trigger' => 'focus', 'data-toggle' => 'tooltip', 'title' => '']) ?>
                        </div>


            </fieldset>
                



               
            </div>






            <div  id="noidung" class="tab-pane col-md-8" style="padding: 10px 10px 0 0;">
                 <?php  
                    // $_Ngonngu = Aabc::$app->_model->Ngonngu;
                    // $ngonngu = new $_Ngonngu();   
                    // $ngonngu = $ngonngu->getAllNgonngu();

                    // $ids = array(             
                    //     'spnn_idsanpham', 
                    //     'spnn_idngonngu', 
                    //     'sanphamngonngu',//Chi co trong Text
                    // ); 
                    // $thuoctinh = array(             
                    //     'spnn_noidung',             
                    // ); 


                    // $_Sanphamngonngu = Aabc::$app->_model->Sanphamngonngu;
                    // $new = new $_Sanphamngonngu(); 


                    // Aabc::$app->MyComponent->dangonngutext($data,$ngonngu,$form,$ids,$thuoctinh,$model[Sanpham::sp_id],$new,'tabnoidung');  

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
        </div>
    </div>
        


    <div class="form-group right">
        <button <?= Aabc::$app->d->i?> = <?= Sanpham::tt ?> type="submit" class="btn btn-default haserror lvt"><span class="glyphicon glyphicon-floppy-disk mxanh"></span>Lưu và Thêm</button>

        <button type="submit" class="btn btn-default haserror"><span class="glyphicon glyphicon-floppy-disk mxanh"></span>Lưu</button>

        <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-ban-circle mdo"></span>Đóng</button>
    </div>

    <?php ActiveForm::end(); ?>

</div>



<script src="./js/sortable.js"></script>

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
 //        	$('#'+pj_id_nhomsanpham+' :nth-child(1)').prop('selected', true);
 //            loadimg();
 //            $.ajax({
 //                cache: false,
 //                url: '<?php echo Aabc::$app->homeUrl ?>nhomsanpham/create',
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


    $('#<?=Sanpham::tt?>-sp_masp').change(function () {                
        var idthis = $(this).attr('id');        
        returnparent($(this),'FORM');
        var form = parent;  
        var formData = form.serialize();

        
        var divparent = $(this).parent();  
        divparent = $(divparent).parent();  
        // console.log(divparent);
        $.ajax({
            url: form.attr("action"),
            type: 'POST',
            data: {
                check:$(this).val(),
            },            
            success: function (data) { 
                if(data == 'ok'){ 
                    $(divparent).find('.ferror').html('');
                    $(divparent).removeClass('has-error');  
                    $(divparent).addClass('has-success');  
                    $('#<?=Sanpham::tt?>-form button[type="submit"]').attr("disabled", false);
                }
                if(data == 'tontai'){
                    $(divparent).find('.ferror').html('Đã bị trùng');
                    $(divparent).removeClass('has-success');  
                    $(divparent).addClass('has-error'); 
                    $('#<?=Sanpham::tt?>-form button[type="submit"]').attr("disabled", true);
                }
            },
            error: function () {
                poploi();
            }
        });
    })


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


     


    $('#<?php // Sanpham::ttngonngu?>-0-spnn_ten').on('keyup keypress',function(){
        // $('#<?= Sanpham::tt?>-<?=Sanpham::sp_linkseo?>').val(urlfriendly($(this).val()));
        // $('#<?= Sanpham::tt?>-<?=Sanpham::sp_tensp?>').val($(this).val());


        // autoheight('#<?= Sanpham::tt?>-<?=Sanpham::sp_linkseo?>');
        // autoheight('#<?= Sanpham::tt?>-<?=Sanpham::sp_tensp?>');

        // $('#<?php // Sanpham::ttngonngu?>-0-spnn_tieudeseo').val($(this).val());
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
                        echo 'reload("'.Sanpham::tt.'","'.Sanpham::index_bv.'?sort=-'.Sanpham::sp_id.'");';
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


</script>







<script type="text/javascript">
   



// function chooseImage(obj) {
//     var selectedSrc = $(".selected-media-file").find("input").val();
//     var src = $(obj).children("img").attr("src");
//     if ($(obj).hasClass("chosen-image")) {
//         $(obj).removeClass("chosen-image");
//         if (selectedSrc != "" && !selectedSrc.endsWith(",")) {
//             selectedSrc = selectedSrc + ",";
//         }
//         selectedSrc = selectedSrc.replace(src + ",", "");
//     } else {
//         $(obj).addClass("chosen-image");
//         selectedSrc += selectedSrc == "" ? src : "," + src;
//     }
//     if (selectedSrc.endsWith(",")) {
//         selectedSrc = selectedSrc.substring(0, selectedSrc.length - 1);
//     }
//     $(".selected-media-file").find("input").val(selectedSrc);
// }

// function chooseProductImage() {
    
// }

// function changeProductThumbType(obj) {
//     $(".selected-thumb-type-product-image").find("input").val($(obj).val());
// }

// function changeThumbType(obj) {
//     $(".selected-thumb-type-media-file").find("input").val($(obj).val());
// }

// function changeSrcByThumbType(src, thumbType) {
//     // src = src.replace(Bizweb.routes.domain.thumb + "small/", Bizweb.routes.domain.media);
//     return (src);

// }


</script>
