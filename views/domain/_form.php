<?php

use aabc\helpers\Html;
use aabc\widgets\ActiveForm;

/* @var $this aabc\web\View */
use backend\models\Domain;
/* @var $form aabc\widgets\ActiveForm */
?>

<div class="domain-form">

    <?php $form = ActiveForm::begin(
        [
            'id' => 'domain-form',
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
    <?= $form->field($model, Aabc::$app->domain->dm_domain,['options' => ['class' => 'col-md-12']])->textInput(['maxlength' => true,'data-placement' => 'top','data-trigger' => 'focus', 'data-toggle' => 'tooltip', 'title' => 'Domain']) ?>
</div>
 
<div class="pt2">
    <?= $form->field($model, Aabc::$app->domain->dm_chude,['options' => ['class' => 'col-md-12']])->textInput(['maxlength' => true,'data-placement' => 'top','data-trigger' => 'focus', 'data-toggle' => 'tooltip', 'title' => 'Chủ đề của trang']) ?>
</div>


<div class="pt2">
    <?= $form->field($model, Aabc::$app->domain->dm_email,['options' => ['class' => 'col-md-12']])->textInput(['maxlength' => true,'data-placement' => 'top','data-trigger' => 'focus', 'data-toggle' => 'tooltip', 'title' => 'Email']) ?>
</div>


<div class="pt2">
    <?= $form->field($model, Aabc::$app->domain->dm_status,['options' => ['class' => 'col-md-12']])->dropDownList([ '' => '--Chọn--', 1 => Aabc::$app->domain->dm_status_1, 2 => Aabc::$app->domain->dm_status_2, 8 => Aabc::$app->domain->dm_status_8, 3 => Aabc::$app->domain->dm_status_3,6 => Aabc::$app->domain->dm_status_6 , 4 => Aabc::$app->domain->dm_status_4 , 5 => Aabc::$app->domain->dm_status_5 ,  7 => Aabc::$app->domain->dm_status_7 , ],['data-placement' => 'top','data-trigger' => 'focus','data-html' => 'true', 'data-toggle' => 'tooltip','title' => 'Tình trạng của site',
                        //'multiple'=>'multiple', 
                        // Aabc::$app->d->s => 'search', 
                        Aabc::$app->d->ty => 'ra',
                        Aabc::$app->d->i => 'domain',
                        'class' => 'mulr',   
                        Aabc::$app->d->t => 'sea',   
                        Aabc::$app->d->c => 'one',                        
                        'id' => 'domain_dm_status_select'
                    ]) ?>
</div>


<div class="pt2">
    <?= $form->field($model, Aabc::$app->domain->dm_tiemnang,['options' => ['class' => 'col-md-12']])->dropDownList([ '' => '--Chọn--', 2 => 'Responsive', 1 => 'None'],['data-placement' => 'top','data-trigger' => 'focus','data-html' => 'true', 'data-toggle' => 'tooltip','title' => 'Tương thích với nhiều kích thước màn hình',
                        //'multiple'=>'multiple', 
                        // 'd-s' => 'search', 
                        Aabc::$app->d->ty => 'ra',
                        Aabc::$app->d->i => 'domain',
                        'class' => 'mulr',      
                        Aabc::$app->d->c => 'one',                        
                        'id' => 'domain_dm_tiemnang_select'
                    ]) ?>
</div>


<div class="pt2">
    <?= $form->field($model, Aabc::$app->domain->dm_length,['options' => ['class' => 'col-md-12']])->textInput(['maxlength' => true,'data-placement' => 'top','data-trigger' => 'focus', 'data-toggle' => 'tooltip', 'title' => 'Độ dài nội dung']) ?>
</div>


<div class="pt2">
    <?= $form->field($model, Aabc::$app->domain->dm_timedownload,['options' => ['class' => 'col-md-12']])->textInput(['maxlength' => true,'data-placement' => 'top','data-trigger' => 'focus', 'data-toggle' => 'tooltip', 'title' => 'Thời gian tải']) ?>
</div>



    </div>

    <div class="form-group right">
       
       <button type="submit" class="btn btn-default haserror"><span class="glyphicon glyphicon-floppy-disk mxanh"></span>Lưu</button>

        <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-ban-circle mdo"></span>Đóng</button>
    </div>




    <?php ActiveForm::end(); ?>

</div>



<script type="text/javascript">  

     

    $('.modal-content #domain-form').on('keyup keypress', function(e) {
      var keyCode = e.keyCode || e.which;
      if (keyCode === 13) { 
        e.preventDefault();
        return false;
      }
    });


$('form#domain-form').on('beforeSubmit', function(e) {
    loadimg();
    var form = $(this);
    var formData = form.serialize();
    $.ajax({
        url: form.attr("action"),
        type: form.attr("method"),
        data: formData,
        success: function (data) {
            reload('domain');
            
            if(data == 1){ 
                popthanhcong('','#<?php  if(isset($_POST['modal'])) echo $_POST['modal']?>');
            }else{
                popthatbai('');
            }
        },
        error: function () {
            reload('domain');
            poploi();
        }
    });
}).on('submit', function(e){
    e.preventDefault();
});
</script>