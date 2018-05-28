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
      


	<div class="col-md-12 pt140">
	    <?php //echo $form->field($model, Aabc::$app->_danhmuc->dm_idcha)->textInput(['data-placement' => 'right','data-trigger' => 'focus', 'data-toggle' => 'tooltip', 'title' => 'title']) ?>

	    <?php 
	    $_Danhmuc = Aabc::$app->_model->Danhmuc;

	    if($model->isNewRecord){    	
	    	$idcha = $_Danhmuc::getAll1_1();
	    }else{
	    	$idcha = $model->parent;
	    }

	    array_unshift($idcha,[
	        Aabc::$app->_danhmuc->dm_id => '',
	        Aabc::$app->_danhmuc->dm_char =>'---Chọn---',
	    ]);//Thêm vào đầu
	    $data = ArrayHelper::map($idcha, Aabc::$app->_danhmuc->dm_id, Aabc::$app->_danhmuc->dm_char);
	    echo $form->field($model, Aabc::$app->_danhmuc->dm_idcha)->dropDownList($data,[
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

	    <i class="hdtip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="- Chọn Danh mục cha<br/>- Nếu để trống thì Danh mục này sẽ là danh mục chính." aria-invalid="false"></i>
	</div>


	<div class="col-md-12 pt140">
	    <?= $form->field($model, Aabc::$app->_danhmuc->dm_ten)->textInput(['maxlength' => true]) ?>    
	    <i class="hdtip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="- Tên Danh mục sản phẩm." aria-invalid="false"></i>
	</div>


	<div class="col-md-12 pt140">
	    <?= $form->field($model, Aabc::$app->_danhmuc->dm_link)->textInput(['maxlength' => true]) ?>    
	</div>

	<div class="col-md-12 pt140">
	    <?= $form->field($model, Aabc::$app->_danhmuc->dm_thutu)->textInput(['maxlength' => true])->label('Thứ tự') ?>    
	</div>

	<div class="col-md-12 pt140">
	    <?= $form->field($model, Aabc::$app->_danhmuc->dm_icon)->textInput(['maxlength' => true]) ?>
	    
	</div>


	<div class="col-md-12 pt140">
	    <?= $form->field($model, Aabc::$app->_danhmuc->dm_background)->textInput(['maxlength' => true]) ?>
	    
	</div>

	<!-- 
	<div class="col-md-12 col-sm-6  col-xs-12 pt140">

	    <?php     
	        // $_Chinhsach  = Aabc::$app->_model->Chinhsach;                
	        // $chinhsach = $_Chinhsach::find()
	        //                 ->andWhere([Aabc::$app->_chinhsach->cs_apdungcho => ['1','2']] )
	        //                 ->andWhere([Aabc::$app->_chinhsach->cs_status => '1'])
	        //                 ->andWhere([Aabc::$app->_chinhsach->cs_recycle => '2'])
	        //                 ->andWhere([Aabc::$app->_chinhsach->cs_type => '1'])
	        //                 ->orderBy([Aabc::$app->_chinhsach->cs_apdungcho => SORT_ASC])
	        //                 ->all();

	        // foreach ($chinhsach as $keycs => $valuecs) {
	        //     if($chinhsach[$keycs][Aabc::$app->_chinhsach->cs_apdungcho] == 1){
	        //         $chinhsach[$keycs][Aabc::$app->_chinhsach->cs_ten] = '<i>Tất cả</i>'.$chinhsach[$keycs][Aabc::$app->_chinhsach->cs_ten] .'#$'.$chinhsach[$keycs][Aabc::$app->_chinhsach->cs_apdungcho];
	        //     }            
	        // }

	        // array_unshift($chinhsach,[
	        //     Aabc::$app->_chinhsach->cs_id => '',
	        //     Aabc::$app->_chinhsach->cs_ten =>'---Chọn---',
	        // ]);//Thêm vào đầu
	        // echo $form->field($model, Aabc::$app->_danhmuc->dm_id_chinhsach,['options' => ['class' => '']])->dropDownList(ArrayHelper::map($chinhsach,Aabc::$app->_chinhsach->cs_id,Aabc::$app->_chinhsach->cs_ten),[
	                
	        //         'multiple'=>'multiple',
	        //         Aabc::$app->d->ty => 'checkbox',
	                
	        //         // Aabc::$app->d->ty => 'ra',
	        //         // Aabc::$app->d->c => 'one',
	        //         // Aabc::$app->d->add => 'ip',
	        //         // d-add chỉ cần cho d-u, còn d-i của url sẽ được lấy ở fk- bên dưới

	        //         Aabc::$app->d->i => Aabc::$app->_model->__danhmuc,
	        //         Aabc::$app->d->t => 'sea',//Search
	        //         'class' => 'mulr',                        
	        //         // 'id' => Aabc::$app->_model->__sanpham.'-sp_id_thuonghieu'
	        //         'id' => 'fk-'.Aabc::$app->_model->__chinhsach.'-km-'.Aabc::$app->_model->__danhmuc
	        //     ])->label('Chính sách'); 
	    ?>
	    <i class="hdtip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="- Các Chương trình khuyến mại tặng kèm khi khách hàng mua <b>Sản phẩm</b> thuộc <b>Danh mục</b> này.<br/>- Các chương trình áp dụng cho <b>Tất cả sản phẩm</b> sẽ được ghim lên trên và được chọn tự động." aria-invalid="false"></i>
	</div>
	 -->




	<!-- 

	<div class="col-md-12 col-sm-6  col-xs-12 pt140">

	    <?php     
	        // $_Chinhsach  = Aabc::$app->_model->Chinhsach;                
	        // $chinhsach = $_Chinhsach::find()
	        //                 ->andWhere([Aabc::$app->_chinhsach->cs_apdungcho => ['1','2']] )
	        //                 ->andWhere([Aabc::$app->_chinhsach->cs_status => '1'])
	        //                 ->andWhere([Aabc::$app->_chinhsach->cs_recycle => '2'])
	        //                 ->andWhere([Aabc::$app->_chinhsach->cs_type => '2'])
	        //                 ->orderBy([Aabc::$app->_chinhsach->cs_apdungcho => SORT_ASC])
	        //                 ->all();

	        // foreach ($chinhsach as $keycs => $valuecs) {
	        //     if($chinhsach[$keycs][Aabc::$app->_chinhsach->cs_apdungcho] == 1){
	        //         $chinhsach[$keycs][Aabc::$app->_chinhsach->cs_ten] = '<i>Tất cả</i>'.$chinhsach[$keycs][Aabc::$app->_chinhsach->cs_ten] .'#$'.$chinhsach[$keycs][Aabc::$app->_chinhsach->cs_apdungcho];
	        //     }            
	        // }

	        // array_unshift($chinhsach,[
	        //     Aabc::$app->_chinhsach->cs_id => '',
	        //     Aabc::$app->_chinhsach->cs_ten =>'---Chọn---',
	        // ]);//Thêm vào đầu
	        // echo $form->field($model, Aabc::$app->_danhmuc->dm_id_chinhsach,['options' => ['class' => '']])->dropDownList(ArrayHelper::map($chinhsach,Aabc::$app->_chinhsach->cs_id,Aabc::$app->_chinhsach->cs_ten),[
	                
	        //         'multiple'=>'multiple',
	        //         Aabc::$app->d->ty => 'checkbox',
	                
	        //         // Aabc::$app->d->ty => 'ra',
	        //         // Aabc::$app->d->c => 'one',
	        //         // Aabc::$app->d->add => 'ip',
	        //         // d-add chỉ cần cho d-u, còn d-i của url sẽ được lấy ở fk- bên dưới

	        //         Aabc::$app->d->i => Aabc::$app->_model->__danhmuc,
	        //         Aabc::$app->d->t => 'sea',//Search
	        //         'class' => 'mulr',                        
	        //         // 'id' => Aabc::$app->_model->__sanpham.'-sp_id_thuonghieu'
	        //         'id' => 'fk-'.Aabc::$app->_model->__chinhsach.'-bh-'.Aabc::$app->_model->__danhmuc
	        //     ])->label('Bảo hành'); 
	    ?>
	    <i class="hdtip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="- Các Chương trình khuyến mại tặng kèm khi khách hàng mua <b>Sản phẩm</b> thuộc <b>Danh mục</b> này.<br/>- Các chương trình áp dụng cho <b>Tất cả sản phẩm</b> sẽ được ghim lên trên và được chọn tự động." aria-invalid="false"></i>
	</div> -->






	<!-- 


	<div class="col-md-12 pt140">
	    <?php //echo $form->field($model, Aabc::$app->_danhmuc->dm_icon)->textInput(['maxlength' => true,'data-placement' => 'right','data-trigger' => 'focus', 'data-toggle' => 'tooltip', 'title' => 'title']) ?>
	</div>

	<div class="col-md-12 pt140">
	    <?php //echo $form->field($model, Aabc::$app->_danhmuc->dm_background)->textInput(['maxlength' => true,'data-placement' => 'right','data-trigger' => 'focus', 'data-toggle' => 'tooltip', 'title' => 'title']) ?>
	</div>

	<div class="col-md-12 pt140">
	    <?php //echo $form->field($model, Aabc::$app->_danhmuc->dm_link)->textInput(['maxlength' => true,'data-placement' => 'right','data-trigger' => 'focus', 'data-toggle' => 'tooltip', 'title' => 'title']) ?>
	</div>


	<div class="col-md-12 pt140">
	    <?php //echo $form->field($model, Aabc::$app->_danhmuc->dm_ghichu)->textInput(['maxlength' => true,'data-placement' => 'right','data-trigger' => 'focus', 'data-toggle' => 'tooltip', 'title' => 'title']) ?>
	</div> -->

	<div class="col-md-12 pt140">
	    <?php 
	        if($model[Aabc::$app->_danhmuc->dm_status] == NULL) $model[Aabc::$app->_danhmuc->dm_status] = 1;
	    ?>
	    <?= $form->field($model, Aabc::$app->_danhmuc->dm_status)->dropDownList([1 => 'Xuất bản##mgr', 2 => 'Không hiển thị##mre', ],[
	                        //'multiple'=>'multiple', 
	                        // Aabc::$app->d->s => 'search', 
	                        Aabc::$app->d->t => 'show',
	                        Aabc::$app->d->ty => 'ra',
	                        Aabc::$app->d->i => Aabc::$app->_model->__danhmuc,
	                        'class' => 'mulr',      
	                        Aabc::$app->d->c => 'one',                        
	                        'id' => Aabc::$app->_model->__danhmuc.'_dm_status_select'
	                    ]) ?>

	    <i class="hdtip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="- Xuất bản: Danh mục sẽ hiển thị với người dùng<br/>- Không hiển thị: Danh mục sẽ ẩn với người dùng." aria-invalid="false"></i>
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


    $('#danhmuc-dm_ten').on('keyup keypress',function(){
        $('#danhmuc-dm_link').val(urlfriendly($(this).val()));        
    });
  

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
            pjelm('<?=Aabc::$app->_model->__danhmuc?>','');

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