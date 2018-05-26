<?php

use aabc\helpers\Html;
use aabc\widgets\ActiveForm;

use aabc\helpers\ArrayHelper;
/* @var $this aabc\web\View */
//use backend\models\Danhmuc;
/* @var $form aabc\widgets\ActiveForm */
?>

<div class="<?=Aabc::$app->_model->__danhmuc?>-form">

    <?php $form = ActiveForm::begin(
        [
            'id' => Aabc::$app->_model->__danhmuc.'-form',
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
      


<div class="col-md-12 pt25">
    <?= $form->field($model, Aabc::$app->_danhmuc->dm_ten)->textInput(['maxlength' => true,'data-placement' => 'right','data-trigger' => 'focus', 'data-toggle' => 'tooltip', 'title' => 'title']) ?>
    <!-- ->label('My superb label') -->
</div>

<div class="col-md-12 pt25">
    <?php //echo $form->field($model, Aabc::$app->_danhmuc->dm_idcha)->textInput(['data-placement' => 'right','data-trigger' => 'focus', 'data-toggle' => 'tooltip', 'title' => 'title']) ?>

    <?php 
    $_Danhmuc = Aabc::$app->_model->Danhmuc;
    $idcha = $_Danhmuc::getAll1_3();                    
    array_unshift($idcha,[
        Aabc::$app->_danhmuc->dm_id => '',
        Aabc::$app->_danhmuc->dm_char =>'---Chọn---',
    ]);//Thêm vào đầu

    echo $form->field($model, Aabc::$app->_danhmuc->dm_idcha)->dropDownList(ArrayHelper::map($idcha, Aabc::$app->_danhmuc->dm_id, Aabc::$app->_danhmuc->dm_char),[
            //'multiple'=>'multiple', 
            // Aabc::$app->d->s => 'search', 
            Aabc::$app->d->ty => 'ra',
            Aabc::$app->d->i => Aabc::$app->_model->__danhmuc,
            Aabc::$app->d->c => 'one',
            Aabc::$app->d->t => 'sea',
            // Aabc::$app->d->add => '/',
            //d-add chỉ cần cho d-u, còn d-i của url sẽ được lấy ở fk- bên dưới

            'class' => 'mulr',                        
            'id' => Aabc::$app->_model->__danhmuc.'-'.Aabc::$app->_danhmuc->dm_idcha
            // 'id' => 'fk-'.Aabc::$app->_model->__danhmuc
        ]); 
    ?>
</div>






<div class="col-md-12 pt25">
    <?= $form->field($model, Aabc::$app->_danhmuc->dm_icon)->textInput(['maxlength' => true,'data-placement' => 'right','data-trigger' => 'focus', 'data-toggle' => 'tooltip', 'title' => 'title']) ?>
</div>

<div class="col-md-12 pt25">
    <?= $form->field($model, Aabc::$app->_danhmuc->dm_background)->textInput(['maxlength' => true,'data-placement' => 'right','data-trigger' => 'focus', 'data-toggle' => 'tooltip', 'title' => 'title']) ?>
</div>

<div class="col-md-12 pt25">
    <?= $form->field($model, Aabc::$app->_danhmuc->dm_link)->textInput(['maxlength' => true,'data-placement' => 'right','data-trigger' => 'focus', 'data-toggle' => 'tooltip', 'title' => 'title']) ?>
</div>


<div class="col-md-12 pt25">
    <?= $form->field($model, Aabc::$app->_danhmuc->dm_ghichu)->textInput(['maxlength' => true,'data-placement' => 'right','data-trigger' => 'focus', 'data-toggle' => 'tooltip', 'title' => 'title']) ?>
</div>

<div class="col-md-12 pt25">
    <?php 
        if($model[Aabc::$app->_danhmuc->dm_status] == NULL) $model[Aabc::$app->_danhmuc->dm_status] = 1;
    ?>
    <?= $form->field($model, Aabc::$app->_danhmuc->dm_status)->dropDownList([ '' => '--Chọn--', 1 => 'Hiển thị', 2 => 'Ẩn', ],['data-placement' => 'right','data-trigger' => 'focus','data-html' => 'true', 'data-toggle' => 'tooltip','title' => 'title',
                        //'multiple'=>'multiple', 
                        // Aabc::$app->d->s => 'search', 
                        Aabc::$app->d->ty => 'ra',
                        Aabc::$app->d->i => Aabc::$app->_model->__danhmuc,
                        'class' => 'mulr',      
                        Aabc::$app->d->c => 'one',                        
                        'id' => Aabc::$app->_model->__danhmuc.'_dm_status_select'
                    ]) ?>
</div>


<div class="col-md-12 pt25">
    <?= $form->field($model, Aabc::$app->_danhmuc->dm_groupmenu)->dropDownList([ '' => '--Chọn--', 1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5', 6 => '6', 7 => '7', 8 => '8', 9 => '9', 10 => '10', ],['data-placement' => 'right','data-trigger' => 'focus','data-html' => 'true', 'data-toggle' => 'tooltip','title' => 'title',
                        //'multiple'=>'multiple', 
                        // Aabc::$app->d->s => 'search', 
                        Aabc::$app->d->ty => 'ra',
                        Aabc::$app->d->i => Aabc::$app->_model->__danhmuc,
                        'class' => 'mulr',      
                        Aabc::$app->d->c => 'one',                        
                        'id' => Aabc::$app->_model->__danhmuc.'_dm_groupmenu_select'
                    ]) ?>
</div>


    </div>

    <div class="form-group right"> 
       <button <?= Aabc::$app->d->i?>=<?=Aabc::$app->_model->__danhmuc?> type="submit" class="btn btn-default haserror lvt"><span class="glyphicon glyphicon-floppy-disk mxanh"></span>Lưu và Thêm</button>

       <button type="submit" class="btn btn-default haserror"><span class="glyphicon glyphicon-floppy-disk mxanh"></span>Lưu</button>

        <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-ban-circle mdo"></span>Đóng</button>
    </div>




    <?php ActiveForm::end(); ?>

</div>



<script type="text/javascript">  

  

    $('.modal-content #<?=Aabc::$app->_model->__danhmuc?>-form').on('keyup keypress', function(e) {
      var keyCode = e.keyCode || e.which;
      if (keyCode === 13) { 
        e.preventDefault();
        return false;
      }
    });


$('form#<?=Aabc::$app->_model->__danhmuc?>-form').on('beforeSubmit', function(e) {
    // console.log($(this));
    loadimg();
    var form = $(this);
    var formData = form.serialize();
    $.ajax({
        url: form.attr("action"),
        type: form.attr("method"),
        data: formData,
        success: function (data) {
            reload('<?=Aabc::$app->_model->__danhmuc?>');   
            pjelm('<?=Aabc::$app->_model->__danhmuc?>','_dm');

            if(data == 1){ 
                popthanhcong('','#<?php  if(isset($_POST['modal'])) echo $_POST['modal']?>');
            }else{
                popthatbai('');
            }  

            lvtok('<?=Aabc::$app->_model->__danhmuc?>');
        },
        error: function () {
            reload('<?=Aabc::$app->_model->__danhmuc?>');
            poploi();
        }
    });
}).on('submit', function(e){
    e.preventDefault();
});
</script>