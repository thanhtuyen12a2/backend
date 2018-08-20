<?php

use aabc\helpers\Html;
use aabc\widgets\ActiveForm;
use aabc\helpers\ArrayHelper;

use kartik\select2\Select2;
use aabc\web\JsExpression;

use backend\models\Sanpham;
use common\components\Tuyen;

use backend\models\Cauhinh;

/* @var $this aabc\web\View */
//use backend\models\Chinhsach;
/* @var $form aabc\widgets\ActiveForm */
?>

<div class="<?=Aabc::$app->_model->__chinhsach?>-form">

    <?php $form = ActiveForm::begin(
        [
            'id' => Aabc::$app->_model->__chinhsach.'-form',
            // 'enableClientValidation' => false,
            // 'enableAjaxValidation' => true,
            //'validationUrl' => ['validate'],
            // 'validateOnBlur' => false,
            // 'validateOnChange' => false
            //'enableAjaxValidation' => true,
        ]
        );
     ?>
    <script type="text/javascript">
      $('[data-toggle="tooltip"]').tooltip();
    </script>

<div class="clearfix" style="background: #FFF;padding: 20px 10px;">

<div class="col-md-12  pt160">
    <?= $form->field($model, Html::encode(Aabc::$app->_chinhsach->cs_ten))->textArea(['placeholder' => 'VD: Tặng chuột quang không dây trị giá 150.000đ' ,'maxlength' => true])->label('Tiêu đề')  ?>

    <i class="hdtip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="- Tên chương trình khuyến mại tặng kèm." aria-invalid="false"></i>
</div>






<div class="col-md-12  pt160">
    <?= $form->field($model, Aabc::$app->_chinhsach->cs_apdungcho)->dropDownList([
             1 => 'Tất cả sản phẩm', 
             2 => 'Danh mục sản phẩm (cụ thể)',
             3 => 'Từng Sản phẩm (cụ thể)',
         ],['placeholder' => '',
        //'multiple'=>'multiple', 
        // Aabc::$app->d->s => 'search', 
        // Aabc::$app->d->t => 'show', 
        Aabc::$app->d->ty => 'ra',
        Aabc::$app->d->i => Aabc::$app->_model->__chinhsach,
        'class' => 'mulr',      
        Aabc::$app->d->c => 'one',                        
        'id' => Aabc::$app->_model->__chinhsach.'_'.Aabc::$app->_chinhsach->cs_apdungcho.'_select'
    ]) ?>

    <i class="hdtip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="- Tất cả: Chương trình áp dụng cho tất cả các sản phẩm.<br/>- Danh mục sản phẩm: Áp dụng cho một vài Danh mục cụ thể<br/>- Từng sản phẩm: Áp dụng cho một vài sản phẩm cụ thể" aria-invalid="false"></i>                
</div>
<script type="text/javascript">
    $("#<?= Aabc::$app->_model->__chinhsach.'_'.Aabc::$app->_chinhsach->cs_apdungcho.'_select' ?>-pa input").on('change', function() { 

        if($(this).val() == 2){
            $('.field-hi-<?= Aabc::$app->_model->__danhmuc?>').removeClass('hide');
            $('.field-hi-<?= Aabc::$app->_model->__sanpham?>').addClass('hide');
        }else if($(this).val() == 3){
            $('.field-hi-<?= Aabc::$app->_model->__danhmuc?>').addClass('hide');
            $('.field-hi-<?= Aabc::$app->_model->__sanpham?>').removeClass('hide');
        }else{            
            $('.field-hi-<?= Aabc::$app->_model->__danhmuc?>').addClass('hide');
            $('.field-hi-<?= Aabc::$app->_model->__sanpham?>').addClass('hide');
        }
    });   
</script>


