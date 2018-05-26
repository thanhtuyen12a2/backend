<?php

use aabc\helpers\Html;
use aabc\widgets\ActiveForm;

/* @var $this aabc\web\View */
/* @var $model backend\models\Ngonngu */
/* @var $form aabc\widgets\ActiveForm */
?>

<div class="ngonngu-form">

    <?php $form = ActiveForm::begin(['options' => ['id' => 'ngonngu-form']]); ?> 

    <?= $form->field($model, 'ngonngu_ten')->textInput(['maxlength' => true]) ?>


    <?php 
    if(Aabc::$app->user->can('backend-ngonngu-create')){
        echo $form->field($model, 'ngonngu_code')->textInput(['maxlength' => true]);
    }
    ?>

    <?= $form->field($model, 'ngonngu_trangthai')->dropDownList([ '0', '1', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'ngonngu_macdinh')->dropDownList([ 1 => '1', 0 => '0', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>  

    <?php ActiveForm::end(); ?>

</div>



<script type="text/javascript">  

    $('#modal #ngonngu-form').on('keyup keypress', function(e) {
      var keyCode = e.keyCode || e.which;
      if (keyCode === 13) { 
        e.preventDefault();
        return false;
      }
    });


$('form').on('beforeSubmit', function(e) {
    loadimg();
    var form = $(this);
    var formData = form.serialize();
    $.ajax({
        url: form.attr("action"),
        type: form.attr("method"),
        data: formData,
        success: function (data) {
            if(data == 'thanhcong'){                  
                $.pjax.reload({container:'#pjngonngu'});                
                
                popthanhcong('','#<?php echo $_POST['modal']?>');
            }
            if(data == 'thatbai'){
                popthatbai('');
            }
        },
        error: function () {
            poploi();
        }
    });
}).on('submit', function(e){
    e.preventDefault();
});
</script>