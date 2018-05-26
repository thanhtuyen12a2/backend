<?php

use aabc\helpers\Html;
use aabc\widgets\ActiveForm;

/* @var $this aabc\web\View */
use backend\models\Itemhelp; /* @var $form aabc\widgets\ActiveForm */
?>

<script src="/ckeditor/ckeditor.js"></script>

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


<div class="itemhelp-form">

    <?php $form = ActiveForm::begin(
        [
            'id' => 'itemhelp-form',
            // 'enableClientValidation' => false,
            // 'enableAjaxValidation' => true,
            //'validationUrl' => ['validate'],
            // 'validateOnBlur' => false,
            // 'validateOnChange' => false
            //'enableAjaxValidation' => true,
        ]
        );
     ?>
      <div>
      <div class="pt3">
        <?= $form->field($model, 'ih_ten',['options' => ['class' => 'col-md-6']])->textInput(['maxlength' => true]) ?>
           <?= $form->field($model, 'ih_action',['options' => ['class' => 'col-md-6']])->textInput(['maxlength' => true]) ?>        
    </div>

<div class="pt3"> 
   <?= $form->field($model, 'ih_check',['options' => ['class' => 'col-md-6']])->textInput(['maxlength' => true]) ?>
   <?= $form->field($model, 'ih_focus',['options' => ['class' => 'col-md-6']])->textInput(['maxlength' => true]) ?>
</div>


<div class="pt3">    
    <?= $form->field($model, 'ih_sothutu',['options' => ['class' => 'col-md-6']])->textInput() ?>
  <?= $form->field($model, 'ih_id_grouphelp',['options' => ['class' => 'col-md-6']])->textInput() ?>

</div>

<div class="pt15">   

<?php 
echo  $form->field($model, 'ih_noidung',['options' => ['class' => 'col-md-12']])->textarea(['rows' => '10']);

echo '<script>';
echo   'CKEDITOR.replace("itemhelp-ih_noidung");';
echo '</script>';


?>

</div>



    </div>
    <div class="form-group right">
       
       <button type="submit" class="btn btn-default haserror"><span class="glyphicon glyphicon-floppy-disk mxanh"></span>Lưu</button>

        <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-ban-circle mdo"></span>Đóng</button>
    </div>




    <?php ActiveForm::end(); ?>

</div>



<script type="text/javascript">  

     

    $('.modal-content #itemhelp-form').on('keyup keypress', function(e) {
      var keyCode = e.keyCode || e.which;
      if (keyCode === 13) { 
        e.preventDefault();
        return false;
      }
    });


$('form#itemhelp-form').on('beforeSubmit', function(e) {
    loadimg();
    var form = $(this);
    var formData = form.serialize();
    $.ajax({
        url: form.attr("action"),
        type: form.attr("method"),
        data: formData,
        success: function (data) {
            reload('itemhelp');
            
            if(data == 'thanhcong'){ 
                popthanhcong('','#<?php  if(isset($_POST['modal'])) echo $_POST['modal']?>');
            }
            if(data == 'thatbai'){
                popthatbai('');
            }
        },
        error: function () {
            reload('itemhelp');
            poploi();
        }
    });
}).on('submit', function(e){
    e.preventDefault();
});
</script>