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
        $module = Cauhinh::get(Cauhinh::module);
    ?>
    <?php $form = ActiveForm::begin(['id' => 'ch-form']); ?>
     <div class="ch-index-child">
        <div class="stg">
            <fieldset>
                <legend>Trên trang</legend> 
                <div class="col-md-12 pt200">

                    <?php 
                        $idmodule = 3;
                        $lable = empty($module['child'][$idmodule]['label'])?'':$module['child'][$idmodule]['label'];
                    ?>
                    <div d-m="2" d-u="ip_mn?g=<?= $idmodule?>&l=<?= urlencode($lable) ?>" class="col-md-3 module-child pjbm"  d-i="danhmuc">
                        Module: <?= $lable ?>
                    </div>
                    <div class="clearfix"></div>
                   
                </div>

            </fieldset>
        </div>


         <div class="stg">
            <fieldset>
                <legend>Slide</legend>
                
                <div class="col-md-12 pt200">
                    <?php
                        $slogan = Cauhinh::get(Cauhinh::home_slide);                        
                    ?>
                    <?php for ($i=1; $i < 5 ; $i++) { ?>
                    <div class="form-group">
                        <div class="le"><label class="control-label" for="danhmuc-dm_ten">Ảnh <?= $i?>:</label></div>
                        <div class="ri">
                            <input placeholder="Link ảnh" class="form-control-stg col-md-6" type="text" name="<?= Cauhinh::T?>[<?= Cauhinh::home_slide?>][<?= $i?>][l]" value="<?= empty($slogan[$i]['l'])?'':$slogan[$i]['l'] ?>"/>
                           
                        </div>
                    </div>
                    <?php } ?>
                </div>
              
            </fieldset>
        </div>



        <div class="stg">
            <fieldset>
                <legend>Giữa trang</legend>
                
                <div class="col-md-12 pt200">
                    <?php 
                        $slogan = Cauhinh::get(Cauhinh::home_slogan_2);                        
                    ?>
                    <?php for ($i=1; $i < 5 ; $i++) { ?>
                    <div class="form-group">
                        <div class="le"><label class="control-label" for="danhmuc-dm_ten">Câu slogan 2:<?= $i?>:</label></div>
                        <div class="ri">
                            <input placeholder="Icon" class="form-control-stg col-md-1" type="text" name="<?= Cauhinh::T?>[<?= Cauhinh::home_slogan_2?>][<?= $i?>][i]" value="<?= empty($slogan[$i]['i'])?'':$slogan[$i]['i'] ?>"/>
                            <input placeholder="Tiêu đề" class="form-control-stg col-md-4" type="text" name="<?= Cauhinh::T?>[<?= Cauhinh::home_slogan_2?>][<?= $i?>][k]" value="<?= empty($slogan[$i]['k'])?'':$slogan[$i]['k'] ?>"/>
                            <input placeholder="Link dẫn (có thể trống)" class="form-control-stg col-md-2" type="text" name="<?= Cauhinh::T?>[<?= Cauhinh::home_slogan_2?>][<?= $i?>][l]" value="<?= empty($slogan[$i]['l'])?'':$slogan[$i]['l'] ?>"/>
                            <input placeholder="Tiêu đề con" class="form-control-stg col-md-3" type="text" name="<?= Cauhinh::T?>[<?= Cauhinh::home_slogan_2?>][<?= $i?>][c]" value="<?= empty($slogan[$i]['c'])?'':$slogan[$i]['c'] ?>"/>
                            <input placeholder="Link dẫn (có thể trống)" class="form-control-stg col-md-2" type="text" name="<?= Cauhinh::T?>[<?= Cauhinh::home_slogan_2?>][<?= $i?>][cl]" value="<?= empty($slogan[$i]['cl'])?'':$slogan[$i]['cl'] ?>"/>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </fieldset>
        </div>

        <div class="stg">
            <fieldset>
                <legend>Danh mục sản phẩm - Chuyên mục</legend>
                <div class="col-md-7 pt200">
                    <div class="form-group required">
                        <div class="le"><label class="control-label" for="danhmuc-dm_ten">Danh mục sản phẩm</label></div>
                        <div class="ri">
                        <?php    
                            $data = Cauhinh::get(Cauhinh::home_danhmuc); 
                            $_Danhmuc  = Aabc::$app->_model->Danhmuc;
                            $danhmuc = $_Danhmuc::find()
                                                    ->select(['dm_id','dm_char'])
                                                    ->andWhere(['dm_type' => 1])
                                                    ->orderBy(['dm_sothutu' => SORT_ASC])
                                                    ->asArray()->all();
                          
                            echo Html::dropDownList(
                                Cauhinh::T.'['.Cauhinh::home_danhmuc.']',
                                $data,
                                ArrayHelper::map($danhmuc,'dm_id','dm_char'),
                                [
                                    'multiple'=>'multiple',
                                    Aabc::$app->d->ty => 'checkbox',                                  
                                    Aabc::$app->d->i => Sanpham::tt,
                                    Aabc::$app->d->t => 'sea',//Search
                                    'class' => 'mulr',                        
                                    'id' => 'home-dm-'.Cauhinh::tt
                                ]
                            )
                        ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 pt200">
                    <?php 
                        $data = Cauhinh::get(Cauhinh::home_danhmuc);                       
                        $slogan = Cauhinh::get(Cauhinh::home_image_dm);                        
                    ?>
                    <?php foreach ($data as $i => $value) { ?>                       
                    <div class="form-group">
                        <div class="le"><label class="control-label" for="danhmuc-dm_ten">Ảnh danh mục <?= ($i + 1)?>:</label></div>
                        <div class="ri">                            
                            <input placeholder="Link ảnh" class="form-control-stg col-md-5" type="text" name="<?= Cauhinh::T?>[<?= Cauhinh::home_image_dm?>][<?= $i?>][k]" value="<?= empty($slogan[$i]['k'])?'':$slogan[$i]['k'] ?>"/>
                            <input placeholder="Link dẫn (có thể trống)" class="form-control-stg col-md-4" type="text" name="<?= Cauhinh::T?>[<?= Cauhinh::home_image_dm?>][<?= $i?>][l]" value="<?= empty($slogan[$i]['l'])?'':$slogan[$i]['l'] ?>"/>                            
                        </div>
                    </div>
                    <?php } ?>
                </div>
              
                <hr/>

                <div class="col-md-7 pt200">
                    <div class="form-group required">
                        <div class="le"><label class="control-label" for="danhmuc-dm_ten">Chuyên mục bài viết</label></div>
                        <div class="ri">
                        <?php    
                            $data = Cauhinh::get(Cauhinh::home_chuyenmuc); 
                            $_Danhmuc  = Aabc::$app->_model->Danhmuc;
                            $danhmuc = $_Danhmuc::find()
                                                    ->select(['dm_id','dm_char'])
                                                    ->andWhere(['dm_type' => 2])
                                                    ->orderBy(['dm_sothutu' => SORT_ASC])
                                                    ->asArray()->all();
                          
                            echo Html::dropDownList(
                                Cauhinh::T.'['.Cauhinh::home_chuyenmuc.']',
                                $data,
                                ArrayHelper::map($danhmuc,'dm_id','dm_char'),
                                [
                                    // 'multiple'=>'multiple',
                                    // Aabc::$app->d->ty => 'checkbox',                                  
                                    // Aabc::$app->d->i => Sanpham::tt,
                                    // Aabc::$app->d->t => 'sea',//Search
                                    // 'class' => 'mulr',                        
                                    // 'id' => 'home-cm-'.Cauhinh::tt


                                    Aabc::$app->d->ty => 'ra',
                                    Aabc::$app->d->i => Sanpham::tt,
                                    'class' => 'mulr',      
                                    Aabc::$app->d->c => 'one',                        
                                    'id' => 'home-cm-'.Cauhinh::tt
                                ]
                            )
                        ?>
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


  
  