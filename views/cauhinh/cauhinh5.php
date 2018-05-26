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
    <?php
        $_Cauhinh = Cauhinh::M;
        $model = new $_Cauhinh;
    ?>
    <?php $form = ActiveForm::begin(['id' => 'ch-form']); ?>
    <div class="ch-index-child">
        <div class="stg col-md-6">
            <fieldset>
                <legend>Chính sách Khuyến mại</legend>
                
                 <div class="col-md-12">
                    <div class="form-group required">                        
                        <div>                          
                            <textarea class="form-control" row="2" name="<?= Cauhinh::T?>[<?= Cauhinh::sp_khuyenmai?>]"><?= Cauhinh::get(Cauhinh::sp_khuyenmai) ?></textarea>
                            <script>
                                CKEDITOR.replace("<?= Cauhinh::T?>[<?= Cauhinh::sp_khuyenmai?>]");
                            </script>
                        </div>
                    </div>
                </div>

            </fieldset>
        </div>

        <div class="stg col-md-6">
            <fieldset>
                <legend>Chính sách bảo hành, giao hàng</legend>                
                 <div class="col-md-12">
                    <div class="form-group required">                        
                        <div>
                            <textarea class="form-control" row="2" name="<?= Cauhinh::T?>[<?= Cauhinh::sp_chinhsach?>]"><?= Cauhinh::get(Cauhinh::sp_chinhsach) ?></textarea>
                            <script>
                                CKEDITOR.replace("<?= Cauhinh::T?>[<?= Cauhinh::sp_chinhsach?>]");
                            </script>
                        </div>
                    </div>
                </div>

            </fieldset>
        </div>

        
        <div class="stg col-md-6">
            <fieldset>
                <legend>Hỗ trợ</legend>                
                 <div class="col-md-12">
                    <div class="form-group required">                        
                        <div>
                            <textarea class="form-control" row="2" name="<?= Cauhinh::T?>[<?= Cauhinh::sp_hotro?>]"><?= Cauhinh::get(Cauhinh::sp_hotro) ?></textarea>
                            <script>
                                CKEDITOR.replace("<?= Cauhinh::T?>[<?= Cauhinh::sp_hotro?>]");
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


  
  