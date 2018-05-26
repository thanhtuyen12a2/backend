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
        <div class="stg">
            <fieldset>
                <legend>Banner</legend>
                
                <div class="col-md-7 pt200">
                    <div class="form-group required">
                        <div class="le"><label class="control-label" for="danhmuc-dm_ten">Câu Slogan</label></div>
                        <div class="ri"><input class="form-control" type="text" name="<?= Cauhinh::T?>[<?= Cauhinh::slogan_top?>]" value="<?= Cauhinh::get(Cauhinh::slogan_top) ?>"/></div>
                    </div>
                </div>

                <div class="col-md-7 pt200">
                    <div class="form-group required">
                        <div class="le"><label class="control-label" for="danhmuc-dm_ten">Banner</label></div>
                        <div class="ri"><input class="form-control" type="text" name="<?= Cauhinh::T?>[<?= Cauhinh::banner?>]" value="<?= Cauhinh::get(Cauhinh::banner) ?>"/></div>
                    </div>
                </div>

            </fieldset>
        </div>


        <div class="stg">
            <fieldset>
                <legend>Menu top</legend>
                
                <div class="col-md-12 pt200">
                    <?php 
                        $menu = Cauhinh::get(Cauhinh::menu);                        
                    ?>
                    <?php for ($i=1; $i < 7 ; $i++) { ?>
                    <div class="form-group">
                        <div class="le"><label class="control-label" for="danhmuc-dm_ten">Link #<?= $i?>:</label></div>
                        <div class="ri">                            
                            <input placeholder="Tiêu đề" class="form-control-stg col-md-6" type="text" name="<?= Cauhinh::T?>[<?= Cauhinh::menu?>][<?= $i?>][k]" value="<?= empty($menu[$i]['k'])?'':$menu[$i]['k'] ?>"/>
                            <input placeholder="Link dẫn (có thể trống)" class="form-control-stg col-md-6" type="text" name="<?= Cauhinh::T?>[<?= Cauhinh::menu?>][<?= $i?>][l]" value="<?= empty($menu[$i]['l'])?'':$menu[$i]['l'] ?>"/>
                        </div>
                    </div>
                    <?php } ?>
                </div>

            </fieldset>
        </div>


         <div class="stg">
            <fieldset>
                <legend>Link tìm kiếm nhiều</legend>
                
                <div class="col-md-12 pt200">
                    <?php 
                        $searchtop = Cauhinh::get(Cauhinh::searchtop);                        
                    ?>
                    <?php for ($i=1; $i < 7 ; $i++) { ?>
                    <div class="form-group">
                        <div class="le"><label class="control-label" for="danhmuc-dm_ten">Link #<?= $i?>:</label></div>
                        <div class="ri">                            
                            <input placeholder="Tiêu đề" class="form-control-stg col-md-6" type="text" name="<?= Cauhinh::T?>[<?= Cauhinh::searchtop?>][<?= $i?>][k]" value="<?= empty($searchtop[$i]['k'])?'':$searchtop[$i]['k'] ?>"/>
                            <input placeholder="Link dẫn (có thể trống)" class="form-control-stg col-md-6" type="text" name="<?= Cauhinh::T?>[<?= Cauhinh::searchtop?>][<?= $i?>][l]" value="<?= empty($searchtop[$i]['l'])?'':$searchtop[$i]['l'] ?>"/>
                        </div>
                    </div>
                    <?php } ?>
                </div>

            </fieldset>
        </div>


       <div class="stg">
            <fieldset>
                <legend>Chân trang (Footer)</legend>
                
                <div class="col-md-12 pt200">
                    <?php 
                        $footer_list = Cauhinh::get(Cauhinh::footer_list);                        
                    ?>
                    <?php for ($i=1; $i < 5 ; $i++) { ?>
                    <div class="form-group">
                        <div class="le"><label class="control-label" for="danhmuc-dm_ten">Mục <?= $i?>:</label></div>
                        <div class="ri">    
                            <input placeholder="TIÊU ĐỀ MỤC" class="form-control-stg col-md-8" type="text" name="<?= Cauhinh::T?>[<?= Cauhinh::footer_list?>][<?= $i?>][a]" value="<?= empty($footer_list[$i]['a'])?'':$footer_list[$i]['a'] ?>"/>
                            <?php for ($j = 1; $j < 6; $j++) { ?>
                                 <input placeholder="mục con" class="form-control-stg col-md-6" type="text" name="<?= Cauhinh::T?>[<?= Cauhinh::footer_list?>][<?= $i?>][c][<?= $j?>][k]" value="<?= empty($footer_list[$i]['c'][$j]['k'])?'':$footer_list[$i]['c'][$j]['k'] ?>"/>                                 
                                <input placeholder="Link dẫn (có thể trống)" class="form-control-stg col-md-6" type="text" name="<?= Cauhinh::T?>[<?= Cauhinh::footer_list?>][<?= $i?>][c][<?= $j?>][l]" value="<?= empty($footer_list[$i]['c'][$j]['l'])?'':$footer_list[$i]['c'][$j]['l'] ?>"/>
                            <?php } ?>                           
                        </div>
                    </div>
                    <?php } ?>
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


  
  