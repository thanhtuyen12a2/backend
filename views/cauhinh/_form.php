<?php

use aabc\helpers\Html;
use aabc\widgets\ActiveForm;

/* @var $this aabc\web\View */
//use backend\models\Cauhinh;
/* @var $form aabc\widgets\ActiveForm */
?>

<div class="<?=Aabc::$app->_model->__cauhinh?>-form">

    <?php $form = ActiveForm::begin(
        [
            'id' => Aabc::$app->_model->__cauhinh.'-form',
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
      


<div class="col-md-12  pt100">
    <?= $form->field($model, Aabc::$app->_cauhinh->ch_id)->textInput(['placeholder' => '' ,'maxlength' => true]) ?>
<i class="hdtip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="- Title." aria-invalid="false"></i>
</div>

<div class="col-md-12  pt100">
    <?= $form->field($model, Aabc::$app->_cauhinh->ch_key)->textInput(['placeholder' => '' ,'maxlength' => true]) ?>
<i class="hdtip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="- Title." aria-invalid="false"></i>
</div>

<div class="col-md-12  pt100">
    <?= $form->field($model, Aabc::$app->_cauhinh->ch_data)->textarea(['rows' => 6]) ?>
<i class="hdtip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="- Title." aria-invalid="false"></i>
</div>


    </div>

    <div class="form-group right">
        <button <?= Aabc::$app->d->i?> = <?= Aabc::$app->_model->__cauhinh ?> type="submit" class="btn btn-default haserror lvt"><span class="glyphicon glyphicon-floppy-disk mxanh"></span>Lưu và Thêm</button>

        <button type="submit" class="btn btn-default haserror"><span class="glyphicon glyphicon-floppy-disk mxanh"></span>Lưu</button>

        <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-ban-circle mdo"></span>Đóng</button>
    </div>




    <?php ActiveForm::end(); ?>

</div>



<script type="text/javascript">  

  

    $('.modal-content #<?=Aabc::$app->_model->__cauhinh?>-form').on('keyup keypress', function(e) {
      var keyCode = e.keyCode || e.which;
      if (keyCode === 13) { 
        e.preventDefault();
        return false;
      }
    });


$('form#<?=Aabc::$app->_model->__cauhinh?>-form').on('beforeSubmit', function(e) {
    loadimg();
    var form = $(this);
    var formData = form.serialize();
    $.ajax({
        url: form.attr("action"),
        type: form.attr("method"),
        data: formData,
        success: function (data) {
            reload('<?=Aabc::$app->_model->__cauhinh?>');  
            
            //update element
            // pjelm('<?=Aabc::$app->_model->__cauhinh?>');  

            if(data == 1){ 
                popthanhcong('','#<?php  if(isset($_POST['modal'])) echo $_POST['modal']?>');
            }else{
                popthatbai('');
            }            
            // lvtok('<?=Aabc::$app->_model->__cauhinh?>');
        },
        error: function () {
            reload('<?=Aabc::$app->_model->__cauhinh?>');
            poploi();
        }
    });
}).on('submit', function(e){
    e.preventDefault();
});
</script>