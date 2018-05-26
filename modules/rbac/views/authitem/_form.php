<?php

use aabc\helpers\Html;
use aabc\widgets\ActiveForm;

/* @var $this aabc\web\View */
/* @var $model backend\modules\rbac\models\Authitem */
/* @var $form aabc\widgets\ActiveForm */
?>

<div class="authitem-form">

    <?php $form = ActiveForm::begin(['options' => ['id' => 'authitem-form']]); ?>

    <?= $form->field($model, 'name',['options' => ['class' => 'pt2 col-md-12']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type',['options' => ['class' => 'pt2 col-md-12']])->textInput() ?>

   

    <div class="form-group right">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>



<script type="text/javascript">  

    $('#modal #authitem-form').on('keyup keypress', function(e) {
      var keyCode = e.keyCode || e.which;
      if (keyCode === 13) { 
        e.preventDefault();
        return false;
      }
    });


    $('form').on('beforeSubmit', function(e) {
    var form = $(this);
    var formData = form.serialize();
    $.ajax({
        url: form.attr("action"),
        type: form.attr("method"),
        data: formData,
        success: function (data) {
            if(data == 'thanhcong'){                  
                $.pjax.reload({container:'#pjauthitem'});
                $('#modalContent').html('<h5>Thành công</h5>');
                setTimeout(function() { $('#modal').modal('hide'); }, 800);
            }
            if(data == 'thatbai'){
                alert("Thất bại");
            }
        },
        error: function () {
            alert("Có lỗi xảy ra");
        }
    });
}).on('submit', function(e){
    e.preventDefault();
});
</script>