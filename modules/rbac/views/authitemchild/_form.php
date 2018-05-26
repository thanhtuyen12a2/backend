<?php

use aabc\helpers\Html;
use aabc\widgets\ActiveForm;


use backend\modules\rbac\models\Authitem;
// use backend\modules\rbac\models\Authitemchild;
use aabc\helpers\ArrayHelper;
// use aabc\db\ActiveQuery;
/* @var $this aabc\web\View */
/* @var $model backend\modules\rbac\models\Authitemchild */
/* @var $form aabc\widgets\ActiveForm */
?>

<div class="authitemchild-form">

    <?php $form = ActiveForm::begin(['options' => ['id' => 'authitemchild-form']]); ?>

   
    <?= 
        $form->field($model, 'parent')->dropDownList(
            ArrayHelper::map(Authitem::find()->andWhere(['type' => '1'])->all(),'name','name'),
            [
                'class'=>'form-control',
                'prompt' => '---Parent---'
            ]

        )
    ?>

     <?=   
        // $form->field($model, 'child')->dropDownList(
        //     ArrayHelper::map(Authitem::find()->andWhere(['<>','type', '1'])->andWhere(['not in','name', (Authitemchild::find()->select(['child'])->andWhere(['parent' => 'admin'])) ])->all()   ,'name','name'),
        //     [
        //         'class'=>'form-control',
        //         'prompt' => '---Child---'
        //     ]
        // )

         $form->field($model, 'child')->dropDownList(
            ArrayHelper::map(Authitem::find()->andWhere(['<>','type', '1'])->all()   ,'name','name'),
            [
                'class'=>'form-control',
                'prompt' => '---Child---'
            ]
        )
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>



<script type="text/javascript">  

    $('#modal #authitemchild-form').on('keyup keypress', function(e) {
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
                $.pjax.reload({container:'#pjauthitemchild'});
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