<div class="col-md-12 col-sm-6  col-xs-12 pt160"  style="margin: 0 0 0 15px;width: calc(100% - 15px);">
    <?php     
        // $_Danhmuc  = Aabc::$app->_model->Danhmuc;                
        // $danhmuc = $_Danhmuc::getAll1_1();                    
        // array_unshift($danhmuc,[
        //     Aabc::$app->_danhmuc->dm_id => '',
        //     Aabc::$app->_danhmuc->dm_char =>'---Chọn---',
        // ]);//Thêm vào đầu
        // $danhmuc_hide = ($model[Aabc::$app->_chinhsach->cs_apdungcho] == 2 ? '' : 'hide');        
        // echo $form->field($model, Aabc::$app->_chinhsach->cs_id_danhmuc,['options' => ['class' => $danhmuc_hide]])->dropDownList(ArrayHelper::map($danhmuc,Aabc::$app->_danhmuc->dm_id,Aabc::$app->_danhmuc->dm_char),[                                    
        //         'multiple'=>'multiple',
        //         Aabc::$app->d->ty => 'checkbox',
        //         // Aabc::$app->d->ty => 'ra',
        //         // Aabc::$app->d->c => 'one',
        //         // Aabc::$app->d->add => 'ip',
        //         // d-add chỉ cần cho d-u, còn d-i của url sẽ được lấy ở fk- bên dưới
        //         Aabc::$app->d->i => Aabc::$app->_model->__chinhsach,
        //         Aabc::$app->d->t => 'sea',//Search
        //         'class' => 'mulr',                        
        //         // 'id' => Aabc::$app->_model->__sanpham.'-sp_id_thuonghieu'
        //         'id' => 'hi-'.Aabc::$app->_model->__danhmuc
        //     ])->label(Aabc::$app->_chinhsach->__cs_id_danhmuc); 

        $danhmuc_hide = 'field-hi-danhmuc '.($model[Aabc::$app->_chinhsach->cs_apdungcho] == 2 ? '' : 'hide');   

        $dm = [];
        $_Danhmuc  = Aabc::$app->_model->Danhmuc; 
        $list_dm = $_Danhmuc::find()
                    ->select(['dm_id', 'dm_ten'])
                    ->andWhere(['dm_id' => $model->cs_id_danhmuc])
                    ->all();
        if($list_dm) $dm = ArrayHelper::map($list_dm,'dm_id','dm_ten');

        echo $form->field($model, 'cs_id_danhmuc', ['options' => ['class' => $danhmuc_hide]])->widget(Select2::classname(), [
            'data' =>  $dm,            
            'options' => [
                'placeholder' => 'Tìm và chọn danh mục ...'
            ],
            'pluginOptions' => [
                'allowClear' => true,
                'multiple' => true,
                'ajax' => [
                    'url' => '/ad/'.Sanpham::tt.'/'.Sanpham::search.'?t=3',
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
                    return  img_html + model.text;
                }'),
            ],
        ])->label('');

    ?>

    <i class="field-hi-danhmuc hide hdtip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="Chọn Danh mục sản phẩm mà bạn muốn áp dụng khuyến mại." aria-invalid="false"></i>
    
</div>


<div class="col-md-12 col-sm-6  col-xs-12 pt160" style="margin: 0 0 0 15px;width: calc(100% - 15px);">
    <?php     
        // $_Sanpham  = Aabc::$app->_model->Sanpham;                
        // $sanpham = $_Sanpham::getAll1_1();

        // array_unshift($sanpham,[
        //     Aabc::$app->_sanpham->sp_id => '',
        //     Aabc::$app->_sanpham->sp_tensp =>'---Chọn---',
        // ]);//Thêm vào đầu
        // $sanpham_hide = ($model[Aabc::$app->_chinhsach->cs_apdungcho] == 3 ? '' : 'hide'); 
        // echo $form->field($model, Aabc::$app->_chinhsach->cs_id_sp,['options' => ['class' => $sanpham_hide]])->dropDownList(ArrayHelper::map($sanpham,Aabc::$app->_sanpham->sp_id,Html::encode(Aabc::$app->_sanpham->sp_tensp)),[
        //             'multiple'=>'multiple',
        //             Aabc::$app->d->ty => 'checkbox',
        //             // Aabc::$app->d->ty => 'ra',
        //             // Aabc::$app->d->c => 'one',
        //             // Aabc::$app->d->add => 'ip',
        //             // d-add chỉ cần cho d-u, còn d-i của url sẽ được lấy ở fk- bên dưới
        //             Aabc::$app->d->i => Aabc::$app->_model->__chinhsach,
        //             Aabc::$app->d->t => 'sea',//Search
        //             'class' => 'mulr',                        
        //             // 'id' => Aabc::$app->_model->__sanpham.'-sp_id_thuonghieu'
        //             'id' => 'hi-'.Aabc::$app->_model->__sanpham
        //     ])->label(Aabc::$app->_chinhsach->__cs_id_sp); 

        $sanpham_hide = 'field-hi-sanpham '. ($model[Aabc::$app->_chinhsach->cs_apdungcho] == 3 ? '' : 'hide'); 


        $sp = [];        
        $list_sp = (Sanpham::M)::find()
                    ->select(['sp_id', 'sp_tensp'])
                    ->andWhere(['sp_id' => $model->cs_id_sp])
                    ->all();
        if($list_sp) $sp = ArrayHelper::map($list_sp,'sp_id','sp_tensp');

        // echo '<pre>';
        // print_r($sp);
        // echo '</pre>';

        echo $form->field($model,'cs_id_sp', ['options' => ['class' => $sanpham_hide]])->widget(Select2::classname(), [
            'data' => $sp,            
            'options' => [
                'placeholder' => 'Tìm và chọn sản phẩm ...'
            ],
            'pluginOptions' => [
                'allowClear' => true,
                'multiple' => true,
                'ajax' => [
                    'url' => '/ad/'.Sanpham::tt.'/'.Sanpham::search.'?t=4',
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
                    return  img_html + model.text;
                }'),
            ],
        ])->label('');
    ?>

    <i class="field-hi-sanpham hide hdtip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="Chọn Sản phẩm mà bạn muốn áp dụng khuyến mại." aria-invalid="false"></i>
   
