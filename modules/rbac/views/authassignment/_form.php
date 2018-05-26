<?php


use aabc\helpers\Html;
use aabc\widgets\ActiveForm;


use backend\modules\rbac\models\Authitem;
use backend\models\User;
use aabc\helpers\ArrayHelper;
/* @var $this aabc\web\View */
/* @var $model backend\modules\rbac\models\Authassignment */
/* @var $form aabc\widgets\ActiveForm */
?>

<div class="authassignment-form">

    <?php $form = ActiveForm::begin(['options' => ['id' => 'authassignment-form']]); ?>

    <?= $form->field($model, 'item_name')->dropDownList(
        ArrayHelper::map(Authitem::find()->andWhere(['type' => '1'])->all(), 'name', 'name'
            ),
        [
            'class' => 'form-control',
            'prompt' => '------'
        ]
        )
    ?>

     <?= $form->field($model, 'user_id')->dropDownList(
        ArrayHelper::map(User::find()->all(), 'id', 'username'
            ),
        [
            'class' => 'form-control',
            'prompt' => '------'
        ]
        )
    ?>




    <?= $form->field($model, 'created_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>



<script type="text/javascript">  

    $('#modal #authassignment-form').on('keyup keypress', function(e) {
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
                $.pjax.reload({container:'#pjauthassignment'});
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