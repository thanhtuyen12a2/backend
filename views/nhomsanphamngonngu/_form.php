<?php

use aabc\helpers\Html;
use aabc\widgets\ActiveForm;

/* @var $this aabc\web\View */
/* @var $model backend\models\Nhomsanphamngonngu */
/* @var $form aabc\widgets\ActiveForm */
?>

<div class="nhomsanphamngonngu-form">

    <?php $form = ActiveForm::begin(['options' => ['id' => 'nhomsanphamngonngu-form']]); ?>

    <?= $form->field($model, 'nspnn_idngonngu')->textInput() ?>

    <?= $form->field($model, 'nspnn_idnhomsanpham')->textInput() ?>

    <?= $form->field($model, 'nspnn_ten')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nspnn_motangan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nspnn_tieudeseo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nspnn_motaseo')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>



<script type="text/javascript">  

    $('#modal #nhomsanphamngonngu-form').on('keyup keypress', function(e) {
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
                $.pjax.reload({container:'#pjnhomsanphamngonngu'});
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