</div>







<!-- <div class="col-md-12  pt160">
    <?php // $form->field($model, Html::encode(Aabc::$app->_chinhsach->cs_ghichu))->textArea(['placeholder' => '' ,'maxlength' => true]) ?>
    <i class="hdtip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="- Ghi chú chi tiết về chương trình khuyến mại tặng kèm." aria-invalid="false"></i>
</div> -->


<div class="col-md-12  pt160"  style="margin: 10px 0 0 0;">
    <?= $form->field($model, 'cs_tylechietkhau')->textArea(['placeholder' => 'VD: 150.000' ,'maxlength' => true])->label('Giảm trừ')  ?>
    <i class="hdtip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="- Trong đơn hàng thanh toán, số tiền của khách hàng phải trả sẽ được giảm trừ." aria-invalid="false"></i>
</div>









<div class="col-md-12 col-sm-5 col-xs-12 pt160"> 
        <?php 
            if($model[Aabc::$app->_chinhsach->cs_ngaybatdau] == null){
                $model[Aabc::$app->_chinhsach->cs_ngaybatdau] = date("Y-m-d");
            }else{                 
                $model[Aabc::$app->_chinhsach->cs_ngaybatdau] = date("Y-m-d", strtotime($model[Aabc::$app->_chinhsach->cs_ngaybatdau]));               
            }
        ?>


        <?= $form->field($model, Aabc::$app->_chinhsach->cs_ngaybatdau,['options' => ['class' => '']])->widget(\dosamigos\datetimepicker\DateTimePicker::className(), [
            // 'size' => 'ms',
            // 'template' => '{input}',
            'pickButtonIcon' => 'glyphicon glyphicon-time',
            'pickButtonIcon' => 'glyphicon glyphicon-calendar',
            'inline' => false,
            'clientOptions' => [
                // 'startView' => 1,
                'minView' => 2,
                // 'maxView' => 1,
                'autoclose' => true,
                // 'linkFormat' => 'HH:ii:ss dd-mm-yyyy', // if inline = true
                // 'format' => 'HH:ii P', // if inline = false
                // 'format' => ' hh:ii:ss dd-mm-yyyy',
                'format' => 'yyyy-mm-dd',

                'todayBtn' => true
            ]
        ]);?>

        <i class="hdtip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="- Ngày bắt đầu chương trình này." aria-invalid="false"></i> 
    </div>


<div class="col-md-12 col-sm-5 col-xs-12 pt160"> 
        <?php 
            if($model[Aabc::$app->_chinhsach->cs_ngayketthuc] == null){
                // $model[Aabc::$app->_chinhsach->cs_ngayketthuc] = date("Y-m-d H:i");
            }else{                 
                $model[Aabc::$app->_chinhsach->cs_ngayketthuc] = date("Y-m-d", strtotime($model[Aabc::$app->_chinhsach->cs_ngayketthuc]));               
            }
        ?>


        <?= $form->field($model, Aabc::$app->_chinhsach->cs_ngayketthuc,['options' => ['class' => '']])->widget(\dosamigos\datetimepicker\DateTimePicker::className(), [
            // 'size' => 'ms',
            // 'template' => '{input}',
            'pickButtonIcon' => 'glyphicon glyphicon-time',
            'pickButtonIcon' => 'glyphicon glyphicon-calendar',
            'inline' => false,
            'clientOptions' => [
                // 'startView' => 1,
                'minView' => 2,
                // 'maxView' => 1,
                'autoclose' => true,
                // 'linkFormat' => 'HH:ii:ss dd-mm-yyyy', // if inline = true
                // 'format' => 'HH:ii P', // if inline = false
                // 'format' => ' hh:ii:ss dd-mm-yyyy',
                'format' => 'yyyy-mm-dd',

                'todayBtn' => true
            ]
        ]);?>

        <i class="hdtip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="- Ngày kết thúc chương trình.<br/>- Nếu để trống thì chương trình sẽ chạy mãi mãi." aria-invalid="false"></i> 
    </div>






