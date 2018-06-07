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

<div class="">   
    <style type="text/css">
        ul#editable {
            margin: 5px 0 0 0;
        }
    </style>

    <?php
        $_Cauhinh = Cauhinh::M;
        $model = new $_Cauhinh;
        $module = Cauhinh::get(Cauhinh::module.Cauhinh::template());
    ?>
    <?php $form = ActiveForm::begin(['id' => 'ch-form']); ?>
    
    <h1>Cập nhật thông tin</h1>
     
    <?php //$i id các block ?>

    <?php if($i == 1){ // ?> 
       <div class="col-md-12 pt100">
            <div class="form-group required">
                <div class="le"><label class="control-label" for="danhmuc-dm_ten">Slogan top</label></div>
                <div class="ri"><input class="form-control" type="text" name="<?= Cauhinh::T?>[<?= Cauhinh::slogan_top?>]" value="<?= Cauhinh::get(Cauhinh::slogan_top) ?>"/></div>
            </div>
        </div>  
    <?php } ?>   

    <?php if($i == 2){ // ?> 
       <div class="col-md-12 pt100">
            <div class="form-group required">
                <div class="le"><label class="control-label" for="danhmuc-dm_ten">Ảnh banner</label></div>
                <div class="ri">
                    <div class="">
                        <?= '<button type="button" '.Aabc::$app->d->m.' = "2" id="mb'.Sanpham::tt.'"  '.Aabc::$app->d->u .'="ga?i=icon" class="btn btn-success mb"   '. Aabc::$app->d->i.'='.Aabc::$app->_model->__image.'><span class="glyphicon glyphicon-plus mtrang"></span>Ảnh</button>'?>
                        <ul id="editable"> 
                            <?php
                                $value =  Cauhinh::get(Cauhinh::banner);
                                if(!empty($value)){
                                    $_Image = Aabc::$app->_model->Image;
                                    $img = $_Image::find()->andWhere([Aabc::$app->_image->image_id => $value])->one();
                                    if(isset($img)){
                                        echo '<li><input type="hidden" name="'.Cauhinh::T.'['.Cauhinh::banner.'][]" value="'.$value.'" /><img src="'.$img[Aabc::$app->_image->image_link].$img[Aabc::$app->_image->image_tenfile]. '-' . $img[Aabc::$app->_image->image_id]. $img[Aabc::$app->_image->image_morong].'"><i class="js-remove">✖</i>
                                            <br/><a target="_blank" href="'.$img[Aabc::$app->_image->image_link].$img[Aabc::$app->_image->image_tenfile]. '-' . $img[Aabc::$app->_image->image_id]. $img[Aabc::$app->_image->image_morong].'">Xem ảnh</a>
                                            </li>';
                                    }
                                }                                
                            ?>           
                        </ul>
                        <div class="selected-product-image one" dt-n="<?= Cauhinh::T.'['.Cauhinh::banner.']'?>"><input /></div>
                    </div>
                </div>


            </div>
        </div>  
    <?php } ?>  
    


    <div class="clearfix"></div>
    <div class="form-group right"> 
        <button type="submit" class="btn btn-default haserror"><span class="glyphicon glyphicon-floppy-disk mxanh"></span>Lưu</button> 

        <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-ban-circle mdo"></span>Đóng</button>      
    </div>
   <div class="clearfix"></div>
    <?php ActiveForm::end(); ?>


<?php if($i == 2){ // ?> 
<script src="./js/sortable.js"></script>
<script type="text/javascript">                
    (function () {
        'use strict';
        var byId = function (id) { return document.getElementById(id); },
            loadScripts = function (desc, callback) {
                var deps = [], key, idx = 0;

                for (key in desc) {
                    deps.push(key);
                }

                (function _next() {
                    var pid,
                        name = deps[idx],
                        script = document.createElement('script');

                    script.type = 'text/javascript';
                    script.src = desc[deps[idx]];

                    pid = setInterval(function () {
                        if (window[name]) {
                            clearTimeout(pid);

                            deps[idx++] = window[name];

                            if (deps[idx]) {
                                _next();
                            } else {
                                callback.apply(null, deps);
                            }
                        }
                    }, 30);

                    document.getElementsByTagName('head')[0].appendChild(script);
                })()
            },

            console = window.console;

        var editableList = Sortable.create(byId('editable'), {
            animation: 150,
            filter: '.js-remove',
            onFilter: function (evt) {
                evt.item.parentNode.removeChild(evt.item);
            }
        }); 
    }
    )();
</script>
<?php } ?>


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
                    popthanhcong('Cập nhật','#modal2');

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


  
  