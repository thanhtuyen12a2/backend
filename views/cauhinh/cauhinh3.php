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

<div class="ch-index">
    <script src="../ckeditor/ckeditor.js"></script>
    <style type="text/css">
        .form-control-stg {
            display: block;
            padding: 2px 8px;
            line-height: 1.42857143;
            color: #555;
            background-color: #fff;
            background-image: none;
            border: 1px solid #ccc;
            border-radius: 2px;
            height: 30px;
            font-size: 13px;
        }
    </style>
    
    <?php $form = ActiveForm::begin(['id' => 'ch-form']); ?>
    <div class="ch-index-child">
        <div class="stg col-md-6">
            <fieldset>
                <legend>Tại cửa hàng</legend>
                
                <div class="col-md-12">
                    <div class="form-group required">                        
                        <div>                          
                            <textarea class="form-control" row="2" name="<?= Cauhinh::T?>[<?= Cauhinh::thanhtoan_taicuahang?>]"><?= Cauhinh::get(Cauhinh::thanhtoan_taicuahang) ?></textarea>
                            <script>
                                CKEDITOR.replace("<?= Cauhinh::T?>[<?= Cauhinh::thanhtoan_taicuahang?>]");
                            </script>
                        </div>
                    </div>
                </div>

            </fieldset>
        </div>

        <div class="stg col-md-6">
            <fieldset>
                <legend>Chuyển khoản ngân hàng</legend>                
                 <div class="col-md-12">
                    <div class="form-group required">                        
                        <div>
                            <textarea class="form-control" row="2" name="<?= Cauhinh::T?>[<?= Cauhinh::thanhtoan_chuyenkhoan?>]"><?= Cauhinh::get(Cauhinh::thanhtoan_chuyenkhoan) ?></textarea>
                            <script>
                                CKEDITOR.replace("<?= Cauhinh::T?>[<?= Cauhinh::thanhtoan_chuyenkhoan?>]");
                            </script>
                        </div>
                    </div>
                </div>

            </fieldset>
        </div>
    
        <div class="clearfix"></div>
        
        <div class="stg col-md-6">
            <fieldset>
                <legend>Hình thức COD</legend>                
                 <div class="col-md-12">
                    <div class="form-group required">                        
                        <div>
                            <textarea class="form-control" row="2" name="<?= Cauhinh::T?>[<?= Cauhinh::thanhtoan_cod?>]"><?= Cauhinh::get(Cauhinh::thanhtoan_cod) ?></textarea>
                            <script>
                                CKEDITOR.replace("<?= Cauhinh::T?>[<?= Cauhinh::thanhtoan_cod?>]");
                            </script>
                        </div>
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


  
  