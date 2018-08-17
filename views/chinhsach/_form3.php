<?php

use aabc\helpers\Html;
use aabc\widgets\ActiveForm;
use aabc\helpers\ArrayHelper;
/* @var $this aabc\web\View */
//use backend\models\Chinhsach;
/* @var $form aabc\widgets\ActiveForm */
?>

<div class="<?=Aabc::$app->_model->__chinhsach?>-form">

    <?php $form = ActiveForm::begin(
        [
            'id' => Aabc::$app->_model->__chinhsach.'-form',
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
      
      
<div class="clearfix" style="background: #FFF;padding: 20px 10px;">


<div class="col-md-12  pt100">
    <?= $form->field($model, Html::encode(Aabc::$app->_chinhsach->cs_ten))->textArea(['placeholder' => 'VD: Giao hàng miễn phí nội thành' ,'maxlength' => true])->label('Chính sách giao hàng') ?>

    <i class="hdtip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="- Tên chương trình khuyến mại tặng kèm." aria-invalid="false"></i>
</div>



<div class="col-md-12  pt100">
    <?= $form->field($model, Html::encode(Aabc::$app->_chinhsach->cs_ghichu))->textArea(['placeholder' => '' ,'maxlength' => true]) ?>

    <i class="hdtip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="- Ghi chú chi tiết về chương trình khuyến mại tặng kèm." aria-invalid="false"></i>
</div>



<div class="col-md-12  pt100">
    <?= $form->field($model, Aabc::$app->_chinhsach->cs_apdungcho)->dropDownList([ 1 => 'Tất cả sản phẩm', 2 => 'Danh mục sản phẩm (cụ thể)', 3 => 'Từng Sản phẩm (cụ thể)'],['placeholder' => '',
        //'multiple'=>'multiple', 
        // Aabc::$app->d->s => 'search', 
        Aabc::$app->d->t => 'show', 
        Aabc::$app->d->ty => 'ra',
        Aabc::$app->d->i => Aabc::$app->_model->__chinhsach,
        'class' => 'mulr',      
        Aabc::$app->d->c => 'one',                        
        'id' => Aabc::$app->_model->__chinhsach.'_'.Aabc::$app->_chinhsach->cs_apdungcho.'_select'
    ]) ?>

    <i class="hdtip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="- Tất cả: Chương trình áp dụng cho tất cả các sản phẩm.<br/>- Danh mục sản phẩm: Áp dụng cho một vài Danh mục cụ thể<br/>- Từng sản phẩm: Áp dụng cho một vài sản phẩm cụ thể" aria-invalid="false"></i>                
</div>
<script type="text/javascript">
    $(document).on('change',"#<?= Aabc::$app->_model->__chinhsach.'_'.Aabc::$app->_chinhsach->cs_apdungcho.'_select' ?>-pa input", function() {        
        if($(this).val() == 2){            
            $('.field-hi-<?= Aabc::$app->_model->__danhmuc?>').removeClass('hide');
            $('.field-hi-<?= Aabc::$app->_model->__danhmuc?>').hide();
            $('.field-hi-<?= Aabc::$app->_model->__danhmuc?>').show('300');
            $('.field-hi-<?= Aabc::$app->_model->__sanpham?>').hide('100');
        }else if($(this).val() == 3){
            $('.field-hi-<?= Aabc::$app->_model->__sanpham?>').removeClass('hide');
            $('.field-hi-<?= Aabc::$app->_model->__sanpham?>').hide();
            $('.field-hi-<?= Aabc::$app->_model->__sanpham?>').show('300');
            $('.field-hi-<?= Aabc::$app->_model->__danhmuc?>').hide('100');
        }else{            
            $('.field-hi-<?= Aabc::$app->_model->__danhmuc?>').hide('100');
            $('.field-hi-<?= Aabc::$app->_model->__sanpham?>').hide('100');
        }
    });   
</script>

<div class="col-md-12 col-sm-6  col-xs-12 pt140">
    <?php     
        $_Danhmuc  = Aabc::$app->_model->Danhmuc;                
        $danhmuc = $_Danhmuc::getAll1_1();                    
        array_unshift($danhmuc,[
            Aabc::$app->_danhmuc->dm_id => '',
            Aabc::$app->_danhmuc->dm_char =>'---Chọn---',
        ]);//Thêm vào đầu
        $danhmuc_hide = ($model[Aabc::$app->_chinhsach->cs_apdungcho] == 2 ? '' : 'hide');        
        echo $form->field($model, Aabc::$app->_chinhsach->cs_id_danhmuc,['options' => ['class' => $danhmuc_hide]])->dropDownList(ArrayHelper::map($danhmuc,Aabc::$app->_danhmuc->dm_id,Aabc::$app->_danhmuc->dm_char),[                                    
                'multiple'=>'multiple',
                Aabc::$app->d->ty => 'checkbox',
                // Aabc::$app->d->ty => 'ra',
                // Aabc::$app->d->c => 'one',
                // Aabc::$app->d->add => 'ip',
                // d-add chỉ cần cho d-u, còn d-i của url sẽ được lấy ở fk- bên dưới
                Aabc::$app->d->i => Aabc::$app->_model->__chinhsach,
                Aabc::$app->d->t => 'sea',//Search
                'class' => 'mulr',                        
                // 'id' => Aabc::$app->_model->__sanpham.'-sp_id_thuonghieu'
                'id' => 'hi-'.Aabc::$app->_model->__danhmuc
            ])->label(Aabc::$app->_chinhsach->__cs_id_danhmuc); 
    ?>
    
</div>


<div class="col-md-12 col-sm-6  col-xs-12 pt100">
    <?php     
        $_Sanpham  = Aabc::$app->_model->Sanpham;                
        $sanpham = $_Sanpham::getAll1_1();

        array_unshift($sanpham,[
            Aabc::$app->_sanpham->sp_id => '',
            Aabc::$app->_sanpham->sp_tensp =>'---Chọn---',
        ]);//Thêm vào đầu
        $sanpham_hide = ($model[Aabc::$app->_chinhsach->cs_apdungcho] == 3 ? '' : 'hide'); 
        echo $form->field($model, Aabc::$app->_chinhsach->cs_id_sp,['options' => ['class' => $sanpham_hide]])->dropDownList(ArrayHelper::map($sanpham,Aabc::$app->_sanpham->sp_id,Aabc::$app->_sanpham->sp_tensp),[
                'multiple'=>'multiple',
                Aabc::$app->d->ty => 'checkbox',
                // Aabc::$app->d->ty => 'ra',
                // Aabc::$app->d->c => 'one',
                // Aabc::$app->d->add => 'ip',
                // d-add chỉ cần cho d-u, còn d-i của url sẽ được lấy ở fk- bên dưới
                Aabc::$app->d->i => Aabc::$app->_model->__chinhsach,
                Aabc::$app->d->t => 'sea',//Search
                'class' => 'mulr',                        
                // 'id' => Aabc::$app->_model->__sanpham.'-sp_id_thuonghieu'
                'id' => 'hi-'.Aabc::$app->_model->__sanpham
            ])->label(Aabc::$app->_chinhsach->__cs_id_sp); 
    ?>
   
</div>









<div class="col-md-12 col-sm-5 col-xs-12 pt100"> 
        <?php 
            if($model[Aabc::$app->_chinhsach->cs_ngaybatdau] == null){
                $model[Aabc::$app->_chinhsach->cs_ngaybatdau] = date("Y-m-d");
            }else{                 
                $model[Aabc::$app->_chinhsach->cs_ngaybatdau] = date("Y-m-d", strtotime($model[Aabc::$app->_chinhsach->cs_ngaybatdau]));               
            }
        ?>


        <?= $form->field($model, Aabc::$app->_chinhsach->cs_ngaybatdau,['options' => ['class' => '']])->widget(\dosamigos\datetimepicker\DateTimePicker::className(), [
            // 'size' => 'ms',
            // 'template' => '{input}',
            'pickButtonIcon' => 'glyphicon glyphicon-time',
            'pickButtonIcon' => 'glyphicon glyphicon-calendar',
            'inline' => false,
            'clientOptions' => [
                // 'startView' => 1,
                'minView' => 2,
                // 'maxView' => 1,
                'autoclose' => true,
                // 'linkFormat' => 'HH:ii:ss dd-mm-yyyy', // if inline = true
                // 'format' => 'HH:ii P', // if inline = false
                // 'format' => ' hh:ii:ss dd-mm-yyyy',
                'format' => 'yyyy-mm-dd',

                'todayBtn' => true
            ]
        ]);?>

        <i class="hdtip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="- Ngày bắt đầu chương trình này." aria-invalid="false"></i> 
    </div>




<div class="col-md-12 col-sm-5 col-xs-12 pt100"> 
        <?php 
            if($model[Aabc::$app->_chinhsach->cs_ngayketthuc] == null){
                // $model[Aabc::$app->_chinhsach->cs_ngayketthuc] = date("Y-m-d H:i");
            }else{                 
                $model[Aabc::$app->_chinhsach->cs_ngayketthuc] = date("Y-m-d", strtotime($model[Aabc::$app->_chinhsach->cs_ngayketthuc]));               
            }
        ?>


        <?= $form->field($model, Aabc::$app->_chinhsach->cs_ngayketthuc,['options' => ['class' => '']])->widget(\dosamigos\datetimepicker\DateTimePicker::className(), [
            // 'size' => 'ms',
            // 'template' => '{input}',
            'pickButtonIcon' => 'glyphicon glyphicon-time',
            'pickButtonIcon' => 'glyphicon glyphicon-calendar',
            'inline' => false,
            'clientOptions' => [
                // 'startView' => 1,
                'minView' => 2,
                // 'maxView' => 1,
                'autoclose' => true,
                // 'linkFormat' => 'HH:ii:ss dd-mm-yyyy', // if inline = true
                // 'format' => 'HH:ii P', // if inline = false
                // 'format' => ' hh:ii:ss dd-mm-yyyy',
                'format' => 'yyyy-mm-dd',

                'todayBtn' => true
            ]
        ]);?>

        <i class="hdtip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="- Ngày kết thúc chương trình." aria-invalid="false"></i> 
    </div>


<div class="col-md-12  pt100">
    <?= $form->field($model, Aabc::$app->_chinhsach->cs_status)->dropDownList([ 1 => 'Kích hoạt', 2 => 'Ngừng kích hoạt##mre', ],['placeholder' => '' ,'data-placement' => 'top', 'data-html' => 'true','data-trigger' => 'focus','data-html' => 'true', 'data-toggle' => 'tooltip','title' => '',
            //'multiple'=>'multiple', 
            // Aabc::$app->d->s => 'search', 
            Aabc::$app->d->t => 'show', 
            Aabc::$app->d->ty => 'ra',
            Aabc::$app->d->i => Aabc::$app->_model->__chinhsach,
            'class' => 'mulr',      
            Aabc::$app->d->c => 'one',                        
            'id' => Aabc::$app->_model->__chinhsach.'_cs_status_select'
        ]) ?>
    <i class="hdtip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="- Trạng thái của Chương trình này: Kích hoạt hoặc Ngừng kích hoạt." aria-invalid="false"></i> 
</div>



    </div>

    <div class="form-group right">
        <button <?= Aabc::$app->d->i?> = <?= Aabc::$app->_model->__chinhsach ?> type="submit" class="btn btn-default haserror lvt"><span class="glyphicon glyphicon-floppy-disk mxanh"></span>Lưu và Thêm</button>

        <button type="submit" class="btn btn-default haserror"><span class="glyphicon glyphicon-floppy-disk mxanh"></span>Lưu</button>

        <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-ban-circle mdo"></span>Đóng</button>
    </div>




    <?php ActiveForm::end(); ?>

</div>



<script type="text/javascript">  

  

    $('.modal-content #<?=Aabc::$app->_model->__chinhsach?>-form').on('keyup keypress', function(e) {
      var keyCode = e.keyCode || e.which;
      if (keyCode === 13) { 
        e.preventDefault();
        return false;
      }
    });


$('form#<?=Aabc::$app->_model->__chinhsach?>-form').on('beforeSubmit', function(e) {
    loadimg();
    var form = $(this);
    var formData = form.serialize();
    $.ajax({
        url: form.attr("action"),
        type: form.attr("method"),
        data: formData,
        success: function (data) {
            reload('<?=Aabc::$app->_model->__chinhsach?>');  
            
            //update element
            // pjelm('<?=Aabc::$app->_model->__chinhsach?>');  

            if(data == 1){ 
                popthanhcong('','#<?php  if(isset($_POST['modal'])) echo $_POST['modal']?>');
            }else{
                popthatbai('');
            }            
            lvtok('<?=Aabc::$app->_model->__chinhsach?>');
        },
        error: function () {
            reload('<?=Aabc::$app->_model->__chinhsach?>');
            poploi();
        }
    });
}).on('submit', function(e){
    e.preventDefault();
});
</script>