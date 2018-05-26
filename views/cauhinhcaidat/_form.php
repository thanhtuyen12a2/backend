<?php

use aabc\helpers\Html;
use aabc\widgets\ActiveForm;

/* @var $this aabc\web\View */
//use backend\models\Cauhinhcaidat;
/* @var $form aabc\widgets\ActiveForm */
?>

<div id="pj<?=Aabc::$app->_model->__cauhinhcaidat?>"    <?=Aabc::$app->d->i?>=<?= Aabc::$app->_model->__cauhinhcaidat?> class="pj">

<div class="<?=Aabc::$app->_model->__cauhinhcaidat?>-index">

    <div class="content-right  col-md-12">


    <?php $form = ActiveForm::begin(
        [
            'id' => Aabc::$app->_model->__cauhinhcaidat.'-form',
            'options' => [
                'class' => 'mone'
             ],            
            // 'enableClientValidation' => false,
            // 'enableAjaxValidation' => true,
            //'validationUrl' => ['validate'],
            // 'validateOnBlur' => false,
            // 'validateOnChange' => false
            //'enableAjaxValidation' => true,
        ]
        );
     ?>
    <script type="text/javascript">
      $('[data-toggle="tooltip"]').tooltip();
    </script>
      <div class="col-md-6 chcd">
      
      <fieldset class="">
            <legend>Thông tin Cửa hàng/Công ty</legend>

    <div class="col-md-12  pt80">
        <?= $form->field($model, Aabc::$app->_cauhinhcaidat->chcd_ten)->textInput(['placeholder' => '','maxlength' => true ]) ?>
    <i class="hdtip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="- Thông tin tên cửa hàng/công ty." aria-invalid="false"></i>
    </div>

   
    <div class="col-md-12  pt80">
        <?= $form->field($model, Aabc::$app->_cauhinhcaidat->chcd_diachi)->textInput(['placeholder' => '','maxlength' => true ]) ?>
    <i class="hdtip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="- Title." aria-invalid="false"></i>
    </div>


     <div class="col-md-6  pt80">
        <?= $form->field($model, Aabc::$app->_cauhinhcaidat->chcd_logo)->textInput(['placeholder' => '','maxlength' => true ]) ?>
    <i class="hdtip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="- Title." aria-invalid="false"></i>
    </div>


    <div class="col-md-6  pt80">
        <?= $form->field($model, Aabc::$app->_cauhinhcaidat->chcd_dienthoai)->textInput(['placeholder' => '','maxlength' => true ]) ?>
    <i class="hdtip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="- Title." aria-invalid="false"></i>
    </div>
   
    <div class="col-md-6  pt80">
        <?= $form->field($model, Aabc::$app->_cauhinhcaidat->chcd_email)->textInput(['placeholder' => '','maxlength' => true ]) ?>
    <i class="hdtip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="- Title." aria-invalid="false"></i>
    </div>

     <div class="col-md-6  pt80">
        <?= $form->field($model, Aabc::$app->_cauhinhcaidat->chcd_website)->textInput(['placeholder' => '','maxlength' => true ]) ?>
    <i class="hdtip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="- Title." aria-invalid="false"></i>
    </div>

    </fieldset>

    </div>

    
    <div class="col-md-6 chcd">
     <fieldset class="">
            <legend>Cấu hình SEO</legend>

    <div class="col-md-12  pt100">
        <?= $form->field($model, Aabc::$app->_cauhinhcaidat->chcd_tieudeseo)->textInput(['placeholder' => '','maxlength' => true ]) ?>
    <i class="hdtip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="- Title." aria-invalid="false"></i>
    </div>

    <div class="col-md-12  pt100">
        <?= $form->field($model, Aabc::$app->_cauhinhcaidat->chcd_motaseo)->textInput(['placeholder' => '','maxlength' => true ]) ?>
    <i class="hdtip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="- Title." aria-invalid="false"></i>
    </div>

   

    <div class="col-md-6  pt100">
        <?= $form->field($model, Aabc::$app->_cauhinhcaidat->chcd_robots)->dropDownList([ 1 => 'index', 2 => 'noindex' ],['placeholder' => '','maxlength' => true ,
                            //'multiple'=>'multiple', 
                            // Aabc::$app->d->s => 'search', 
                             //Aabc::$app->d->t => 'show',   
                             Aabc::$app->d->ty => 'ra',
                            Aabc::$app->d->i => Aabc::$app->_model->__cauhinhcaidat,
                            'class' => 'mulr',      
                            Aabc::$app->d->c => 'one',                        
                            'id' => Aabc::$app->_model->__cauhinhcaidat.'_chcd_robots_select'
                        ]) ?>
    <i class="hdtip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="- Title." aria-invalid="false"></i>
    </div>




    <div class="col-md-6  pt100">
        <?= $form->field($model, Aabc::$app->_cauhinhcaidat->chcd_googlebot)->dropDownList([1 => 'Mỗi giờ', 2 => 'Mỗi ngày', 3 => 'Mỗi tuần', 4 => 'Mỗi tháng', ],['placeholder' => '','maxlength' => true ,
                            //'multiple'=>'multiple', 
                            // Aabc::$app->d->s => 'search',

                             Aabc::$app->d->ty => 'ra',
                            Aabc::$app->d->i => Aabc::$app->_model->__cauhinhcaidat,
                            'class' => 'mulr',      
                            Aabc::$app->d->c => 'one',                        
                            'id' => Aabc::$app->_model->__cauhinhcaidat.'_chcd_googlebot_select'
                        ]) ?>
    <i class="hdtip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="- Title." aria-invalid="false"></i>
    </div>

    <div class="col-md-6  pt100">
        <?= $form->field($model, Aabc::$app->_cauhinhcaidat->chcd_ananytic)->textInput(['placeholder' => '','maxlength' => true ]) ?>
    <i class="hdtip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="- Title." aria-invalid="false"></i>
    </div>

    <div class="col-md-6  pt100">
        <?= $form->field($model, Aabc::$app->_cauhinhcaidat->chcd_fbid)->textInput(['placeholder' => '','maxlength' => true ]) ?>
    <i class="hdtip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="- Title." aria-invalid="false"></i>
    </div>

    <div class="col-md-6  pt100">
        <?= $form->field($model, Aabc::$app->_cauhinhcaidat->chcd_fbapp)->textInput(['placeholder' => '','maxlength' => true ]) ?>
    <i class="hdtip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="- Title." aria-invalid="false"></i>
    </div>

    <div class="col-md-6  pt100">
        <?= $form->field($model, Aabc::$app->_cauhinhcaidat->chcd_fbpixel)->textInput(['placeholder' => '','maxlength' => true ]) ?>
    <i class="hdtip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="- Title." aria-invalid="false"></i>
    </div>

    <div class="col-md-6  pt100">
        <?= $form->field($model, Aabc::$app->_cauhinhcaidat->chcd_googlewmt)->textInput(['placeholder' => '','maxlength' => true ]) ?>
    <i class="hdtip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="- Title." aria-invalid="false"></i>
    </div>

    </fieldset>
    </div>
    
     
    <div class="col-md-6 chcd">
     <fieldset class="">
            <legend>Tiền tệ - Đo lường</legend>


    <div class="col-md-6  pt100">
        <?= $form->field($model, Aabc::$app->_cauhinhcaidat->chcd_tiente)->dropDownList(['đ' => 'đ', '$' => '$', ],['placeholder' => '' ,
                            //'multiple'=>'multiple', 
                            // Aabc::$app->d->s => 'search', 
                             Aabc::$app->d->ty => 'ra',
                            Aabc::$app->d->i => Aabc::$app->_model->__cauhinhcaidat,
                            'class' => 'mulr',      
                            Aabc::$app->d->c => 'one',                        
                            'id' => Aabc::$app->_model->__cauhinhcaidat.'_chcd_tiente_select'
                        ]) ?>
    <i class="hdtip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="- Title." aria-invalid="false"></i>
    </div>

    <div class="col-md-6  pt100">
        <?= $form->field($model, Aabc::$app->_cauhinhcaidat->chcd_vitritiente)->dropDownList([1 => 'Phải', 2 => 'Trái', ],['placeholder' => '' ,
                            //'multiple'=>'multiple', 
                            // Aabc::$app->d->s => 'search', 
                             Aabc::$app->d->ty => 'ra',
                            Aabc::$app->d->i => Aabc::$app->_model->__cauhinhcaidat,
                            'class' => 'mulr',      
                            Aabc::$app->d->c => 'one',                        
                            'id' => Aabc::$app->_model->__cauhinhcaidat.'_chcd_vitritiente_select'
                        ]) ?>
    <i class="hdtip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="- Title." aria-invalid="false"></i>
    </div>

    <div class="col-md-6  pt100">
        <?= $form->field($model, Aabc::$app->_cauhinhcaidat->chcd_trongluong)->dropDownList(['kg' => 'Kg','g' => 'G'],['placeholder' => '' ,
                            //'multiple'=>'multiple', 
                            // Aabc::$app->d->s => 'search', 
                             Aabc::$app->d->ty => 'ra',
                            Aabc::$app->d->i => Aabc::$app->_model->__cauhinhcaidat,
                            'class' => 'mulr',      
                            Aabc::$app->d->c => 'one',                        
                            'id' => Aabc::$app->_model->__cauhinhcaidat.'_chcd_trongluong_select'
                        ]) ?>
    <i class="hdtip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="- Title." aria-invalid="false"></i>
    </div>

    <div class="col-md-6  pt100">
        <?= $form->field($model, Aabc::$app->_cauhinhcaidat->chcd_dodai)->dropDownList([ 'm' => 'M','km' => 'Km',  'cm' => 'Cm', 'mm' => 'Mm', ],['placeholder' => '' ,
                            //'multiple'=>'multiple', 
                            // Aabc::$app->d->s => 'search', 
                             Aabc::$app->d->ty => 'ra',
                            Aabc::$app->d->i => Aabc::$app->_model->__cauhinhcaidat,
                            'class' => 'mulr',      
                            Aabc::$app->d->c => 'one',                        
                            'id' => Aabc::$app->_model->__cauhinhcaidat.'_chcd_dodai_select'
                        ]) ?>
    <i class="hdtip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="- Title." aria-invalid="false"></i>
    </div>

    <div class="col-md-6  pt100">
        <?= $form->field($model, Aabc::$app->_cauhinhcaidat->chcd_dientich)->dropDownList([ 'm2' => 'M2', 'cm2' => 'Cm2', ],['placeholder' => '' ,
                            //'multiple'=>'multiple', 
                            // Aabc::$app->d->s => 'search', 
                             Aabc::$app->d->ty => 'ra',
                            Aabc::$app->d->i => Aabc::$app->_model->__cauhinhcaidat,
                            'class' => 'mulr',      
                            Aabc::$app->d->c => 'one',                        
                            'id' => Aabc::$app->_model->__cauhinhcaidat.'_chcd_dientich_select'
                        ]) ?>
    <i class="hdtip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="- Title." aria-invalid="false"></i>
    </div>

    <div class="col-md-6  pt100">
        <?= $form->field($model, Aabc::$app->_cauhinhcaidat->chcd_donvitinh)->dropDownList([ '' => '--Chọn--', 'Chiếc' => 'Chiếc', 'Cái' => 'Cái', 'Hộp' => 'Hộp', 'Lốc' => 'Lốc', 'Thùng' => 'Thùng', 'Cuộn' => 'Cuộn', 'Bộ' => 'Bộ', 'Cây' => 'Cây', 'Quả' => 'Quả', 'Bao' => 'Bao', 'Viên' => 'Viên', 'Chai' => 'Chai', ],['placeholder' => '' ,
                            //'multiple'=>'multiple', 
                             Aabc::$app->d->s => 'search', 
                             Aabc::$app->d->ty => 'ra',
                            Aabc::$app->d->i => Aabc::$app->_model->__cauhinhcaidat,
                            'class' => 'mulr',      
                            Aabc::$app->d->c => 'one',                        
                            'id' => Aabc::$app->_model->__cauhinhcaidat.'_chcd_donvitinh_select'
                        ]) ?>
    <i class="hdtip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="- Title." aria-invalid="false"></i>
    </div>




     </fieldset>





        </div>

        <div class="form-group right">

            <button type="submit" class="btn btn-default haserror"><span class="glyphicon glyphicon-floppy-disk mxanh"></span>Lưu</button>

            
        </div>




    <?php ActiveForm::end(); ?>
    
    </div>

