<?php

use aabc\helpers\Html;
use aabc\widgets\ActiveForm;

/* @var $this aabc\web\View */
//use backend\models\Chinhsach;
/* @var $form aabc\widgets\ActiveForm */
?>

<div class="<?=Aabc::$app->_model->__chinhsach?>-form">

    <?php $form = ActiveForm::begin(
        [
            'id' => Aabc::$app->_model->__chinhsach.'-form',
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
      <div class="">
      


<div class="col-md-12  pt4">
    <?= $form->field($model, Aabc::$app->_chinhsach->cs_type)->dropDownList([ '' => '--Chọn--', 1 => '1', 2 => '2', 3 => '3', ],['placeholder' => '' ,'data-placement' => 'top', 'data-html' => 'true','data-trigger' => 'focus','data-html' => 'true', 'data-toggle' => 'tooltip','title' => 'title',
                        //'multiple'=>'multiple', 
                        // Aabc::$app->d->s => 'search', 
                        // Aabc::$app->d->ty => 'ra',
                        //Aabc::$app->d->i => Aabc::$app->_model->__chinhsach,
                        //'class' => 'mulr',      
                        // Aabc::$app->d->c => 'one',                        
                        //'id' => Aabc::$app->_model->__chinhsach.'_cs_type_select'
                    ]) ?>
</div>

<div class="col-md-12  pt4">
    <?= $form->field($model, Aabc::$app->_chinhsach->cs_ten)->textInput(['placeholder' => '' ,'maxlength' => true,'data-placement' => 'top', 'data-html' => 'true','data-trigger' => 'focus', 'data-toggle' => 'tooltip', 'title' => 'title']) ?>
</div>

<div class="col-md-12  pt4">
    <?= $form->field($model, Aabc::$app->_chinhsach->cs_code)->textInput(['placeholder' => '' ,'maxlength' => true,'data-placement' => 'top', 'data-html' => 'true','data-trigger' => 'focus', 'data-toggle' => 'tooltip', 'title' => 'title']) ?>
</div>

<div class="col-md-12  pt4">
    <?= $form->field($model, Aabc::$app->_chinhsach->cs_ghichu)->textInput(['placeholder' => '' ,'maxlength' => true,'data-placement' => 'top', 'data-html' => 'true','data-trigger' => 'focus', 'data-toggle' => 'tooltip', 'title' => 'title']) ?>
</div>

<div class="col-md-12  pt4">
    <?= $form->field($model, Aabc::$app->_chinhsach->cs_typetyle)->dropDownList([ '' => '--Chọn--', 1 => '1', 2 => '2', ],['placeholder' => '' ,'data-placement' => 'top', 'data-html' => 'true','data-trigger' => 'focus','data-html' => 'true', 'data-toggle' => 'tooltip','title' => 'title',
                        //'multiple'=>'multiple', 
                        // Aabc::$app->d->s => 'search', 
                        // Aabc::$app->d->ty => 'ra',
                        //Aabc::$app->d->i => Aabc::$app->_model->__chinhsach,
                        //'class' => 'mulr',      
                        // Aabc::$app->d->c => 'one',                        
                        //'id' => Aabc::$app->_model->__chinhsach.'_cs_typetyle_select'
                    ]) ?>
</div>

<div class="col-md-12  pt4">
    <?= $form->field($model, Aabc::$app->_chinhsach->cs_tylechietkhau)->textInput(['placeholder' => '' ,'maxlength' => true,'data-placement' => 'top', 'data-html' => 'true','data-trigger' => 'focus', 'data-toggle' => 'tooltip', 'title' => 'title']) ?>
</div>

<div class="col-md-12  pt4">
    <?= $form->field($model, Aabc::$app->_chinhsach->cs_apdungcho)->dropDownList([ '' => '--Chọn--', 1 => '1', 2 => '2', ],['placeholder' => '' ,'data-placement' => 'top', 'data-html' => 'true','data-trigger' => 'focus','data-html' => 'true', 'data-toggle' => 'tooltip','title' => 'title',
                        //'multiple'=>'multiple', 
                        // Aabc::$app->d->s => 'search', 
                        // Aabc::$app->d->ty => 'ra',
                        //Aabc::$app->d->i => Aabc::$app->_model->__chinhsach,
                        //'class' => 'mulr',      
                        // Aabc::$app->d->c => 'one',                        
                        //'id' => Aabc::$app->_model->__chinhsach.'_cs_apdungcho_select'
                    ]) ?>
</div>

<div class="col-md-12  pt4">
    <?= $form->field($model, Aabc::$app->_chinhsach->cs_dieukien)->dropDownList([ '' => '--Chọn--', 1 => '1', 2 => '2', ],['placeholder' => '' ,'data-placement' => 'top', 'data-html' => 'true','data-trigger' => 'focus','data-html' => 'true', 'data-toggle' => 'tooltip','title' => 'title',
                        //'multiple'=>'multiple', 
                        // Aabc::$app->d->s => 'search', 
                        // Aabc::$app->d->ty => 'ra',
                        //Aabc::$app->d->i => Aabc::$app->_model->__chinhsach,
                        //'class' => 'mulr',      
                        // Aabc::$app->d->c => 'one',                        
                        //'id' => Aabc::$app->_model->__chinhsach.'_cs_dieukien_select'
                    ]) ?>
</div>

<div class="col-md-12  pt4">
    <?= $form->field($model, Aabc::$app->_chinhsach->cs_noidungdieukien)->textInput(['placeholder' => '' ,'maxlength' => true,'data-placement' => 'top', 'data-html' => 'true','data-trigger' => 'focus', 'data-toggle' => 'tooltip', 'title' => 'title']) ?>
</div>

<div class="col-md-12  pt4">
    <?= $form->field($model, Aabc::$app->_chinhsach->cs_status)->dropDownList([ '' => '--Chọn--', 1 => '1', 2 => '2', ],['placeholder' => '' ,'data-placement' => 'top', 'data-html' => 'true','data-trigger' => 'focus','data-html' => 'true', 'data-toggle' => 'tooltip','title' => 'title',
                        //'multiple'=>'multiple', 
                        // Aabc::$app->d->s => 'search', 
                        // Aabc::$app->d->ty => 'ra',
                        //Aabc::$app->d->i => Aabc::$app->_model->__chinhsach,
                        //'class' => 'mulr',      
                        // Aabc::$app->d->c => 'one',                        
                        //'id' => Aabc::$app->_model->__chinhsach.'_cs_status_select'
                    ]) ?>
</div>

<div class="col-md-12  pt4">
    <?= $form->field($model, Aabc::$app->_chinhsach->cs_recycle)->dropDownList([ '' => '--Chọn--', 1 => '1', 2 => '2', ],['placeholder' => '' ,'data-placement' => 'top', 'data-html' => 'true','data-trigger' => 'focus','data-html' => 'true', 'data-toggle' => 'tooltip','title' => 'title',
                        //'multiple'=>'multiple', 
                        // Aabc::$app->d->s => 'search', 
                        // Aabc::$app->d->ty => 'ra',
                        //Aabc::$app->d->i => Aabc::$app->_model->__chinhsach,
                        //'class' => 'mulr',      
                        // Aabc::$app->d->c => 'one',                        
                        //'id' => Aabc::$app->_model->__chinhsach.'_cs_recycle_select'
                    ]) ?>
</div>

<div class="col-md-12  pt4">
    <?= $form->field($model, Aabc::$app->_chinhsach->cs_ngaytao)->textInput(['placeholder' => '' ,'data-placement' => 'top', 'data-html' => 'true','data-trigger' => 'focus', 'data-toggle' => 'tooltip', 'title' => 'title']) ?>
</div>

<div class="col-md-12  pt4">
    <?= $form->field($model, Aabc::$app->_chinhsach->cs_ngaybatdau)->textInput(['placeholder' => '' ,'data-placement' => 'top', 'data-html' => 'true','data-trigger' => 'focus', 'data-toggle' => 'tooltip', 'title' => 'title']) ?>
</div>

<div class="col-md-12  pt4">
    <?= $form->field($model, Aabc::$app->_chinhsach->cs_ngayketthuc)->textInput(['placeholder' => '' ,'data-placement' => 'top', 'data-html' => 'true','data-trigger' => 'focus', 'data-toggle' => 'tooltip', 'title' => 'title']) ?>
</div>


    </div>

    <div class="form-group right">
        <button <?= Aabc::$app->d->i?> = <?= Aabc::$app->_model->__chinhsach ?> type="submit" class="btn btn-default haserror lvt"><span class="glyphicon glyphicon-floppy-disk mxanh"></span>Lưu và Thêm</button>

        <button type="submit" class="btn btn-default haserror"><span class="glyphicon glyphicon-floppy-disk mxanh"></span>Lưu</button>

        <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-ban-circle mdo"></span>Đóng</button>
    </div>




    <?php ActiveForm::end(); ?>

</div>



<script type="text/javascript">  

  

    $('.modal-content #<?=Aabc::$app->_model->__chinhsach?>-form').on('keyup keypress', function(e) {
      var keyCode = e.keyCode || e.which;
      if (keyCode === 13) { 
        e.preventDefault();
        return false;
      }
    });


$('form#<?=Aabc::$app->_model->__chinhsach?>-form').on('beforeSubmit', function(e) {
    loadimg();
    var form = $(this);
    var formData = form.serialize();
    $.ajax({
        url: form.attr("action"),
        type: form.attr("method"),
        data: formData,
        success: function (data) {
            reload('<?=Aabc::$app->_model->__chinhsach?>');  
            
            //update element
            // pjelm('<?=Aabc::$app->_model->__chinhsach?>');  

            if(data == 1){ 
                popthanhcong('','#<?php  if(isset($_POST['modal'])) echo $_POST['modal']?>');
            }else{
                popthatbai('');
            }            
            // lvtok('<?=Aabc::$app->_model->__chinhsach?>');
        },
        error: function () {
            reload('<?=Aabc::$app->_model->__chinhsach?>');
            poploi();
        }
    });
}).on('submit', function(e){
    e.preventDefault();
});
</script>