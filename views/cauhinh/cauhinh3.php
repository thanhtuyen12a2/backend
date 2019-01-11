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

        #httt {
            margin-bottom: 10px;
        }

        .del-hhtt {
            color: #ca0909;
            cursor: pointer;
            position: absolute;
            top: 17px;
            right: 33px;
            font-size: 14px;
        }

        .del-hhtt:hover {    
                color: #f30909;
        }
    </style>
    
    <?php $form = ActiveForm::begin(['id' => 'ch-form']); ?>
    <div class="ch-index-child">
        <div id="pa-hhtt">
        <?php
            $hinhthucthanhtoan = Cauhinh::get(Cauhinh::hinhthucthanhtoan);
            
            // $hinhthucthanhtoan = [];
            // $hinhthucthanhtoan[] = [
            //     'label' => 'Hinhf thwsc 1',
            //     'content' => 'Nooij dung',
            // ];

            if(is_array($hinhthucthanhtoan)) foreach ($hinhthucthanhtoan as $k => $v) {

        ?>

            <div class="stg col-md-12">
                <fieldset>
                    <legend>
                        <input style="border: none;color: #555;width: 100%;padding: 3px 5px;font-size: 16px;" name="<?= Cauhinh::T?>[<?= Cauhinh::hinhthucthanhtoan?>][<?= $k?>][label]" value="<?= empty($v['label'])?'':$v['label'] ?>" />
                        <span class="del-hhtt glyphicon glyphicon-remove"></span>
                    </legend>                
                    <div class="col-md-12">
                        <div class="form-group required">                        
                            <div>                          
                                <textarea class="form-control" row="2" name="<?= Cauhinh::T?>[<?= Cauhinh::hinhthucthanhtoan?>][<?= $k?>][content]"><?= $v['content'] ?></textarea>
                                <script>
                                    CKEDITOR.replace("<?= Cauhinh::T?>[<?= Cauhinh::hinhthucthanhtoan?>][<?= $k?>][content]");
                                </script>
                            </div>
                        </div>
                    </div>

                </fieldset>
            </div>

        <?php                
            }
        ?>    
        </div>    
        <div class="clearfix"></div>
        <span class="btn btn-sm btn-success" id="httt">Thêm Hình thức thanh toán</span>

        <script type="text/javascript">
            $('#httt').click(function(){
                var d = new Date();
                var time = d.getTime();

                var pa =  $('#pa-hhtt')
                var html  = '<div class="stg col-md-12"><fieldset><legend><input style="color: #555;width: 100%;padding: 3px 5px;font-size: 16px;" name="<?= Cauhinh::T?>[<?= Cauhinh::hinhthucthanhtoan?>]['+time+'][label]" value="" /><span class="del-hhtt glyphicon glyphicon-remove"></span></legend><div class="col-md-12"><div class="form-group required"><div><textarea class="form-control" row="2" name="<?= Cauhinh::T?>[<?= Cauhinh::hinhthucthanhtoan?>]['+time+'][content]"></textarea><script>CKEDITOR.replace("<?= Cauhinh::T?>[<?= Cauhinh::hinhthucthanhtoan?>]['+time+'][content]");<\/script></div></div></div></fieldset></div>'

                pa.append(html)
            })

        </script>

     
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


  
  