<div class="col-md-12 pt160">
    <?php                
        echo $form->field($model, 'cs_link[s]')->dropDownList(
        Cauhinh::UrlOptions(),
         [           
            Aabc::$app->d->ty => 'ra',
            Aabc::$app->d->i => Aabc::$app->_model->__chinhsach,
            Aabc::$app->d->c => 'one',
            Aabc::$app->d->t => 'sea',            
            'class' => 'mulr',                        
            'id' => Aabc::$app->_model->__chinhsach.'-cs_link',
        ])->label('Link bài viết'); 

        echo '<div>';
        echo '<div class="ri" style="float: right;">';
        echo Cauhinh::UrlHtml('Chinhsach[cs_link][c]','chinhsach-cs_link',$model->cs_link);
        echo '</div>';
        echo '</div>';
    ?>
    
    <i class="hdtip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="- Lựa chọn bài viết mô tả chi tiết về khuyến mại này giúp người dùng hiểu rõ hơn. Có thể để trống." aria-invalid="false"></i>
</div>


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

        <div class="col-md-12 pt160">   
            <div class="le"><label class="control-label" for="chinhsach-cs_icon">Icon</label></div>
            <div class="ri">
                <div class="">
                    <?= '<button type="button" '.Aabc::$app->d->m.' = "icon" '.Aabc::$app->d->u .'="gi?i=icon&e=editable_icon" class="btn btn-success mb"   '. Aabc::$app->d->i.'='.Aabc::$app->_model->__image.'><span class="glyphicon glyphicon-plus mtrang"></span>Icon</button>'?>
                    <ul id="editable_icon" class="editable"> 
                        <?php
                            $icon = $model->cs_icon; 
                            $value = explode('#',$icon);
                            
                            echo '<li><input type="hidden" name="Chinhsach[cs_icon]" value="'.$icon.'">';
                            if(!empty($icon)){
                                echo Tuyen::_icon($icon);                            
                                echo '<p>'.$value['0'].'</p>';
                                echo '<i class="js-remove">✖</i>';
                            }
                            echo '</li>';
                           
                        ?>           
                    </ul>
                    <div class="selected-product-icon one hide" d-mau='' dt-n="<?= 'Chinhsach[cs_icon]'?>"></div>
                </div>
            </div>
            
            <i class="hdtip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="- Icon hiển thị bên cạnh tên khuyến mại tại trang ngoài." aria-invalid="false"></i> 

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



<div class="col-md-12  pt160">
    <?= $form->field($model, Aabc::$app->_chinhsach->cs_status)->dropDownList([ 1 => 'Kích hoạt', 2 => 'Ngừng kích hoạt##mre', ],['placeholder' => '' ,'data-placement' => 'top', 'data-html' => 'true','data-trigger' => 'focus','data-html' => 'true', 'data-toggle' => 'tooltip','title' => '',
            //'multiple'=>'multiple', 
            // Aabc::$app->d->s => 'search', 
            Aabc::$app->d->t => 'show', 
            Aabc::$app->d->ty => 'ra',
            Aabc::$app->d->i => Aabc::$app->_model->__chinhsach,
            'class' => 'mulr',      
            Aabc::$app->d->c => 'one',                        
            'id' => Aabc::$app->_model->__chinhsach.'_cs_status_select'
        ]) ?>
    <i class="hdtip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="- Trạng thái của Chương trình này: Kích hoạt hoặc Ngừng kích hoạt." aria-invalid="false"></i> 
</div>



    </div>

    <div class="form-group right">
        <button <?= Aabc::$app->d->i?> = <?= Aabc::$app->_model->__chinhsach ?> type="submit" class="btn btn-default haserror lvt"><span class="glyphicon glyphicon-floppy-disk mxanh"></span>Lưu và Thêm</button>

        <button type="submit" class="btn btn-default haserror"><span class="glyphicon glyphicon-floppy-disk mxanh"></span>Lưu</button>

        <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-ban-circle mdo"></span>Đóng</button>
    </div>




    <?php ActiveForm::end(); ?>

</div>



<script type="text/javascript">  

  

    $('.modal-content #<?=Aabc::$app->_model->__chinhsach?>-form').on('keyup keypress', function(e) {
      var keyCode = e.keyCode || e.which;
      if (keyCode === 13) { 
        e.preventDefault();
        return false;
      }
    });


$('form#<?=Aabc::$app->_model->__chinhsach?>-form').on('beforeSubmit', function(e) {
    loadimg();
    var form = $(this);
    var formData = form.serialize();
    $.ajax({
        url: form.attr("action"),
        type: form.attr("method"),
        data: formData,
        success: function (data) {
            reload('<?=Aabc::$app->_model->__chinhsach?>');  
            
            //update element
            // pjelm('<?=Aabc::$app->_model->__chinhsach?>');  

            if(data == 1){ 
                popthanhcong('','#<?php  if(isset($_POST['modal'])) echo $_POST['modal']?>');
            }else{
                popthatbai('');
            }            
            lvtok('<?=Aabc::$app->_model->__chinhsach?>');
        },
        error: function () {
            reload('<?=Aabc::$app->_model->__chinhsach?>');
            poploi();
        }
    });
}).on('submit', function(e){
    e.preventDefault();
});
</script>