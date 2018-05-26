<?php

use aabc\helpers\Html;
use aabc\widgets\ActiveForm;

/* @var $this aabc\web\View */
//use backend\models\Image;
/* @var $form aabc\widgets\ActiveForm */
?>

<div class="<?=Aabc::$app->_model->__image?>-formpop">

    <?php $form = ActiveForm::begin(
        [
            'id' => Aabc::$app->_model->__image.'-formpop',
            // 'options' => ['enctype' => 'multipart/form-data'],
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
      

    <div class="pt2">         
        <?= $form->field($model, 'image_tenfilemoi',['options' => ['class' => 'col-md-12']])->textInput(['maxlength' => true,'data-placement' => 'top','data-html' => 'true','data-trigger' => 'focus', 'data-toggle' => 'tooltip', 'title' => 'Đổi tên file giúp hỗ trợ cho SEO. <br/> Ví dụ đặt tên file là: san-pham-abc, không nên để dạng: IMG_1234. <br/> Hướng dẫn: Nhập tên tiếng việt như bình thường ở đây, tên file mới sẽ được tạo tự động ở dưới.<br/> Việc thay tên này được tự động cập nhật cho các ảnh trong các bài viết, vì vậy bạn không cần phải sửa trong đó.']) ?>
    </div>

    <div class="pt2">         
        <?= $form->field($model, Aabc::$app->_image->image_tenfile,['options' => ['class' => 'col-md-12']])->textInput(['maxlength' => true, 'readonly' => 'true']) ?>
    </div> 

    <?php
        // echo '<pre>';
        // print_r($data);
        if(isset($data)){
            foreach ($data as $key => $value) {
                echo '<input type="hidden" name="selectsimg[]" value="'.$value.'" />';
            }
        }
    ?>

</div>
    <div class="form-group right">       
       <button type="submit" class="btn btn-default haserror"><span class="glyphicon glyphicon-floppy-disk mxanh"></span>Lưu</button>
        <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-ban-circle mdo"></span>Đóng</button>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<script type="text/javascript">  
     
     $('#<?=Aabc::$app->_model->__image?>-image_tenfilemoi').on('keyup keypress',function(){
        $('#<?=Aabc::$app->_model->__image?>-<?=Aabc::$app->_image->image_tenfile?>').val(urlfriendly($(this).val()));        
    })


    $('.modal-content #<?=Aabc::$app->_model->__image?>-formpop').on('keyup keypress', function(e) {
      var keyCode = e.keyCode || e.which;
      if (keyCode === 13) { 
        e.preventDefault();
        return false;
      }
    });


$('form#<?=Aabc::$app->_model->__image?>-formpop').on('beforeSubmit', function(e) {
    loadimg();
    var form = $(this);
    var formData = form.serialize();
    $.ajax({
        url: form.attr("action"),
        type: form.attr("method"),
        data: formData,
        success: function (data) {
            reload('<?=Aabc::$app->_model->__image?>');          

            if(data == 1){ 
                popthanhcong('','#<?php  if(isset($_POST['modal'])) echo $_POST['modal']?>');
            }else{
                popthatbai('');
            }
        },
        error: function () {
            reload('<?=Aabc::$app->_model->__image?>');
            poploi();
        }
    });
}).on('submit', function(e){
    e.preventDefault();
});
</script>