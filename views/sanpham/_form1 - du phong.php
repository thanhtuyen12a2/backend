<?php

use aabc\helpers\Html;
use aabc\widgets\ActiveForm;

use backend\models\Sanphamngonngu;
use backend\models\Ngonngu;

// use aabc\widgets\Pjax;
use aabc\bootstrap\Modal; /*Them*/
/* @var $this aabc\web\View */
/* @var $model backend\models\Sanpham */
/* @var $form aabc\widgets\ActiveForm */
use aabc\helpers\ArrayHelper;
// use backend\models\Nhomsanpham;
use backend\models\Thuonghieu;

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

<?php 
$this->registerJs(  
"    
    // var stringhtml = $('.sanpham-form').html();
    // $('.sanpham-form').parent().parent().html(stringhtml);  
")?>

<div class="<?=Aabc::$app->_model->__sanpham?>-form">
 <?php $form = ActiveForm::begin(   
    [
        'id' => Aabc::$app->_model->__sanpham.'-form',
        // 'enableClientValidation' => false,
        // 'enableAjaxValidation' => false,
        // 'validationUrl' => ['validate'],
        // 'validateOnBlur' => false,
        // 'validateOnChange' => false
        //'enableAjaxValidation' => true,
    ]
    );
?>

  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home"><?=Aabc::$app->MyConst->form_tab_thongtinchung;?></a></li>

    <?php if(Aabc::$app->user->can('web')){?>
        <li><a data-toggle="tab" href="#noidung"><?=Aabc::$app->MyConst->form_tab_motasanpham;?></a></li>
    <?php }?>

    <li><a data-toggle="tab" href="#tabmenu2"><?=Aabc::$app->MyConst->form_tab_motasanpham;?></a></li>
   
    <?php if(Aabc::$app->user->can('web')){?>
    <li><a data-toggle="tab" href="#menu3"><?=Aabc::$app->MyConst->form_tab_toiuuseo;?></a></li>
    <?php }?>
  </ul>
  <script type="text/javascript">
      $('[data-toggle="tooltip"]').tooltip();
  </script>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
        <div class="row"> 
            <div class="pt2">
                <?= $form->field($model, Html::encode(Aabc::$app->_sanpham->sp_tensp),['options' => ['encode' => true,'class' => 'col-md-8']])->textInput(['maxlength' => true,'data-placement' => 'bottom','data-trigger' => 'focus', 'data-toggle' => 'tooltip', 'title' => 'Tên của sản phẩm - hàng hóa - dịch vụ']) ?> 

              

            </div>                   
            <div class="pt3">
                </div>  
        </div>


        <div class="row">
            <div class="col-md-4 col-sm-4">

                            
            <?= $form->field($model, Aabc::$app->_sanpham->sp_masp,['options' => ['class' => 'pt4 col-md-12'],'enableClientValidation' => false])->textInput(['maxlength' => true,'class' => 'uppercase form-control','data-trigger' => 'focus','data-placement' => 'right' ,'data-html' => 'true', 'data-toggle' => 'tooltip','title' => '- Mã số, mã vạch của sản phẩm. <br/>- Nếu bạn không điền thì phần mềm sẽ tự sinh mã.']) ?>  

             <?php   
                if($model[Aabc::$app->_sanpham->sp_status] == NULL) $model[Aabc::$app->_sanpham->sp_status] = '1'; 
              if(Aabc::$app->user->can('web')){               
                echo $form->field($model, Aabc::$app->_sanpham->sp_status,['options' => ['class' => 'pt4 col-md-12']])->dropDownList(['' => '--Chọn--','1'=>'Hiển thị','2'=>'Ẩn'],[
                        'data-placement' => 'right' ,'data-trigger' => 'focus','data-html' => 'true', 'data-toggle' => 'tooltip','title' => 'Tùy chọn hiển thị sản phẩm trên Website.',
                        //'multiple'=>'multiple', 
                        // Aabc::$app->d->s => 'search',  
                        Aabc::$app->d->ty => 'ra',
                        Aabc::$app->d->i => Aabc::$app->_model->__sanpham,
                        'class' => 'mulr',      
                        Aabc::$app->d->c => 'one',                        
                        'id' => Aabc::$app->_model->__sanpham.'_sp_status2_select'
                    ]); 

               }
                ?>

          

           
            <?php                  
                if($model[Aabc::$app->_sanpham->sp_conhang] == NULL) $model[Aabc::$app->_sanpham->sp_conhang] = '1';
                echo $form->field($model, Aabc::$app->_sanpham->sp_conhang,['options' => ['class' => 'pt4 col-md-12']])->dropDownList(['' => '--Chọn--','1'=>'Còn hàng','2'=>'Tạm hết','3'=>'Ngừng kinh doanh'],['data-placement' => 'right','data-trigger' => 'focus','data-html' => 'true', 'data-toggle' => 'tooltip','title' => 'Tình trạng hoạt động kinh doanh của sản phẩm.',
                        //'multiple'=>'multiple', 
                        // Aabc::$app->d->s => 'search', 
                        Aabc::$app->d->ty => 'ra',
                        Aabc::$app->d->i => Aabc::$app->_model->__sanpham,
                        'class' => 'mulr',      
                        Aabc::$app->d->c => 'one',                        
                         'id' => Aabc::$app->_model->__sanpham.'_sp_conhang_select'
                    ]); 
                ?>


            
                <?php
                    // if($model->sp_gia == NULL) $model->sp_gia = 0;
                    if($model[Aabc::$app->_sanpham->sp_giakhuyenmai] == NULL) $model[Aabc::$app->_sanpham->sp_giakhuyenmai] = 0;
                    if($model[Aabc::$app->_sanpham->sp_soluong] == NULL) $model[Aabc::$app->_sanpham->sp_soluong] = 0;
                    if($model[Aabc::$app->_sanpham->sp_soluongfake] == NULL) $model[Aabc::$app->_sanpham->sp_soluongfake] = 0;
                ?>
                
                

                <?php 
                        // $nsp = Nhomsanpham::getAllSothutu();
                        // // array_push($nsp,[
                        // //     'nsp_id' => '',
                        // //     'nsp_char' =>'---Thêm mới---',
                        // // ]);//Thêm vào cuối
                        // array_unshift($nsp,[
                        //     'nsp_id' => '',
                        //     'nsp_char' =>'---Chọn---',
                        // ]);//Thêm vào đầu

                        // echo $form->field($model, Aabc::$app->_sanpham->sp_id_nhomsanpham,['options' => ['class' => 'pt4 col-md-12']])->dropDownList(ArrayHelper::map($nsp, 'nsp_id', 'nsp_char'),
                        //     ['data-placement' => 'right' ,'data-placement' => 'right' ,'data-trigger' => 'focus','data-html' => 'true', 'data-toggle' => 'tooltip','title' => 'Sản phẩm thuộc Nhóm sản phẩm nào?.',
                        //         //'multiple'=>'multiple', 
                        //         // Aabc::$app->d->s => 'search', 
                        //         Aabc::$app->d->ty => 'ra', 
                        //         Aabc::$app->d->i => 'sanpham',
                        //         Aabc::$app->d->c => 'one',
                        //         Aabc::$app->d->t => 'sea',
                        //         'class' => 'mulr',                        
                        //         'id' => 'sanpham-sp_id_nhomsanpham'
                        //     ]); 
                ?>

               
                 <?php                     
                    $nsp = Thuonghieu::getAllRecycle0();                    
                    array_unshift($nsp,[
                        'nsp_id' => '',
                        'nsp_char' =>'---Chọn---',
                    ]);//Thêm vào đầu
                    echo $form->field($model, Aabc::$app->_sanpham->sp_id_thuonghieu,['options' => ['class' => 'pt4 col-md-12']])->dropDownList(ArrayHelper::map($nsp, 'thuonghieu_id', 'thuonghieu_ten'),[
                            
                            // 'multiple'=>'multiple',                             
                            // Aabc::$app->d->ty => 'checkbox',
                            
                            Aabc::$app->d->ty => 'ra',                            
                            Aabc::$app->d->c => 'one',                            
                            Aabc::$app->d->add => '/',
                            // d-add chỉ cần cho d-u, còn d-i của url sẽ được lấy ở fk- bên dưới

                            Aabc::$app->d->i => Aabc::$app->_model->__sanpham,
                            Aabc::$app->d->t => 'sea',//Search
                            'class' => 'mulr',                        
                            // 'id' => Aabc::$app->_model->__sanpham.'-sp_id_thuonghieu'
                            'id' => 'fk-'.Aabc::$app->_model->__thuonghieu.'7'
                        ]); 
                ?>


                <?php     
                    $_Danhmuc  = Aabc::$app->_model->Danhmuc;                
                    $danhmuc = $_Danhmuc::getAllRecycle0_1();                    
                    array_unshift($danhmuc,[
                        Aabc::$app->_danhmuc->dm_id => '',
                        Aabc::$app->_danhmuc->dm_char =>'---Chọn---',
                    ]);//Thêm vào đầu
                    echo $form->field($model, Aabc::$app->_sanpham->sp_id_danhmuc,['options' => ['class' => 'pt4 col-md-12']])->dropDownList(ArrayHelper::map($danhmuc,Aabc::$app->_danhmuc->dm_id,Aabc::$app->_danhmuc->dm_char),[
                            
                            'multiple'=>'multiple',                             
                            Aabc::$app->d->ty => 'checkbox',
                            
                            // Aabc::$app->d->ty => 'ra',                            
                            // Aabc::$app->d->c => 'one',                            
                            Aabc::$app->d->add => 'ip',
                            // d-add chỉ cần cho d-u, còn d-i của url sẽ được lấy ở fk- bên dưới

                            Aabc::$app->d->i => Aabc::$app->_model->__sanpham,
                            Aabc::$app->d->t => 'sea',//Search
                            'class' => 'mulr',                        
                            // 'id' => Aabc::$app->_model->__sanpham.'-sp_id_thuonghieu'
                            'id' => 'fk-'.Aabc::$app->_model->__danhmuc
                        ]); 
                ?>


                
            <div class="col-md-12 col-sm-5 col-xs-12 pt25"> 
                <?php 
                    if($model[Aabc::$app->_sanpham->sp_ngaytao] == null){
                        $model[Aabc::$app->_sanpham->sp_ngaytao] = date("Y-m-d H:i");
                    }else{                 
                        $model[Aabc::$app->_sanpham->sp_ngaytao] = date("Y-m-d H:i", strtotime($model[Aabc::$app->_sanpham->sp_ngaytao]));               
                    }
                ?>


                <?= $form->field($model, Aabc::$app->_sanpham->sp_ngaytao,['options' => ['class' => '']])->widget(\dosamigos\datetimepicker\DateTimePicker::className(), [
                    // 'size' => 'ms',
                    // 'template' => '{input}',
                    'pickButtonIcon' => 'glyphicon glyphicon-time',
                    'pickButtonIcon' => 'glyphicon glyphicon-calendar',
                    'inline' => false,
                    'clientOptions' => [
                        // 'startView' => 1,
                        'minView' => 2,
                        // 'maxView' => 1,
                        'autoclose' => true,
                        // 'linkFormat' => 'HH:ii:ss dd-mm-yyyy', // if inline = true
                        // 'format' => 'HH:ii P', // if inline = false
                        // 'format' => ' hh:ii:ss dd-mm-yyyy',
                        'format' => 'yyyy-mm-dd hh:ii',

                        'todayBtn' => true
                    ]
                ]);?>
            </div>




                <?php                 
                     echo $form->field($model, Aabc::$app->_sanpham->sp_id_ncc,['options' => ['class' => 'pt4 col-md-12']])->textInput();                    
                ?>
               
              



                <?php
                    if(Aabc::$app->user->can('web')){
                        echo $form->field($model, Aabc::$app->_sanpham->sp_gia,['options' => ['class' => 'pt4 col-md-12']])->textInput(['maxlength' => true,'class' => 'nbr form-control']);
                    }
                ?>

                <?= $form->field($model, Aabc::$app->_sanpham->sp_giakhuyenmai,['options' => ['class' => 'pt4 col-md-12']])->textInput(['maxlength' => true,'class' => 'nbr form-control']) ?>

                <?= $form->field($model, Aabc::$app->_sanpham->sp_soluong,['options' => ['class' => 'pt4 col-md-12']])->textInput(['maxlength' => true,'class' => 'nbr form-control']) ?>

                <?= $form->field($model, Aabc::$app->_sanpham->sp_soluongfake,['options' => ['class' => 'pt4 col-md-12']])->textInput(['maxlength' => true,'class' => 'nbr form-control']) ?>
            </div>

            <div class="col-md-8 col-sm-8">
                
               



            </div>
        </div>

        <?= '<button type="button" '.Aabc::$app->d->m.' = "4" id="mb'.Aabc::$app->_model->__sanpham.'"  '.Aabc::$app->d->u .'="ga?i=icon" class="btn btn-success mb"   '. Aabc::$app->d->i.'='.Aabc::$app->_model->__image.'><span class="glyphicon glyphicon-plus mtrang"></span>'.Aabc::$app->MyConst->view_btn_chonanh.'</button>'?>


        <ul id="editable"> 
            <?php
                if(isset($model[Aabc::$app->_sanpham->sp_images])){
                    $listimg = explode("-",$model[Aabc::$app->_sanpham->sp_images]);
                    foreach ($listimg as $key => $value) {
                        $_Image = Aabc::$app->_model->Image;
                        $img = $_Image::find()->andWhere([Aabc::$app->_image->image_id => $value])->one();
                        if(isset($img)){
                            echo '<li><input type="hidden" name="'.Aabc::$app->d->postimg.'[]" value="'.$value.'" /><img src="/20170715/thumb/75/75/'.$img[Aabc::$app->_image->image_tenfile]. '-' . $img[Aabc::$app->_image->image_id]. $img[Aabc::$app->_image->image_morong].'"><i class="js-remove">✖</i></li>';
                        }
                    }                    
                }
            ?>           
        </ul>


        <div class="selected-product-image"><input /></div>

    </div>
        <?php
            if(Aabc::$app->user->can('web')){
        ?>
        <div id="noidung" class="tab-pane fade">
            <?php  
                $_Ngonngu = Aabc::$app->_model->Ngonngu;
                $ngonngu = new $_Ngonngu();   
                $ngonngu = $ngonngu->getAllNgonngu();

                $ids = array(             
                    'spnn_idsanpham', 
                    'spnn_idngonngu', 
                    'sanphamngonngu',//Chi co trong Text
                ); 
                $thuoctinh = array(             
                    'spnn_noidung',             
                ); 


                $_Sanphamngonngu = Aabc::$app->_model->Sanphamngonngu;
                $new = new $_Sanphamngonngu(); 


                Aabc::$app->MyComponent->dangonngutext($data,$ngonngu,$form,$ids,$thuoctinh,$model[Aabc::$app->_sanpham->sp_id],$new,'tabnoidung');            
             ?>

         </div>

        <?php
            }
        ?>    

   
    



   
   
    <div id="tabmenu2" class="tab-pane fade">
        
       
        <?php //echo $form->field($model, Aabc::$app->_sanpham->sp_recycle)->dropDownList([ '0', '1', ], ['prompt' => '']) ?>


        <?= $form->field($model, Aabc::$app->_sanpham->sp_view)->textInput(['maxlength' => true]) ?>
       
       <!--  <? //$form->field($model, Aabc::$app->_sanpham->sp_idnguoitao)->textInput() ?>

        <? //$form->field($model, Aabc::$app->_sanpham->sp_idnguoiupdate)->textInput() ?> -->

        

        

        <?= $form->field($model, Aabc::$app->_sanpham->sp_soluotmua)->textInput(['maxlength' => true]) ?>      
    </div>
     <?php if(Aabc::$app->user->can('web')){?>
    
    <div id="menu3" class="tab-pane fade"> 
        <div class="row">  
            <div class="col-md-6 pt25">
            <?php 
                $_Ngonngu = Aabc::$app->_model->Ngonngu;
                $ngonngu = new $_Ngonngu();   
                $ngonngu = $ngonngu->getAllNgonngu();

                $ids = array(             
                    'spnn_idsanpham', 
                    'spnn_idngonngu',                         
                ); 
                $thuoctinh = array(             
                    'spnn_ten', 
                    // 'spnn_tieudeseo', 
                    // 'spnn_motaseo',             
                ); 

                $_Sanphamngonngu = Aabc::$app->_model->Sanphamngonngu;
                $new = new $_Sanphamngonngu();     
               
                Aabc::$app->MyComponent->dangonngu($data,$ngonngu,$form,$ids,$thuoctinh,$model[Aabc::$app->_sanpham->sp_id],$new,'tabseo');
            ?>
            </div> 
            <div class="col-md-6 pt2">    
                <?= $form->field($model, Aabc::$app->_sanpham->sp_linkseo)->textInput(['maxlength' => true]) ?>
            </div>
        </div>
    </div>    
    <?php }?>
  </div>


    <div class="form-group right">
        <button <?= Aabc::$app->d->i?> = <?= Aabc::$app->_model->__sanpham ?> type="submit" class="btn btn-default haserror lvt"><span class="glyphicon glyphicon-floppy-disk mxanh"></span>Lưu và Thêm</button>

        <button type="submit" class="btn btn-default haserror"><span class="glyphicon glyphicon-floppy-disk mxanh"></span>Lưu</button>

        <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-ban-circle mdo"></span>Đóng</button>
    </div>

    <?php ActiveForm::end(); ?>

</div>



<script src="/20170715/ad/js/sortable.js"></script>

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


    $('#<?=Aabc::$app->_model->__sanpham?>-sp_masp').change(function () {                
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
                    $('#<?=Aabc::$app->_model->__sanpham?>-form button[type="submit"]').attr("disabled", false);
                }
                if(data == 'tontai'){
                    $(divparent).find('.ferror').html('Đã bị trùng');
                    $(divparent).removeClass('has-success');  
                    $(divparent).addClass('has-error'); 
                    $('#<?=Aabc::$app->_model->__sanpham?>-form button[type="submit"]').attr("disabled", true);
                }
            },
            error: function () {
                poploi();
            }
        });
    })


    $('#<?=Aabc::$app->_model->__sanpham?>-sp_tensp').on('keyup keypress',function(){
        $('#<?=Aabc::$app->_model->__sanpham?>-sp_linkseo').val(urlfriendly($(this).val()));
    });


    $('#modal #<?=Aabc::$app->_model->__sanpham?>-form input').on('keyup keypress', function(e){
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13){
            e.preventDefault();
            return false;
        }
    });


$('form#<?=Aabc::$app->_model->__sanpham?>-form').on('beforeSubmit', function(e) {
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
                        // echo 'reload("'.Aabc::$app->_model->__sanpham.'",updateQueryStringParameter(getdu("'.Aabc::$app->_model->__sanpham.'").replace(/&amp;/g, "&"),"sort","-'.Aabc::$app->_sanpham->sp_id.'"));';
                        // index?sort=-sp_id
                        echo 'reload("'.Aabc::$app->_model->__sanpham.'","i?sort=-'.Aabc::$app->_sanpham->sp_id.'");';
                    }else{
                        echo "reload('".Aabc::$app->_model->__sanpham."');";
                    }
                ?>
                
                popthanhcong('','#modal');

                lvtok('<?=Aabc::$app->_model->__sanpham?>'); 
            }else{
                // $(this).find('button[type=submit]').addClass('active');
                reload('<?=Aabc::$app->_model->__sanpham?>');
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
