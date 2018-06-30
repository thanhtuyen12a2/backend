<?php

use aabc\helpers\Html;
use aabc\widgets\ActiveForm;

use common\cont\D;
use common\components\Tuyen;

use backend\models\Cauhinh;
use backend\models\Danhmuc;
use backend\models\Sanpham;

use kartik\select2\Select2;
use aabc\web\JsExpression;

use aabc\helpers\ArrayHelper;
/* @var $this aabc\web\View */
//use backend\models\Danhmuc;
/* @var $form aabc\widgets\ActiveForm */
if(empty($groupmenu)) $groupmenu = '';
if(empty($pa)) $pa = '';

if(isset($_GET['nb'])){
    $nb = $_GET['nb'];
}else{
    if(!empty($model->dm_noibat)){
        $nb = $model->dm_noibat;
    }else{
        $nb = '';
    }
}

?>

<div class="<?=Aabc::$app->_model->__danhmuc?>-form">

    <?php $form = ActiveForm::begin(
        [
            'id' => Aabc::$app->_model->__danhmuc.'-form',           
        ]
        );
     ?>
    <script type="text/javascript">
      $('[data-toggle="tooltip"]').tooltip();
    </script>
      <div class="">

<style type="text/css">
    input#danhmuc-dm_ten {
        font-weight: bold;
        font-size: 13px;
    }
</style>




<div class="col-md-12 pt140">
    <?php //echo $form->field($model, Aabc::$app->_danhmuc->dm_idcha)->textInput(['data-placement' => 'right','data-trigger' => 'focus', 'data-toggle' => 'tooltip', 'title' => 'title']) ?>

    <?php 
    $_Danhmuc = Aabc::$app->_model->Danhmuc;
    
    if(!empty($pa)){        
        $pa = addslashes($pa);
        $idcha = $_Danhmuc::find()
                    ->andWhere([Aabc::$app->_danhmuc->dm_id => $pa])
                    ->one(); 
        $data = [
            $idcha->dm_id => $idcha->dm_char,
        ];          
        $groupmenu = $idcha->dm_groupmenu;         
    }else{
        if(!$model->isNewRecord){
            $groupmenu = $model->dm_groupmenu;
        }else{
            $model->dm_groupmenu = $groupmenu;
        }

        $pa = '';       
        $data = [
            '' => '---Chọn---',
        ];    
    }

    if(!$model->isNewRecord && !empty($model->dm_idcha)){
        $idcha = $_Danhmuc::find()
                    // ->andWhere([Aabc::$app->_danhmuc->dm_id => $model->dm_idcha])
                    ->andWhere(['dm_type' => $model->dm_type])
                    ->andWhere(['dm_groupmenu' => $model->dm_groupmenu])
                    ->andWhere(['<','dm_level',$model->dm_level])
                    ->andWhere(['dm_recycle' => '2'])
                    ->all(); 
        $data = ArrayHelper::map($idcha, 'dm_id', 'dm_char');
    }
    
// print_r($groupmenu);
// die;

    $menu = Cauhinh::get(Cauhinh::module.Cauhinh::template());


    $menu_current = $menu['child'][$groupmenu];


// echo '<pre>';
// print_r($menu_current);die;

