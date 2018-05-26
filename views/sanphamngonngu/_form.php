<?php

use aabc\helpers\Html;
use aabc\widgets\ActiveForm;

/* @var $this aabc\web\View */
/* @var $model backend\models\Sanphamngonngu */
/* @var $form aabc\widgets\ActiveForm */
?>

<div class="sanphamngonngu-form">

    <?php $form = ActiveForm::begin(['options' => ['id' => 'sanphamngonngu-form']]); ?>

    <?= $form->field($model, 'spnn_idsanpham')->textInput() ?>

    <?= $form->field($model, 'spnn_idngonngu')->textInput() ?>

    <?= $form->field($model, 'spnn_ten')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'spnn_noidung')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'spnn_gioithieu')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'spnn_tieudeseo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'spnn_motaseo')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>



<script type="text/javascript">  

    $('#modal #sanphamngonngu-form').on('keyup keypress', function(e) {
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
                $.pjax.reload({container:'#pjsanphamngonngu'});
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