<?php

use aabc\helpers\Html;
use aabc\widgets\ActiveForm;

use common\cont\D;
use common\components\Tuyen;

use aabc\helpers\ArrayHelper;
/* @var $this aabc\web\View */
//use backend\models\Danhmuc;
/* @var $form aabc\widgets\ActiveForm */
?>

<div class="<?=Aabc::$app->_model->__danhmuc?>-form-5">

    <?php $form = ActiveForm::begin(
        [
            'id' => Aabc::$app->_model->__danhmuc.'-form-5',
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
      <div class="">
      


<div class="col-md-12  row pt120">    
    <?php 
    $_Danhmuc = Aabc::$app->_model->Danhmuc;
    $model->dm_dmsp = '';

    $level = (int)$model->dm_level;

    if(!empty(Aabc::$app->request->get('pa'))){
        $pa = Aabc::$app->request->get('pa');
        $pa = addslashes($pa);
        $idcha = $_Danhmuc::find()
                    ->andWhere([Aabc::$app->_danhmuc->dm_id => $pa])
                    ->one();

        $model->dm_dmsp = $idcha->dm_dmsp;

        $level = (int)$idcha->dm_level + 1;

        $idcha = [$idcha->dm_id => $idcha->dm_ten];
    }else{
        $pa = '';
        if(isset($model[Aabc::$app->_danhmuc->dm_id])){
            if($model[Aabc::$app->_danhmuc->dm_level] == 0){
                $idcha = $_Danhmuc::getAll1_5level0(); 
            }elseif ($model[Aabc::$app->_danhmuc->dm_level] == 1) {
                $idcha = $_Danhmuc::getAll1_5level1(); 
            }elseif ($model[Aabc::$app->_danhmuc->dm_level] == 2) {
                $idcha = $_Danhmuc::getAll1_5level2(); 
            }
            $idcha = ['' => '---Chọn---'] + ArrayHelper::map($idcha, Aabc::$app->_danhmuc->dm_id, Aabc::$app->_danhmuc->dm_char);            
        }else{
            // $idcha = $_Danhmuc::getAll1_5level2(); 
            $idcha = ['' => '---Chọn---'];
        }
        $model->dm_idcha = null;
    }
   
    // echo '<pre>';
    // print_r($idcha);
    // echo '</pre>';
    // die;
    
    if($model->isNewRecord){
        echo $form->field($model, Aabc::$app->_danhmuc->dm_idcha,['options' => ['class' => 'hide']])->dropDownList($idcha ,[
                //'multiple'=>'multiple', 
                // D::s => 'search', 
                D::ty => 'ra',
                D::i => Aabc::$app->_model->__danhmuc,
                D::c => 'one',
                D::t => 'sea',
                // D::add => '/',
                //d-add chỉ cần cho d-u, còn d-i của url sẽ được lấy ở fk- bên dưới

                'class' => 'mulr',                        
                'id' => Aabc::$app->_model->__danhmuc.'-'.Aabc::$app->_danhmuc->dm_idcha,
                // 'id' => 'fk-'.Aabc::$app->_model->__danhmuc
                'options' =>
                        [                        
                          $pa => ['selected' => true]
                        ]
            ])->label('Thông số cha'); 
        }
    ?>
</div>





<div class="col-md-12  row pt120">    
    <?php 
    $_Danhmuc = Aabc::$app->_model->Danhmuc;   

    $an_ten = '';

    $danhmuc_daco_thongso =  $_Danhmuc::find()
                      ->select(['dm_dmsp'])
                      ->andWhere(['is not','dm_dmsp', null])
                      ->groupBy(['dm_dmsp'])
                      ->column();

    $all = $_Danhmuc::find()
                  ->andWhere([Aabc::$app->_danhmuc->dm_status => $_Danhmuc::ON])
                  ->andWhere([Aabc::$app->_danhmuc->dm_recycle => $_Danhmuc::NGOAITHUNGRAC])    
                  ->andWhere([Aabc::$app->_danhmuc->dm_type => 1])
                  ->andWhere(['not in','dm_id', $danhmuc_daco_thongso])
                  ->orderBy([Aabc::$app->_danhmuc->dm_sothutu=>SORT_ASC])
                  ->all();  
    if($all){
        $all = ArrayHelper::map($all, Aabc::$app->_danhmuc->dm_id, 'dm_ten');
        
        reset($all);
        $first_key = key($all);

        if($model->isNewRecord && $level == 0){
            $model->dm_ten = $all[$first_key];
            $an_ten = 'an';
        }
    }else{
        $all = [];
    }

    if(!empty($model->dm_dmsp)){            
        $all = [$model->dm_dmsp => $model->dm_dmsp];
    }


    $show_dmsp = (($model->dm_level < 1 && !empty(Aabc::$app->request->get('pa'))) || !$model->isNewRecord);

    if($model->isNewRecord){
        echo $form->field($model, 'dm_dmsp',['options' => ['class' => ($show_dmsp?'hide':'') ]])->dropDownList($all,[
            //'multiple'=>'multiple', 
            // D::s => 'search', 
            D::ty => 'ra',
            D::i => Aabc::$app->_model->__danhmuc,
            D::c => 'one',
            D::t => 'sea',
            // D::add => '/',
            //d-add chỉ cần cho d-u, còn d-i của url sẽ được lấy ở fk- bên dưới

            'class' => 'mulr',                        
            'id' => Aabc::$app->_model->__danhmuc.'-dm_dmsp',
            // 'id' => 'fk-'.Aabc::$app->_model->__danhmuc           
        ])->label('Danh mục sản phẩm'); 
    }
    ?>
</div>

<?php 

    

?>

<div class="col-md-12  row pt120">
    <?= $form->field($model, Aabc::$app->_danhmuc->dm_ten,['options' => ['class' => (empty($an_ten)?'':'hide')]])->textInput(['maxlength' => true,'data-placement' => 'top','data-trigger' => 'focus', 'data-toggle' => 'tooltip', 'title' => ''])->label('Tên') ?>
    <!-- ->label('My superb label') -->
</div>








<div class="col-md-12  row pt120">
    <?= $form->field($model, Aabc::$app->_danhmuc->dm_ghichu)->textarea(['rows' => '2', 'maxlength' => true,'data-placement' => 'right','data-trigger' => 'focus', 'data-toggle' => 'tooltip', '' => '']) ?>
</div>



<?php if($level == 2){ //Tức là giá trị ?>
    <div class="col-md-12  row pt120">
        <?= $form->field($model, Aabc::$app->_danhmuc->dm_link)->textInput(['maxlength' => true,'data-placement' => 'right','data-trigger' => 'focus', 'data-toggle' => 'tooltip', 'title' => ''])->label('Link seo') ?>

        <i class="hdtip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="Đường dẫn đến thông số này, sẽ hiển thị danh sách các sản phẩm có thông tin thông số giá trị này" aria-invalid="false"></i>
    </div>
<?php } ?>

<?php if($level == 1){ //Tức là thông số ?>

    <div class="col-md-7 row pt120">     
        <?=  $form->field($model,'dm_multi',['options' => ['class' => '']])->dropDownList( $_Danhmuc::getMultiOption() ,[
                Aabc::$app->d->t => 'show',
                Aabc::$app->d->ty => 'ra',
                Aabc::$app->d->i => 'danhmuc',
                'class' => 'mulr',      
                Aabc::$app->d->c => 'one',                        
                 'id' => 'dm_multi_select'
            ]);  ?>
        <i class="hdtip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="- Chọn 1 giá trị: Thông số này chỉ được chọn 1 trong các giá trị. VD: Hãng sản xuất là: Samsung hoặc LG hoặc iPhone.<br/>- Chọn nhiều giá trị: Được chọn cùng lúc nhiều giá trị. VD: iPhone 8 có nhiều phiên bản bộ nhớ trong: 32GB, 64GB, 128GB" aria-invalid="false"></i>
    </div>


     <div class="col-md-5 row pt100">        
        <?= $form->field($model,'dm_allow_search')->dropDownList($_Danhmuc::getAllowsearchOption(),[
                            //'multiple'=>'multiple', 
                            // Aabc::$app->d->s => 'search', 
                            Aabc::$app->d->t => 'show',
                            Aabc::$app->d->ty => 'ra',
                            Aabc::$app->d->i => Aabc::$app->_model->__danhmuc,
                            'class' => 'mulr',      
                            Aabc::$app->d->c => 'one',                        
                            'id' => Aabc::$app->_model->__danhmuc.'_dm_status_select'
                        ]) ?>

        <i class="hdtip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="- Bật: Thông số này sẽ hiển thị trong danh mục để lọc và tìm kiếm các sản phẩm có thông số này" aria-invalid="false"></i>
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

    <div class="col-md-12 row pt120">   
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


</div>

    <div class="form-group right"> 
       
        <button type="submit" class="btn btn-default haserror"><span class="glyphicon glyphicon-floppy-disk mxanh"></span>Lưu</button>

        <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-ban-circle mdo"></span>Đóng</button>
    </div>




    <?php ActiveForm::end(); ?>

</div>



<script type="text/javascript">  

  

    $('.modal-content #<?=Aabc::$app->_model->__danhmuc?>-form-5').on('keyup keypress', function(e) {
      var keyCode = e.keyCode || e.which;
      if (keyCode === 13) { 
        e.preventDefault();
        return false;
      }
    });


$('form#<?=Aabc::$app->_model->__danhmuc?>-form-5').on('beforeSubmit', function(e) {
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
            pjelm('<?=Aabc::$app->_model->__danhmuc?>','_tn');

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