if(empty($menu_current['child'])){
    echo '<p>Chưa cấu hình module này.</p>';
}else{
    $arr = $menu_current['child'];
    


            $access = null; //Các field truy cập 
            if(is_array($arr)){
                if(empty($pa)){
                    $access = $arr['1'];
                    if(!$model->isNewRecord) $access = $arr[($model->dm_level) + 1];
                }else{
                    if(!empty($idcha)){
                        if(!empty($arr[($idcha->dm_level) + 2])) $access = $arr[($idcha->dm_level) + 2];
                        $model->dm_groupmenu = $idcha->dm_groupmenu;
                    }
                }
            }        

        // print_r($access);
        // die;

        if(!empty($access)){
            if($model->dm_level > 0 ||  !empty($pa)){
                echo $form->field($model, Aabc::$app->_danhmuc->dm_idcha)->dropDownList(
                     $data,
                     [           
                        Aabc::$app->d->ty => 'ra',
                        Aabc::$app->d->i => Aabc::$app->_model->__danhmuc,
                        Aabc::$app->d->c => 'one',
                        Aabc::$app->d->t => 'sea',            
                        'class' => 'mulr',                        
                        'id' => Aabc::$app->_model->__danhmuc.'-'.Aabc::$app->_danhmuc->dm_idcha           
                    ])->label('Module cha'); 
            }
        }

}
            ?>

            <!-- <i class="hdtip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="- Chọn Danh mục cha<br/>- Nếu để trống thì Danh mục này sẽ là danh mục chính." aria-invalid="false"></i> -->
        </div>

        <?php if(!empty($access['label'])){ ?>
        <div class="col-md-12 pt140">
            <?= $form->field($model, Aabc::$app->_danhmuc->dm_ten)->textInput(['maxlength' => true])->label('Tiêu đề') ?>
        </div>
        <?php }else{
            echo '<input type="hidden" name="Kc[dm_label]" value="1"/>';
        } ?>


        <?php if(!empty($access['url'])){ ?>
        <div class="col-md-12 pt140">
            <?php                
                echo $form->field($model, 'dm_link[s]')->dropDownList(
                Cauhinh::UrlOptions(),
                 [           
                    Aabc::$app->d->ty => 'ra',
                    Aabc::$app->d->i => Aabc::$app->_model->__danhmuc,
                    Aabc::$app->d->c => 'one',
                    Aabc::$app->d->t => 'sea',            
                    'class' => 'mulr',                        
                    'id' => Aabc::$app->_model->__danhmuc.'-dm_link',
                ])->label('Link tới'); 

                echo '<div>';
                echo '<div class="ri" style="float: right;">';
                echo Cauhinh::UrlHtml('Danhmuc[dm_link][c]','danhmuc-dm_link',$model->dm_link);
                echo '</div>';
                echo '</div>';
            ?>
           
        </div>
        <?php }else{
            echo '<input type="hidden" name="Kc[dm_url]" value="1"/>';
        } ?>



        <?php if(!empty($access['email'])){ ?>
        <div class="col-md-12 pt140">
            <?= $form->field($model, 'dm_email')->textArea(['placeholder' => 'Enter để nhập thêm email khác','rows' => 2,'maxlength' => true, 'class' => 'ath form-control']) ?>    
        </div>
        <?php }else{
            echo '<input type="hidden" name="Kc[dm_email]" value="1"/>';
        } ?>

        <?php if(!empty($access['phone'])){ ?>
        <div class="col-md-12 pt140">
            <?= $form->field($model, 'dm_phone')->textArea(['placeholder' => 'Enter để nhập thêm số khác','rows' => 2,'maxlength' => true, 'class' => 'ath form-control']) ?>    
        </div>
        <?php }else{
            echo '<input type="hidden" name="Kc[dm_phone]" value="1"/>';
        } ?>


        <?php if(!empty($access['fb'])){ ?>
        <div class="col-md-12 pt140">
            <?= $form->field($model, 'dm_fb')->textArea(['placeholder' => 'Enter để nhập thêm link khác','rows' => 2,'maxlength' => true, 'class' => 'ath form-control']) ?>    
        </div>
        <?php }else{
            echo '<input type="hidden" name="Kc[dm_fb]" value="1"/>';
        } ?>

        <?php if(!empty($access['youtube'])){ ?>
        <div class="col-md-12 pt140">
            <?= $form->field($model, 'dm_youtube')->textArea(['placeholder' => 'Enter để nhập thêm link khác','rows' => 2,'maxlength' => true, 'class' => 'ath form-control']) ?>    
        </div>
        <?php }else{
            echo '<input type="hidden" name="Kc[dm_youtube]" value="1"/>';
        } ?>

        <?php if(!empty($access['viber'])){ ?>
        <div class="col-md-12 pt140">
            <?= $form->field($model, 'dm_viber')->textArea(['placeholder' => 'Enter để nhập thêm số khác','rows' => 2,'maxlength' => true, 'class' => 'ath form-control']) ?>    
        </div>
        <?php }else{
            echo '<input type="hidden" name="Kc[dm_viber]" value="1"/>';
        }?>



        <?php if(!empty($access['zalo'])){ ?>
        <div class="col-md-12 pt140">
            <?= $form->field($model, 'dm_zalo')->textArea(['placeholder' => 'Enter để nhập thêm số khác','rows' => 2,'maxlength' => true, 'class' => 'ath form-control']) ?>
        </div>
        <?php }else{
            echo '<input type="hidden" name="Kc[dm_zalo]" value="1"/>';
        } ?>


        <?php if(!empty($access['skype'])){ ?>
        <div class="col-md-12 pt140">
            <?= $form->field($model, 'dm_skype')->textArea(['placeholder' => 'Enter để nhập thêm tài khoản khác','rows' => 2,'maxlength' => true, 'class' => 'ath form-control']) ?>  
        </div>
        <?php }else{
            echo '<input type="hidden" name="Kc[dm_skype]" value="1"/>';
        } ?>

        
        <?php if(!empty($access['icon'])){
            // echo '<div class="col-md-12 pt140">';
            // echo $form->field($model, 'dm_icon')->dropDownList(
            //     Cauhinh::IconOptions(),
            //      [           
            //         Aabc::$app->d->ty => 'ra',
            //         Aabc::$app->d->i => Aabc::$app->_model->__danhmuc,
            //         Aabc::$app->d->c => 'one',
            //         Aabc::$app->d->t => 'sea',
            //         D::icon => 'icon',
            //         'class' => 'mulr',                        
            //         'id' => Aabc::$app->_model->__danhmuc.'-dm_icon',
            //     ])->label('Icon'); 
            // echo '</div>';
        }else{
            echo '<input type="hidden" name="Kc[dm_icon]" value="1"/>';
        } ?>

        <?php if(!empty($access['icon'])){ ?>

        <style type="text/css">
            ul#editable_icon .icon {
                text-align: center;
                width: 40px;
                height: 40px;
                margin: 5px auto 10px auto;
            }

            ul#editable_icon p {
                font-size: 12px;
                margin: 0;
                padding: 0;
            }

            ul#editable_icon i.js-remove {
                top: 0;
                right: -25px;
            }
        </style>

        <div class="col-md-12 pt140">   
            <div class="le"><label class="control-label" for="danhmuc-dm_icon">Icon</label></div>
            <div class="ri">
                <div class="">
                    <?= '<button type="button" '.Aabc::$app->d->m.' = "icon" '.Aabc::$app->d->u .'="gi?i=icon&e=editable_icon" class="btn btn-success mb"   '. Aabc::$app->d->i.'='.Aabc::$app->_model->__image.'><span class="glyphicon glyphicon-plus mtrang"></span>Icon</button>'?>
                    <ul id="editable_icon" class="editable"> 
                        <?php
                            $icon = $model->dm_icon; 
                            $value = explode('#',$icon);
                            
                            echo '<li><input type="hidden" name="Danhmuc[dm_icon]" value="'.$icon.'">';
                            if(!empty($icon)){
                                echo Tuyen::_icon($icon);                            
                                echo '<p>'.$value['0'].'</p>';
                                echo '<i class="js-remove">✖</i>';
                            }
                            echo '</li>';
                           
                        ?>           
                    </ul>
                    <div class="selected-product-icon one hide" d-mau='' dt-n="<?= 'Danhmuc[dm_icon]'?>"></div>
                </div>
            </div>
            
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

                    var editableList = Sortable.create(byId('editable_icon'), {
                        animation: 150,
                        filter: '.js-remove',
                        onFilter: function (evt) {
                            evt.item.parentNode.removeChild(evt.item);
                        }
                    }); 
                }
                )();
            </script>
        </div>
        <?php } ?>



        <?php if(!empty($access['background'])){ ?>
        <div class="col-md-12 pt140">   
            <div class="le"><label class="control-label" for="danhmuc-dm_ten">Hình ảnh</label></div>
            <div class="ri">
                <div class="">
                    <?= '<button type="button" '.Aabc::$app->d->m.' = "2" '.Aabc::$app->d->u .'="ga?i=icon" class="btn btn-success mb"   '. Aabc::$app->d->i.'='.Aabc::$app->_model->__image.'><span class="glyphicon glyphicon-plus mtrang"></span>Ảnh</button>'?>
                    <ul id="editable" class="editable"> 
                        <?php
                            $background = $model->dm_background;                                    
                            if(!empty($background)){                                
                                $img = '';                                
                                $img = Tuyen::_dulieu('image',$background,'75x75');
                                $img_goc = Tuyen::_dulieu('image',$background);
                                
                                if(!empty($img)){                                            
                                    echo '<li><input type="hidden" name="Danhmuc[dm_background]" value="'.$background.'" />';
                                    echo '<img src="'.$img.'" /><i class="js-remove">✖</i>
                                        <br/><a target="_blank" href="'.$img_goc.'">Xem ảnh</a>
                                        </li>';
                                }
                            }                                
                        ?>           
                    </ul>
                    <div class="selected-product-image one hide" dt-n="<?= 'Danhmuc[dm_background]'?>"><input /></div>
                </div>
            </div>
            
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
        </div>
        <?php }else{
            echo '<input type="hidden" name="Kc[dm_background]" value="1"/>';
        } ?>


        <?php if(!empty($nb)){ ?>
            
                <div class="clearfix"></div>
                <style type="text/css">hr {margin: 0;}</style>
                <hr />              
                <div class="col-md-12 col-sm-5  col-xs-12 pt140" style="margin: 10px 0 0 0;">                    
                    <?php if(!$model->isNewRecord){ ?>  
                        <div>
                        <?php     
                            // $_Danhmuc  = Aabc::$app->_model->Danhmuc;                
                            
                            // echo $form->field($model,'list_sp_noibat',['options' => ['class' => '']])->dropDownList(
                            //     $_Danhmuc::getSanphamOption(),
                            //     [
                                    
                            //         'multiple'=>'multiple',
                            //         Aabc::$app->d->ty => 'checkbox',
                               
                            //         Aabc::$app->d->i => 'danhmuc',
                            //         Aabc::$app->d->t => 'sea',//Search
                            //         'class' => 'mulr',                        
                            //         // 'id' => Sanpham::tt.'-sp_id_thuonghieu'
                            //         'id' => Aabc::$app->_model->__danhmuc.'-nb'
                            //     ])->label('Sản phẩm nổi bật'); 

                            $html = '';
                            $url_tvbkt = ADMIN.Sanpham::tt.'/'.Sanpham::search.'?dm='.$model->dm_id;
                            $data = [];
                            $value = '';

                            echo Select2::widget([
                                'name' => 'select_spnb',
                                'value' => $value,
                                'data' => $data,
                                'options' => [
                                    'id' => 'select_spnb',
                                    'placeholder' => 'Tìm và thêm sản phẩm vào danh mục này.'
                                ],
                                'pluginOptions' => [
                                    'allowClear' => true,
                                    'minimumInputLength' => 2,
                                    'ajax' => [
                                        'url' => $url_tvbkt,
                                        'dataType' => 'json',
                                        'method' => 'POST',
                                        'data' => new JsExpression('function(params) { return {q:params.term}; }')
                                    ],  
                                    'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                                    'templateResult' => new JsExpression('function(model) {
                                        if(isEmpty(model.img)){
                                            img_html = "";
                                        }else{
                                            img_html = "<img src=" + model.img + " /> "  + " ";
                                        }
                                        if(isEmpty(model.check)){
                                            check_html = "";
                                        }else{
                                            check_html = " <span class=\'glyphicon glyphicon-ok text-success\'></span> ";
                                        }
                                        return  check_html + img_html + model.text;
                                    }'),
                                    // 'templateSelection' => new JsExpression('function (model) { return model.text; }'),          
                                ],                                

                            ])
                        ?>

                            <script type="text/javascript">
                                $('select#select_spnb').change(function(){
                                    value = $(this).val();
                                    loadimg();                        
                                    $.ajax({
                                        cache: false,
                                        url: '<?= ADMIN.Sanpham::tt.'/'.Sanpham::addspdm; ?>',
                                        type: 'POST',
                                        data:{
                                            sp : value,
                                            dm : <?= $model->dm_id?>,
                                        },
                                        success: function (data) {   
                                            $('#spdm_nb').html(data);
                                            unloadimg();
                                        },
                                        error: function () {
                                            poploi();                    
                                        }
                                    });

                                    $(this).val('');
                                })
                            </script>
                        </div>
    
                        <h4 class="text-center">Danh sách sản phẩm <i>(Đã thêm)</i></h4>
                        <div id="spdm_nb">
                            <?php 
                                // echo $this->renderAjax('sanpham/addspdm', [    
                                echo Aabc::$app->controller->renderPartial('../sanpham/addspdm',[            
                                    'iddanhmuc' => $model->dm_id,
                                ]);
                            ?>
                        </div>

                    <?php }else{ echo '<i class="text-center">Sau khi Lưu trữ Danh mục thì mới thêm Sản phẩm vào danh sách.</i>'; } ?>
                </div>
            
            <div class="clearfix"></div>
            <br/>
            <?php if(!$model->isNewRecord){ ?> 
                <div class="col-md-12 pt140">
                    <?php //  $form->field($model, 'dm_showmax')->textInput(['type' => 'number', 'placeholder' => 'Số sản phẩm hiển thị. Ví Dụ: 10','maxlength' => true, 'class' => 'form-control']) ?>  
                </div>
            <?php } ?>
        <?php } ?>


        <!-- 
        <div class="col-md-12 col-sm-6  col-xs-12 pt140">

            <?php     
                // $_Chinhsach  = Aabc::$app->_model->Chinhsach;                
                // $chinhsach = $_Chinhsach::find()
                //                 ->andWhere([Aabc::$app->_chinhsach->cs_apdungcho => ['1','2']] )
                //                 ->andWhere([Aabc::$app->_chinhsach->cs_status => '1'])
                //                 ->andWhere([Aabc::$app->_chinhsach->cs_recycle => '2'])
                //                 ->andWhere([Aabc::$app->_chinhsach->cs_type => '1'])
                //                 ->orderBy([Aabc::$app->_chinhsach->cs_apdungcho => SORT_ASC])
                //                 ->all();

                // foreach ($chinhsach as $keycs => $valuecs) {
                //     if($chinhsach[$keycs][Aabc::$app->_chinhsach->cs_apdungcho] == 1){
                //         $chinhsach[$keycs][Aabc::$app->_chinhsach->cs_ten] = '<i>Tất cả</i>'.$chinhsach[$keycs][Aabc::$app->_chinhsach->cs_ten] .'#$'.$chinhsach[$keycs][Aabc::$app->_chinhsach->cs_apdungcho];
                //     }            
                // }

                // array_unshift($chinhsach,[
                //     Aabc::$app->_chinhsach->cs_id => '',
                //     Aabc::$app->_chinhsach->cs_ten =>'---Chọn---',
                // ]);//Thêm vào đầu
                // echo $form->field($model, Aabc::$app->_danhmuc->dm_id_chinhsach,['options' => ['class' => '']])->dropDownList(ArrayHelper::map($chinhsach,Aabc::$app->_chinhsach->cs_id,Aabc::$app->_chinhsach->cs_ten),[
                        
                //         'multiple'=>'multiple',
                //         Aabc::$app->d->ty => 'checkbox',
                        
                //         // Aabc::$app->d->ty => 'ra',
                //         // Aabc::$app->d->c => 'one',
                //         // Aabc::$app->d->add => 'ip',
                //         // d-add chỉ cần cho d-u, còn d-i của url sẽ được lấy ở fk- bên dưới

                //         Aabc::$app->d->i => Aabc::$app->_model->__danhmuc,
                //         Aabc::$app->d->t => 'sea',//Search
                //         'class' => 'mulr',                        
                //         // 'id' => Aabc::$app->_model->__sanpham.'-sp_id_thuonghieu'
                //         'id' => 'fk-'.Aabc::$app->_model->__chinhsach.'-km-'.Aabc::$app->_model->__danhmuc
                //     ])->label('Chính sách'); 
            ?>
            <i class="hdtip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="- Các Chương trình khuyến mại tặng kèm khi khách hàng mua <b>Sản phẩm</b> thuộc <b>Danh mục</b> này.<br/>- Các chương trình áp dụng cho <b>Tất cả sản phẩm</b> sẽ được ghim lên trên và được chọn tự động." aria-invalid="false"></i>
        </div>
         -->




        <!-- 

        <div class="col-md-12 col-sm-6  col-xs-12 pt140">

            <?php     
                // $_Chinhsach  = Aabc::$app->_model->Chinhsach;                
                // $chinhsach = $_Chinhsach::find()
                //                 ->andWhere([Aabc::$app->_chinhsach->cs_apdungcho => ['1','2']] )
                //                 ->andWhere([Aabc::$app->_chinhsach->cs_status => '1'])
                //                 ->andWhere([Aabc::$app->_chinhsach->cs_recycle => '2'])
                //                 ->andWhere([Aabc::$app->_chinhsach->cs_type => '2'])
                //                 ->orderBy([Aabc::$app->_chinhsach->cs_apdungcho => SORT_ASC])
                //                 ->all();

                // foreach ($chinhsach as $keycs => $valuecs) {
                //     if($chinhsach[$keycs][Aabc::$app->_chinhsach->cs_apdungcho] == 1){
                //         $chinhsach[$keycs][Aabc::$app->_chinhsach->cs_ten] = '<i>Tất cả</i>'.$chinhsach[$keycs][Aabc::$app->_chinhsach->cs_ten] .'#$'.$chinhsach[$keycs][Aabc::$app->_chinhsach->cs_apdungcho];
                //     }            
                // }

                // array_unshift($chinhsach,[
                //     Aabc::$app->_chinhsach->cs_id => '',
                //     Aabc::$app->_chinhsach->cs_ten =>'---Chọn---',
                // ]);//Thêm vào đầu
                // echo $form->field($model, Aabc::$app->_danhmuc->dm_id_chinhsach,['options' => ['class' => '']])->dropDownList(ArrayHelper::map($chinhsach,Aabc::$app->_chinhsach->cs_id,Aabc::$app->_chinhsach->cs_ten),[
                        
                //         'multiple'=>'multiple',
                //         Aabc::$app->d->ty => 'checkbox',
                        
                //         // Aabc::$app->d->ty => 'ra',
                //         // Aabc::$app->d->c => 'one',
                //         // Aabc::$app->d->add => 'ip',
                //         // d-add chỉ cần cho d-u, còn d-i của url sẽ được lấy ở fk- bên dưới

                //         Aabc::$app->d->i => Aabc::$app->_model->__danhmuc,
                //         Aabc::$app->d->t => 'sea',//Search
                //         'class' => 'mulr',                        
                //         // 'id' => Aabc::$app->_model->__sanpham.'-sp_id_thuonghieu'
                //         'id' => 'fk-'.Aabc::$app->_model->__chinhsach.'-bh-'.Aabc::$app->_model->__danhmuc
                //     ])->label('Bảo hành'); 
            ?>
            <i class="hdtip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="- Các Chương trình khuyến mại tặng kèm khi khách hàng mua <b>Sản phẩm</b> thuộc <b>Danh mục</b> này.<br/>- Các chương trình áp dụng cho <b>Tất cả sản phẩm</b> sẽ được ghim lên trên và được chọn tự động." aria-invalid="false"></i>
        </div> -->






        <!-- 


        <div class="col-md-12 pt140">
            <?php //echo $form->field($model, Aabc::$app->_danhmuc->dm_icon)->textInput(['maxlength' => true,'data-placement' => 'right','data-trigger' => 'focus', 'data-toggle' => 'tooltip', 'title' => 'title']) ?>
        </div>

        <div class="col-md-12 pt140">
            <?php //echo $form->field($model, Aabc::$app->_danhmuc->dm_background)->textInput(['maxlength' => true,'data-placement' => 'right','data-trigger' => 'focus', 'data-toggle' => 'tooltip', 'title' => 'title']) ?>
        </div>

        <div class="col-md-12 pt140">
            <?php //echo $form->field($model, Aabc::$app->_danhmuc->dm_link)->textInput(['maxlength' => true,'data-placement' => 'right','data-trigger' => 'focus', 'data-toggle' => 'tooltip', 'title' => 'title']) ?>
        </div>


        <div class="col-md-12 pt140">
            <?php //echo $form->field($model, Aabc::$app->_danhmuc->dm_ghichu)->textInput(['maxlength' => true,'data-placement' => 'right','data-trigger' => 'focus', 'data-toggle' => 'tooltip', 'title' => 'title']) ?>
        </div> -->


            <?php 
                if($model[Aabc::$app->_danhmuc->dm_status] == NULL) $model[Aabc::$app->_danhmuc->dm_status] = 1;
            ?>
            <?= $form->field($model, Aabc::$app->_danhmuc->dm_status,['options' => ['class' => 'hide']])->dropDownList([1 => 'Xuất bản##mgr', 2 => 'Không hiển thị##mre', ],[
                                //'multiple'=>'multiple', 
                                // Aabc::$app->d->s => 'search', 
                                Aabc::$app->d->t => 'show',
                                Aabc::$app->d->ty => 'ra',
                                Aabc::$app->d->i => Aabc::$app->_model->__danhmuc,
                                'class' => 'mulr',      
                                Aabc::$app->d->c => 'one',                        
                                'id' => Aabc::$app->_model->__danhmuc.'_dm_status_select'
                            ])->label(false) ?>


            <?= $form->field($model, Aabc::$app->_danhmuc->dm_groupmenu,['options' => ['class' => 'hide']])->dropDownList([ '' => '--Chọn--', 1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5', 6 => '6', 7 => '7', 8 => '8', 9 => '9', 10 => '10', ],['data-placement' => 'right','data-trigger' => 'focus','data-html' => 'true', 'data-toggle' => 'tooltip','title' => 'title',
                                //'multiple'=>'multiple', 
                                // Aabc::$app->d->s => 'search', 
                                Aabc::$app->d->ty => 'ra',
                                Aabc::$app->d->i => Aabc::$app->_model->__danhmuc,
                                'class' => 'mulr',      
                                Aabc::$app->d->c => 'one',                        
                                'id' => Aabc::$app->_model->__danhmuc.'_dm_groupmenu_select'
                            ])->label(false) ?>




            </div>

        <?php if(!empty($access)){ ?>

            <div class="form-group right"> 
               <!-- <button <?php // Aabc::$app->d->i?>=<?php //Aabc::$app->_model->__danhmuc?> type="submit" class="btn btn-default haserror lvt"><span class="glyphicon glyphicon-floppy-disk mxanh"></span>Lưu và Thêm</button> -->

               <button type="submit" class="btn btn-default haserror"><span class="glyphicon glyphicon-floppy-disk mxanh"></span>Lưu</button>

                <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-ban-circle mdo"></span>Đóng</button>
            </div>
        <?php }else{
            if(!empty($arr)) echo 'Danh mục này không thể tạo thêm cấp nhỏ hơn!';

        } ?>

    

    <?php ActiveForm::end(); ?>

    <div class="clearfix"></div>
