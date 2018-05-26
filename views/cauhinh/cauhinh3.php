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
    <?php
        $_Cauhinh = Cauhinh::M;
        $model = new $_Cauhinh;
    ?>
    <?php $form = ActiveForm::begin(['id' => 'ch-form']); ?>
        <div class="stg">
            <fieldset>
                <legend>-</legend>
                <div class="col-md-7 pt200">
                    <div class="form-group required">
                        <div class="le"><label class="control-label" for="danhmuc-dm_ten">Google Ananytic</label></div>
                        <div class="ri"><input class="form-control" type="text" name="<?= Cauhinh::T?>[<?= Cauhinh::tencongty?>]" value="<?= Cauhinh::get(Cauhinh::tencongty) ?>"/></div>
                    </div>
                </div>



            </fieldset>
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


  
  