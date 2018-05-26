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

        
        $page = Cauhinh::get(Cauhinh::page); 
        $max =  empty($page['max'])? 1 : ($page['max'] + 1);
                            
    ?>
    <?php $form = ActiveForm::begin(['id' => 'ch-form']); ?>
  

<style type="text/css">
    [class*='col-md-'] {
        margin: 0;
        padding: 0;
    }
</style>

<div class="ch-index-child">
    <div class="stg">
        <fieldset>
            <legend>Page</legend>          
            <div class="col-md-12 pt140">
                <div class="form-group required">
                    <div class="le"><label class="control-label" for="">Tổng số page</label></div>
                    <div class="ri">  
                        <input placeholder="Số lượng page" class="form-control" type="number" min="0" max="20" name="<?= Cauhinh::T?>[<?= Cauhinh::page?>][max]" value="<?= empty($page['max'])?'':$page['max'] ?>" />
                              
                    </div>
                </div>
            </div>   


            <?php for ($j=1; $j < $max ; $j++) { ?>
            <div class="col-md-6 pt100">
                <div class="form-group required">
                    <div class="le"><label class="control-label" for="">Page: <?= $j?></label></div>
                    <div class="ri"> 
                        <input placeholder="Tên page" class="col-md-11" type="text"  name="<?= Cauhinh::T?>[<?= Cauhinh::page?>][child][<?= $j?>][label]" value="<?= empty($page['child'][$j]['label'])?'':$page['child'][$j]['label'] ?>" />

                        <input placeholder="Icon" class="col-md-1" type="number" min="0" max="20" name="<?= Cauhinh::T?>[<?= Cauhinh::page?>][child][<?= $j?>][icon]" value="<?= empty($page['child'][$j]['icon'])?'':$page['child'][$j]['icon'] ?>" />

                        <textarea placeholder="Cấu trúc giao diện" class="form-control" rows="20" name="<?= Cauhinh::T?>[<?= Cauhinh::page?>][child][<?= $j?>][content]"><?= empty($page['child'][$j]['content'])?'':$page['child'][$j]['content'] ?></textarea>
                    </div>
                </div>
            </div>   
            <?php } ?> 

        </fieldset>
    </div>

  
<!-- 
   <div class="stg">
        <fieldset>
            <legend>Danh sách page</legend>
            <?php //for ($j=1; $j < $max ; $j++) { ?>
                <?php 
                    // $lable = empty($page['child'][$j]['label'])?'':$page['child'][$j]['label'];
                ?>
                <div d-m="2" d-u="ip_mn?g=<?= $j?>&l=<?php //echo urlencode($lable) ?>" class="col-md-3 page-child pjbm"  d-i="danhmuc">
                    page: <?php //echo $lable ?>
                </div>           
            <?php //} ?> 
        </fieldset>
    </div> -->





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


  
  