</div>



<script type="text/javascript">  


    $('#danhmuc-dm_ten').on('keyup keypress',function(){
        $('#danhmuc-dm_link').val(urlfriendly($(this).val()));        
    });

  
    $('.ath').on('keydown keypress', function(e){
        autoheight(this);       
    });
    setTimeout( function(){ 
        $('.ath').each(function (){
            autoheight(this);           
        });
     }, 500);
    setTimeout( function(){ 
        $('.ath').each(function (){
            autoheight(this);
        });
     }, 1500);




    $('.modal-content #<?=Aabc::$app->_model->__danhmuc?>-form input').on('keyup keypress', function(e) {
          var keyCode = e.keyCode || e.which;
          if (keyCode === 13) { 
            e.preventDefault();
            return false;
          }
    });


$('form#<?=Aabc::$app->_model->__danhmuc?>-form').on('beforeSubmit', function(e) {
    // console.log($(this));
    loadimg();
    var form = $(this);
    var formData = form.serialize();
    $.ajax({
        url: form.attr("action"),
        type: form.attr("method"),
        data: formData,
        success: function (data) {
             reload('<?=Aabc::$app->_model->__danhmuc?>');   
            pjelm('<?=Aabc::$app->_model->__danhmuc?>','');

            if(data == 1){ 
                popthanhcong('','#<?php  if(isset($_POST['modal'])) echo $_POST['modal']?>');
            }else{
                popthatbai('');
            }  

            lvtok('<?=Aabc::$app->_model->__danhmuc?>');
        },
        error: function () {
            reload('<?=Aabc::$app->_model->__danhmuc?>');
            poploi();
        }
    });
}).on('submit', function(e){
    e.preventDefault();
});
</script>