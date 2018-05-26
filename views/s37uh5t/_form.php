<?php

use aabc\helpers\Html;
use aabc\widgets\ActiveForm;

/* @var $this aabc\web\View */
//use backend\models\Sanpham3;
/* @var $form aabc\widgets\ActiveForm */
?>

<div class="<?=Aabc::$app->_model->__sanpham3?>-form">

    <?php $form = ActiveForm::begin(
        [
            'id' => Aabc::$app->_model->__sanpham3.'-form',
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
      


<div class="pt4">
    <?= $form->field($model, Aabc::$app->_sanpham3->sp_tensp,['options' => ['class' => 'col-md-12']])->textInput(['maxlength' => true,'data-placement' => 'right','data-trigger' => 'focus', 'data-toggle' => 'tooltip', 'title' => 'title']) ?>
</div>

<div class="pt4">
    <?= $form->field($model, Aabc::$app->_sanpham3->sp_masp,['options' => ['class' => 'col-md-12']])->textInput(['maxlength' => true,'data-placement' => 'right','data-trigger' => 'focus', 'data-toggle' => 'tooltip', 'title' => 'title']) ?>
</div>

<div class="pt4">
    <?= $form->field($model, Aabc::$app->_sanpham3->sp_linkseo,['options' => ['class' => 'col-md-12']])->textInput(['maxlength' => true,'data-placement' => 'right','data-trigger' => 'focus', 'data-toggle' => 'tooltip', 'title' => 'title']) ?>
</div>

<div class="pt4">
    <?= $form->field($model, Aabc::$app->_sanpham3->sp_linkanhdaidien,['options' => ['class' => 'col-md-12']])->textInput(['maxlength' => true,'data-placement' => 'right','data-trigger' => 'focus', 'data-toggle' => 'tooltip', 'title' => 'title']) ?>
</div>

<div class="pt4">
    <?= $form->field($model, Aabc::$app->_sanpham3->sp_images,['options' => ['class' => 'col-md-12']])->textarea(['rows' => 6]) ?>
</div>

<div class="pt4">
    <?= $form->field($model, Aabc::$app->_sanpham3->sp_status,['options' => ['class' => 'col-md-12']])->dropDownList([ '' => '--Chọn--', 2 => '2', 1 => '1', ],['data-placement' => 'right','data-trigger' => 'focus','data-html' => 'true', 'data-toggle' => 'tooltip','title' => 'title',
                        //'multiple'=>'multiple', 
                        // Aabc::$app->d->s => 'search', 
                        // Aabc::$app->d->ty => 'ra',
                        //Aabc::$app->d->i => Aabc::$app->_model->__sanpham3,
                        //'class' => 'mulr',      
                        // Aabc::$app->d->c => 'one',                        
                        //'id' => Aabc::$app->_model->__sanpham3.'_sp_status_select'
                    ]) ?>
</div>

<div class="pt4">
    <?= $form->field($model, Aabc::$app->_sanpham3->sp_recycle,['options' => ['class' => 'col-md-12']])->dropDownList([ '' => '--Chọn--', 2 => '2', 1 => '1', ],['data-placement' => 'right','data-trigger' => 'focus','data-html' => 'true', 'data-toggle' => 'tooltip','title' => 'title',
                        //'multiple'=>'multiple', 
                        // Aabc::$app->d->s => 'search', 
                        // Aabc::$app->d->ty => 'ra',
                        //Aabc::$app->d->i => Aabc::$app->_model->__sanpham3,
                        //'class' => 'mulr',      
                        // Aabc::$app->d->c => 'one',                        
                        //'id' => Aabc::$app->_model->__sanpham3.'_sp_recycle_select'
                    ]) ?>
</div>

<div class="pt4">
    <?= $form->field($model, Aabc::$app->_sanpham3->sp_conhang,['options' => ['class' => 'col-md-12']])->dropDownList([ '' => '--Chọn--', 1 => '1', 2 => '2', 3 => '3', ],['data-placement' => 'right','data-trigger' => 'focus','data-html' => 'true', 'data-toggle' => 'tooltip','title' => 'title',
                        //'multiple'=>'multiple', 
                        // Aabc::$app->d->s => 'search', 
                        // Aabc::$app->d->ty => 'ra',
                        //Aabc::$app->d->i => Aabc::$app->_model->__sanpham3,
                        //'class' => 'mulr',      
                        // Aabc::$app->d->c => 'one',                        
                        //'id' => Aabc::$app->_model->__sanpham3.'_sp_conhang_select'
                    ]) ?>
</div>

<div class="pt4">
    <?= $form->field($model, Aabc::$app->_sanpham3->sp_view,['options' => ['class' => 'col-md-12']])->textInput(['maxlength' => true,'data-placement' => 'right','data-trigger' => 'focus', 'data-toggle' => 'tooltip', 'title' => 'title']) ?>
</div>

<div class="pt4">
    <?= $form->field($model, Aabc::$app->_sanpham3->sp_ngaytao,['options' => ['class' => 'col-md-12']])->textInput(['data-placement' => 'right','data-trigger' => 'focus', 'data-toggle' => 'tooltip', 'title' => 'title']) ?>
</div>

<div class="pt4">
    <?= $form->field($model, Aabc::$app->_sanpham3->sp_ngayupdate,['options' => ['class' => 'col-md-12']])->textInput(['data-placement' => 'right','data-trigger' => 'focus', 'data-toggle' => 'tooltip', 'title' => 'title']) ?>
</div>

<div class="pt4">
    <?= $form->field($model, Aabc::$app->_sanpham3->sp_idnguoitao,['options' => ['class' => 'col-md-12']])->textInput(['data-placement' => 'right','data-trigger' => 'focus', 'data-toggle' => 'tooltip', 'title' => 'title']) ?>
</div>

<div class="pt4">
    <?= $form->field($model, Aabc::$app->_sanpham3->sp_idnguoiupdate,['options' => ['class' => 'col-md-12']])->textInput(['data-placement' => 'right','data-trigger' => 'focus', 'data-toggle' => 'tooltip', 'title' => 'title']) ?>
</div>

<div class="pt4">
    <?= $form->field($model, Aabc::$app->_sanpham3->sp_id_ncc,['options' => ['class' => 'col-md-12']])->textInput(['data-placement' => 'right','data-trigger' => 'focus', 'data-toggle' => 'tooltip', 'title' => 'title']) ?>
</div>

<div class="pt4">
    <?= $form->field($model, Aabc::$app->_sanpham3->sp_id_thuonghieu,['options' => ['class' => 'col-md-12']])->textInput(['data-placement' => 'right','data-trigger' => 'focus', 'data-toggle' => 'tooltip', 'title' => 'title']) ?>
</div>

<div class="pt4">
    <?= $form->field($model, Aabc::$app->_sanpham3->sp_gia,['options' => ['class' => 'col-md-12']])->textInput(['maxlength' => true,'data-placement' => 'right','data-trigger' => 'focus', 'data-toggle' => 'tooltip', 'title' => 'title']) ?>
</div>

<div class="pt4">
    <?= $form->field($model, Aabc::$app->_sanpham3->sp_giakhuyenmai,['options' => ['class' => 'col-md-12']])->textInput(['maxlength' => true,'data-placement' => 'right','data-trigger' => 'focus', 'data-toggle' => 'tooltip', 'title' => 'title']) ?>
</div>

<div class="pt4">
    <?= $form->field($model, Aabc::$app->_sanpham3->sp_soluong,['options' => ['class' => 'col-md-12']])->textInput(['maxlength' => true,'data-placement' => 'right','data-trigger' => 'focus', 'data-toggle' => 'tooltip', 'title' => 'title']) ?>
</div>

<div class="pt4">
    <?= $form->field($model, Aabc::$app->_sanpham3->sp_soluongfake,['options' => ['class' => 'col-md-12']])->textInput(['maxlength' => true,'data-placement' => 'right','data-trigger' => 'focus', 'data-toggle' => 'tooltip', 'title' => 'title']) ?>
</div>

<div class="pt4">
    <?= $form->field($model, Aabc::$app->_sanpham3->sp_soluotmua,['options' => ['class' => 'col-md-12']])->textInput(['maxlength' => true,'data-placement' => 'right','data-trigger' => 'focus', 'data-toggle' => 'tooltip', 'title' => 'title']) ?>
</div>


    </div>

    <div class="form-group right">
       
       <button type="submit" class="btn btn-default haserror"><span class="glyphicon glyphicon-floppy-disk mxanh"></span>Lưu</button>

        <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-ban-circle mdo"></span>Đóng</button>
    </div>




    <?php ActiveForm::end(); ?>

</div>



<script type="text/javascript">  

  

    $('.modal-content #<?=Aabc::$app->_model->__sanpham3?>-form').on('keyup keypress', function(e) {
      var keyCode = e.keyCode || e.which;
      if (keyCode === 13) { 
        e.preventDefault();
        return false;
      }
    });


$('form#<?=Aabc::$app->_model->__sanpham3?>-form').on('beforeSubmit', function(e) {
    loadimg();
    var form = $(this);
    var formData = form.serialize();
    $.ajax({
        url: form.attr("action"),
        type: form.attr("method"),
        data: formData,
        success: function (data) {
            // reload('<?=Aabc::$app->_model->__sanpham3?>');
            
            if(data == 1){ 
                popthanhcong('','#<?php  if(isset($_POST['modal'])) echo $_POST['modal']?>');
            }else{
                popthatbai('');
            }
        },
        error: function () {
            reload('<?=Aabc::$app->_model->__sanpham3?>');
            poploi();
        }
    });
}).on('submit', function(e){
    e.preventDefault();
});
</script>