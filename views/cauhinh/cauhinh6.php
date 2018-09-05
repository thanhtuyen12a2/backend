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

        $module_template = Cauhinh::module.Cauhinh::template();


        
        $module = Cauhinh::get($module_template); 

        $max =  empty($module['max'])? 1 : ($module['max'] + 1);
                            
    ?>
    <?php $form = ActiveForm::begin(['id' => 'ch-form']); ?>
  

<style type="text/css">

</style>

<div class="ch-index-child">
    <div class="stg">
        <fieldset>
            <legend>Module</legend>          
            <div class="col-md-12 pt140">
                <div class="form-group required">
                    <div class="le"><label class="control-label" for="">Tổng số Module</label></div>
                    <div class="ri">  
                        <input placeholder="Số lượng Module" class="form-control" type="number" min="0" name="<?= Cauhinh::T?>[<?= $module_template?>][max]" value="<?= empty($module['max'])?'':$module['max'] ?>" />
                              
                    </div>
                </div>
            </div>   

            <script type="text/javascript">
                $('.module-clone').on('click',function(){
                    // var a = $(this).val();
                    var b = $(this).data('to');
                    var c = $(this).data('nb'); //Noi bat
                    var a = prompt("Bạn muốn clone từ module", "");
                    // if(confirm('Bạn muốn clone từ module '+a)){
                    if (a == null || a == "") {                    
                    }
                    else{
                        $.ajax({
                            cache: false,
                            url: '/ad/<?= Cauhinh::tt.'/'.Cauhinh::moduleclone?>',
                            data:{
                                from: a,
                                to: b,
                                nb: c,
                            },
                            type: 'POST',               
                            success: function (data) {   
                                popthanhcong('')
                            },
                            error: function () {
                                popthatbai('')  
                            }
                        });
                    }                    
                })
            </script>
            <style type="text/css">
                .stg label{font-size: 12px;padding: 0 5px 0 0;}
            </style>

            <?php for ($j=1; $j < $max ; $j++) { ?>
            <div class="col-md-6 pt100">
                <div class="form-group required">
                    <div class="le"><label class="control-label" for="">Module: <?= $j?></label></div>
                    <div class="ri"> 
                        <input style="font-size: 14px;text-align: left;" placeholder="Tên module" class="col-md-8 btn btn-default" type="text"  name="<?= Cauhinh::T?>[<?= $module_template?>][child][<?= $j?>][label]" value="<?= empty($module['child'][$j]['label'])?'':$module['child'][$j]['label'] ?>" />

                         <select class="btn btn-default col-md-1" name="<?= Cauhinh::T?>[<?= $module_template?>][child][<?= $j?>][max]">
                            <option>level</option>
                            <option <?= ($module['child'][$j]['max'] == 1)?'selected':''?> value="1">1</option>
                            <option <?= ($module['child'][$j]['max'] == 2)?'selected':''?> value="2">2</option>
                            <option <?= ($module['child'][$j]['max'] == 3)?'selected':''?> value="3">3</option>
                            <option <?= ($module['child'][$j]['max'] == 4)?'selected':''?> value="4">4</option>
                            <option <?= ($module['child'][$j]['max'] == 5)?'selected':''?> value="5">5</option>
                            <option <?= ($module['child'][$j]['max'] == 6)?'selected':''?> value="6">6</option>
                            <option <?= ($module['child'][$j]['max'] == 7)?'selected':''?> value="7">7</option>
                        </select>

                        <select class="btn <?= !empty($module['child'][$j]['nb'])?'btn-warning':'btn-default'?>  col-md-2" name="<?= Cauhinh::T?>[<?= $module_template?>][child][<?= $j?>][nb]">
                            <option></option>
                            <option <?= ($module['child'][$j]['nb'] == 1)?'selected':''?> value="1">Sản phẩm</option>
                            <option <?= ($module['child'][$j]['nb'] == 2)?'selected':''?> value="2">Bài viết</option>
                        </select>

                      

                        <input placeholder="Clone" data-to="<?= $j?>" data-nb=<?= $module['child'][$j]['nb']?>  value="Clone" class="btn col-md-1 module-clone" type="button" value="" />

                        <div class="clearfix"></div>

                        <?php 
                            $max_child =  empty($module['child'][$j]['max'])? 1 : ((int)$module['child'][$j]['max'] + 1);
                        ?>
                        
                        <?php for ($i=1; $i < $max_child ; $i++) { ?>  
                            <div class="clearfix">   
                            <div class="col-md-2"><label>Level: <?= $i?></label></div>
                            <div class="col-md-10">
                                <label><input class="form-control-stg" type="checkbox" name="<?= Cauhinh::T?>[<?= $module_template?>][child][<?= $j?>][child][<?= $i?>][label]" value="1" <?= empty($module['child'][$j]['child'][$i]['label'])?'':'checked' ?>/>Label</label>
                                <label><input class="form-control-stg" type="checkbox" name="<?= Cauhinh::T?>[<?= $module_template?>][child][<?= $j?>][child][<?= $i?>][url]" value="1" <?= empty($module['child'][$j]['child'][$i]['url'])?'':'checked' ?>/>Url</label>
                                <label><input class="form-control-stg" type="checkbox" name="<?= Cauhinh::T?>[<?= $module_template?>][child][<?= $j?>][child][<?= $i?>][icon]" value="1" <?= empty($module['child'][$j]['child'][$i]['icon'])?'':'checked' ?>/>Icon</label>
                                <label><input class="form-control-stg" type="checkbox" name="<?= Cauhinh::T?>[<?= $module_template?>][child][<?= $j?>][child][<?= $i?>][background]" value="1" <?= empty($module['child'][$j]['child'][$i]['background'])?'':'checked' ?>/>Hình ảnh</label>
                                <label><input class="form-control-stg" type="checkbox" name="<?= Cauhinh::T?>[<?= $module_template?>][child][<?= $j?>][child][<?= $i?>][email]" value="1" <?= empty($module['child'][$j]['child'][$i]['email'])?'':'checked' ?>/>Email</label>
                                <label><input class="form-control-stg" type="checkbox" name="<?= Cauhinh::T?>[<?= $module_template?>][child][<?= $j?>][child][<?= $i?>][phone]" value="1" <?= empty($module['child'][$j]['child'][$i]['phone'])?'':'checked' ?>/>Phone</label>

                                <label><input class="form-control-stg" type="checkbox" name="<?= Cauhinh::T?>[<?= $module_template?>][child][<?= $j?>][child][<?= $i?>][fb]" value="1" <?= empty($module['child'][$j]['child'][$i]['fb'])?'':'checked' ?>/>FB</label>

                                <label><input class="form-control-stg" type="checkbox" name="<?= Cauhinh::T?>[<?= $module_template?>][child][<?= $j?>][child][<?= $i?>][youtube]" value="1" <?= empty($module['child'][$j]['child'][$i]['youtube'])?'':'checked' ?>/>Youtube</label>

                                <label><input class="form-control-stg" type="checkbox" name="<?= Cauhinh::T?>[<?= $module_template?>][child][<?= $j?>][child][<?= $i?>][viber]" value="1" <?= empty($module['child'][$j]['child'][$i]['viber'])?'':'checked' ?>/>Viber</label>

                                <label><input class="form-control-stg" type="checkbox" name="<?= Cauhinh::T?>[<?= $module_template?>][child][<?= $j?>][child][<?= $i?>][zalo]" value="1" <?= empty($module['child'][$j]['child'][$i]['zalo'])?'':'checked' ?>/>Zalo</label>

                                <label><input class="form-control-stg" type="checkbox" name="<?= Cauhinh::T?>[<?= $module_template?>][child][<?= $j?>][child][<?= $i?>][skype]" value="1" <?= empty($module['child'][$j]['child'][$i]['skype'])?'':'checked' ?>/>Skype</label>

                                <label><input class="form-control-stg" type="checkbox" name="<?= Cauhinh::T?>[<?= $module_template?>][child][<?= $j?>][child][<?= $i?>][price]" value="1" <?= empty($module['child'][$j]['child'][$i]['price'])?'':'checked' ?>/>Giá</label>
                            </div>
                            </div>
                        <?php } ?>

                    </div>
                </div>
            </div>   

                <?php 

                    if(($j % 10) == 0) echo '<hr class="col-md-12 row" />';

                ?>

            <?php } ?> 

        </fieldset>
    </div>

  
<!-- 
   <div class="stg">
        <fieldset>
            <legend>Danh sách Module</legend>
            <?php //for ($j=1; $j < $max ; $j++) { ?>
                <?php 
                    // $lable = empty($module['child'][$j]['label'])?'':$module['child'][$j]['label'];
                ?>
                <div d-m="2" d-u="ip_mn?g=<?= $j?>&l=<?php //echo urlencode($lable) ?>" class="col-md-3 module-child pjbm"  d-i="danhmuc">
                    Module: <?php //echo $lable ?>
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


  
  