</div>

</div>

<script type="text/javascript">  

  

    $('.modal-content #<?=Aabc::$app->_model->__cauhinhcaidat?>-form').on('keyup keypress', function(e) {
      var keyCode = e.keyCode || e.which;
      if (keyCode === 13) { 
        e.preventDefault();
        return false;
      }
    });


$('form#<?=Aabc::$app->_model->__cauhinhcaidat?>-form').on('beforeSubmit', function(e) {
    loadimg();
    var form = $(this);
    var formData = form.serialize();
    $.ajax({
        url: form.attr("action"),
        type: form.attr("method"),
        data: formData,
        success: function (data) {
            reload('<?=Aabc::$app->_model->__cauhinhcaidat?>');  
            
            //update element
            // pjelm('<?=Aabc::$app->_model->__cauhinhcaidat?>');  

            if(data == 1){ 
                popthanhcong('','#<?php  if(isset($_POST['modal'])) echo $_POST['modal']?>');
            }else{
                popthatbai('');
            }            
            // lvtok('<?=Aabc::$app->_model->__cauhinhcaidat?>');
        },
        error: function () {
            reload('<?=Aabc::$app->_model->__cauhinhcaidat?>');
            poploi();
        }
    });
}).on('submit', function(e){
    e.preventDefault();
});
</script>