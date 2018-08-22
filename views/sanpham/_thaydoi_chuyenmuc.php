<?php
use backend\models\Sanpham;

use aabc\helpers\Html;
use aabc\widgets\ActiveForm;
use aabc\bootstrap\Modal; 
use aabc\helpers\ArrayHelper;


$_Sanpham = Aabc::$app->_model->Sanpham;
$_Chinhsach  = Aabc::$app->_model->Chinhsach;
$_Danhmuc  = Aabc::$app->_model->Danhmuc;

$this->title = 'Thay đổi Chuyên mục';

?>


<script type="text/javascript">    
$.fn.modal.Constructor.prototype.enforceFocus = function() {
  modal_this = this
  $(document).on('focusin.modal', function (e) {
    if (modal_this.$element[0] !== e.target && !modal_this.$element.has(e.target).length 
    && !$(e.target.parentNode).hasClass('cke_dialog_ui_input_select') 
    && !$(e.target.parentNode).hasClass('cke_dialog_ui_input_text')) {
      modal_this.$element.focus()
    }
  })
};
</script>



<div class="<?=Sanpham::tt?>-form">    
    <h1><?= Html::encode($this->title) ?></h1>

 <?php $form = ActiveForm::begin([
        'id' => Sanpham::tt.'-form',
    ]);
?>
  
  <script type="text/javascript">
      $('[data-toggle="tooltip"]').tooltip();
  </script>

    <div>
        <div class="row">             
            <div>
            <fieldset style="margin: 10px 0 0 0" class="ht htweb">
            
            <p style="font-size: 12px;"><i>Chọn các <b>Chuyên mục</b> bạn muốn thay đổi cho các <b>Bài viết</b> được chọn</i></p>

            <style type="text/css">
                .ri{width: 100%;}
            </style>
          
            <div class="col-xs-12" style="margin: 10px 0 0 0;">
                <?php     
                    $_Danhmuc  = Aabc::$app->_model->Danhmuc;                
                    $danhmuc = $_Danhmuc::getAll1_2();                    
                    array_unshift($danhmuc,[
                        Aabc::$app->_danhmuc->dm_id => '',
                        Aabc::$app->_danhmuc->dm_char =>'---Chọn---',
                    ]);//Thêm vào đầu
                    echo $form->field($model, Sanpham::sp_id_danhmuc,['options' => ['class' => '']])->dropDownList(ArrayHelper::map($danhmuc,Aabc::$app->_danhmuc->dm_id,Aabc::$app->_danhmuc->dm_char),[
                            
                            'multiple'=>'multiple',
                            Aabc::$app->d->ty => 'checkbox',
                            
                            // Aabc::$app->d->ty => 'ra',
                            // Aabc::$app->d->c => 'one',
                        //    Aabc::$app->d->add => 'ip_cm',
                            // d-add chỉ cần cho d-u, còn d-i của url sẽ được lấy ở fk- bên dưới

                            Aabc::$app->d->i => Sanpham::tt,
                            Aabc::$app->d->t => 'sea',//Search
                            'class' => 'mulr',                        
                            // 'id' => Sanpham::tt.'-sp_id_thuonghieu'
                            'id' => 'fk-'.Aabc::$app->_model->__danhmuc.'-cm'
                        ])->label(false); 
                ?>
            </div>
           
            </fieldset>   
            </div>
        </div>
    </div>
        


    <div class="form-group right">
        
        <button type="submit" class="btn btn-default haserror"><span class="glyphicon glyphicon-floppy-disk mxanh"></span>Lưu</button>

        <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-ban-circle mdo"></span>Đóng</button>
    </div>

    <?php ActiveForm::end(); ?>

</div>



<script type="text/javascript">

$('form#<?=Sanpham::tt?>-form').on('beforeSubmit', function(e) {
    $(this).find('button[type=submit]').attr('disabled','disabled');
    loadimg();
    var form = $(this);
    var formData = form.serialize();
    $.ajax({
        url: form.attr("action"),
        type: form.attr("method"),
        data: formData,
        success: function (data) {
            if(data == 1){
                reload('<?= Sanpham::tt ?>')
                popthanhcong('','#modal3');
                lvtok('<?=Sanpham::tt?>'); 
            }else{                
                reload('<?=Sanpham::tt?>');
                popthatbai('');
            }                
        },
        error: function () {
            // $(this).find('button[type=submit]').addClass('active');
            poploi();                
        }
    });
}).on('submit', function(e){
    $(this).find('button[type=submit]').attr('disabled','disabled');
    e.preventDefault();
});


</script>



