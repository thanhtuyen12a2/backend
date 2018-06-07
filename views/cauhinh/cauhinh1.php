<?php
use common\cont\D;
use backend\models\Sanpham;
use backend\models\Cauhinh;
use aabc\helpers\Html;
use aabc\grid\GridView;
// use aabc\bootstrap\Modal; /*Them*/
use aabc\helpers\Url; /*Them*/
use aabc\helpers\ArrayHelper; /*Them*/
use aabc\widgets\ActiveForm;
?>

<div d-u="c1" id="pjch" class="pj ch-index">
    <script type="text/javascript">
      $('[data-toggle="tooltip"]').tooltip();
  </script>

    <?php
        $_Cauhinh = Cauhinh::M;
        $model = new $_Cauhinh;
    ?>
    <?php $form = ActiveForm::begin(['id' => 'ch-form']); ?>
  

<div class="ov hide"></div>

     <div class="ch-index-child">
        

        <div class="stg">
            <fieldset>
                <legend>Thông tin công ty</legend>


                <div class="col-md-7 pt200">
                    <div class="form-group required">
                        <div class="le"><label class="control-label" for="">Template</label></div>
                        <div class="ri"><textarea class="form-control" rows="2" type="text" name="<?= Cauhinh::T?>[<?= Cauhinh::template?>]"><?= Cauhinh::get(Cauhinh::template) ?></textarea></div>
                    </div>
                </div>



                <div class="col-md-7 pt200">
                    <div class="form-group required">
                        <div class="le"><label class="control-label" for="">Tên công ty</label></div>
                        <div class="ri"><input class="form-control" type="text" name="<?php echo Cauhinh::T?>[<?= Cauhinh::tencongty?>]" value="<?php echo Cauhinh::get(Cauhinh::tencongty) ?>"/></div>
                    </div>
                </div>


                <div class="col-md-7 pt200">
                    <div class="form-group required">
                        <div class="le"><label class="control-label" for="">Địa chỉ</label></div>
                        <div class="ri"><input class="form-control" type="text" name="<?= Cauhinh::T?>[<?= Cauhinh::diachi?>]" value="<?= Cauhinh::get(Cauhinh::diachi) ?>"/></div>
                    </div>
                </div>

                <div class="col-md-7 pt200">
                    <div class="form-group ">
                        <div class="le"><label class="control-label" for="">Hotline</label></div>
                        <div class="ri"><input class="form-control" type="text" name="<?= Cauhinh::T?>[<?= Cauhinh::hotline?>]" value="<?= Cauhinh::get(Cauhinh::hotline) ?>"/></div>
                    </div>
                </div>

             
                <div class="col-md-7 pt200">
                    <div class="form-group required">
                        <div class="le"><label class="control-label" for="">Điện thoại</label></div>
                        <div class="ri"><textarea class="form-control" rows="2" type="text" name="<?= Cauhinh::T?>[<?= Cauhinh::dienthoai?>]"><?= Cauhinh::get(Cauhinh::dienthoai) ?></textarea></div>
                    </div>
                </div>


                <div class="col-md-7 pt200">
                    <div class="form-group">
                        <div class="le"><label class="control-label" for="">Fax</label></div>
                        <div class="ri"><input class="form-control" type="text" name="<?= Cauhinh::T?>[<?= Cauhinh::fax?>]" value="<?= Cauhinh::get(Cauhinh::fax) ?>"/></div>
                    </div>
                </div>



                <div class="col-md-7 pt200">
                    <div class="form-group required">
                        <div class="le"><label class="control-label" for="">Email</label></div>
                        <div class="ri"><input class="form-control" type="text" name="<?= Cauhinh::T?>[<?= Cauhinh::email?>]" value="<?= Cauhinh::get(Cauhinh::email) ?>"/></div>
                    </div>
                </div>
            </fieldset>
        </div>



        <div class="stg">
            <fieldset>
                <legend>Website</legend>


                <div class="col-md-7 pt200">
                    <div class="form-group required">
                        <div class="le"><label class="control-label" for="">Ảnh favicon</label></div>
                        <div class="ri">
                            <input class="form-control" type="text" name="<?= Cauhinh::T?>[<?= Cauhinh::favicon?>]" value="<?= Cauhinh::get(Cauhinh::favicon) ?>"/>                            
                        </div>
                    </div>
                </div>

                <div class="col-md-7 pt200">
                    <div class="form-group required">
                        <div class="le"><label class="control-label" for="">Thẻ tiêu đề (Thẻ title)</label></div>
                        <div class="ri">
                            <input class="form-control" type="text" name="<?= Cauhinh::T?>[<?= Cauhinh::thetieude?>]" value="<?= Cauhinh::get(Cauhinh::thetieude) ?>"/>                            
                        </div>
                    </div>
                </div>

                <div class="col-md-7 pt200">
                    <div class="form-group required">
                        <div class="le"><label class="control-label" for="">Hậu tố</label></div>
                        <div class="ri">
                            <input class="form-control" type="text" name="<?= Cauhinh::T?>[<?= Cauhinh::thehauto?>]" value="<?= Cauhinh::get(Cauhinh::thehauto) ?>"/>                            
                        </div>
                    </div>
                </div>
               


                <div class="col-md-7 pt200">
                    <div class="form-group required">
                        <div class="le"><label class="control-label" for="">Thẻ mô tả (Meta description)</label></div>
                        <div class="ri">                            
                            <textarea class="form-control" row="2" name="<?= Cauhinh::T?>[<?= Cauhinh::themota?>]"><?= Cauhinh::get(Cauhinh::themota) ?></textarea>
                        </div>
                    </div>
                </div>


                <div class="col-md-7 pt200">
                    <div class="form-group required">
                        <div class="le"><label class="control-label" for="">Logo</label></div>
                        <div class="ri"><input class="form-control" type="text" name="<?= Cauhinh::T?>[<?= Cauhinh::logo?>]" value="<?= Cauhinh::get(Cauhinh::logo) ?>"/></div>
                    </div>
                </div>

                
                <div class="col-md-7 pt200">
                    <div class="form-group required">
                        <div class="le"><label class="control-label" for="">Ngôn ngữ</label></div>
                        <div class="ri"><input class="form-control" type="text" name="<?= Cauhinh::T?>[<?= Cauhinh::ngonngu?>]" value="<?= Cauhinh::get(Cauhinh::ngonngu) ?>"/></div>
                    </div>
                </div>

            </fieldset>
        </div>

    </div>


        <div class="clearfix"></div>
        <div class="form-group right"> 
            <button type="submit" class="btn btn-default haserror"><span class="glyphicon glyphicon-floppy-disk mxanh"></span>Lưu</button>       
        </div>
  
    <?php ActiveForm::end(); ?>
<script type="text/javascript"> 

    $('.stg input').on('keyup keypress', function(e){
        // var text = $(this).val()
        // $(this).parents('label').find('>b').text(text)
        // autoheight(this);
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13){
            e.preventDefault();
            return false;
        }
    });

    // $('.stg textarea').on('mousedown', function(e){
    //     autoheight(this);       
    // });

    //  setTimeout( function(){ 
    //     $('.stg textarea').each(function (){
    //         autoheight(this);           
    //     });
    //  }, 500);
    // setTimeout( function(){ 
    //     $('.stg textarea').each(function (){
    //         autoheight(this);
    //     });
    //  }, 1500);



    $('form#ch-form').on('beforeSubmit', function(e) {
        loadimg();
        var form = $(this);
        var formData = form.serialize();
        $.ajax({
            url: form.attr("action"),
            type: form.attr("method"),
            data: formData,
            success: function (data) {
                if(data == 1){
                     popthanhcong('Cập nhật');
                     reload('ch')                     
                }else{
                    popthatbai('Cập nhật');
                }
                unloadimg()
            },
            error: function () {                
                poploi();
                unloadimg()
            }
        });
    }).on('submit', function(e){
        e.preventDefault();
    });
</script>


</div>


  
  