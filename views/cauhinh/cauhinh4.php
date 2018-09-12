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
use common\components\Tuyen;
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
           
                 <div class="col-md-12">
                    <style type="text/css">
                        .ri {
                            width: 100% !important;
                            margin: 0 0 20px 0;
                        }
                        .pa-i {
                            position: relative;
                        }
                        .stg .pa-i legend>input{
                            border: none;
                            margin: 0;
                            font-size: 18px;
                           /* background: transparent;
                            color: #FFF;*/
                        }
                        .tttg{
                            position: relative;
                            border: 1px solid #ddd;
                            padding: 10px 0 0 10px;
                            margin: 0 40px 20px 10px;
                        }
                        .tttg-content{
                            float: left;
                            width: calc(100% - 160px);
                            border-right: 1px solid #eee;
                        }
                        .tttg .add-tttg{
                            z-index: 99;
                            position: absolute;
                            bottom: 5px;
                            right: 5px;                            
                            font-size: 13px;
                            color: #999;
                        }
                        .tttg-one{
                            float: left;
                            float: left;
                            margin: 5px 5px 5px 0;
                            border: 1px solid #ccc;
                            padding: 2px 22px 2px 10px;
                            border-radius: 5px;
                            color: #888;
                            position: relative;
                        }
                        .tttg-one span{
                            position: absolute;
                            top: 5px;
                            right: 3px;
                            cursor: pointer;
                            opacity: 0.5;
                        }
                        .tttg-one span:hover{
                            color: #a00;
                            opacity: 1;
                        }
                        .tttg-default{
                            position: absolute;
                            top: 4px;
                            left: 5px;
                        }
                        .tttg-one input{
                            padding: 0;margin: 0;
                        }
                        .tttg .input-tttg {
                            border: none;
                            padding: 0;
                            margin: 0;
                        }
                        .tt-price{
                            float: right;
                            width: 160px;
                            padding: 0 10px;
                            border-left: 1px solid #eee;
                        }
                        .tt-remove {
                            position: absolute;
                            top: 30px;
                            right: -33px;
                            color: #bbb;
                            cursor: pointer;
                            border: 1px solid;
                            border-radius: 20px;
                            padding: 3px;
                            background: #FFF;
                        }
                        .tt-remove:hover{
                            color: #d00;
                            opacity: 1;
                        }
                        .tt-price input {
                            z-index: 1 !important;
                        }
                        .tt-add {
                            margin: 0 0 0 10px;
                        }
                        .t-remove{
                            position: absolute;
                            right: 30px;
                            top: 15px;
                            color: #c61616;
                            cursor: pointer;
                        }
                        .t-remove:hover{
                            color: #E00;
                        }
                    </style>
                    <div class="form-group required">                        
                        <!-- <div class="le"><label class="control-label" for="">Địa điểm giao hàng và giá ship</label></div> -->
                        <div class="ri"> 
                             <?php
                                // $t = [
                                //     152341523 => [
                                //         'tinh' => 'Hà Nội',
                                //         'item' => [
                                //             623424 => [
                                //                 'huyen' => [
                                //                     12312313 => 'Hai Bà Trưng',
                                //                     123234233 => 'Hoàng Mai',
                                //                     123423413 => 'Đống Đa',
                                //                     34213 => 'Từ Liêm',
                                //                 ],
                                //                 'gia' => 12000,
                                //             ],
                                //             62284564 => [
                                //                 'huyen' => [
                                //                     12342313 => 'Gia Lâm',
                                //                     262346234234233 => 'Long Biên',
                                //                     735423413 => 'Thanh Trì',
                                //                     745634213 => 'Sơn Tây',
                                //                 ],
                                //                 'gia' => 20000,
                                //             ]
                                //         ]
                                //     ]
                                // ];  

                                $ship = Cauhinh::get(Cauhinh::ship);                                     
                                
                                // echo '<pre>';
                                // print_r($t);
                                // echo '</pre>';

                                if(is_array($ship)) foreach ($ship as $k_t => $v_t) { 
                            ?>
                                <div class="pa-i" data-i="<?= $k_t?>">
                                    <fieldset>
                                        <legend>
                                        <input placeholder="Nhập tỉnh/thành phố..." class="form-control" value="<?= $v_t['tinh'] ?>" type="text" name="<?= Cauhinh::T?>[<?= Cauhinh::ship?>][<?= $k_t?>][tinh]">
                                        </legend>
                                        <?php 
                                            $item = empty($v_t['item'])?[]:$v_t['item'];
                                            foreach ($item as $k_tt => $v_tt) {
                                        ?>  
                                            <div class="tttg">
                                                <div class="tttg-content" data-i="<?= $k_tt?>">
                                                <?php 
                                                    $gia = empty($v_tt['gia'])?0:$v_tt['gia'];
                                                    $huyen = empty($v_tt['huyen'])?[]:$v_tt['huyen'];
                                                    foreach ($huyen as $k_ttt => $v_ttt) {
                                                ?> 
                                                    <div class="tttg-one">                    
                                                        <span title="Xóa" class="tttg-remove glyphicon glyphicon-remove"></span><?= $v_ttt ?>
                                                        <input value="<?= $v_ttt ?>" type="text" readonly="" name="<?= Cauhinh::T?>[<?= Cauhinh::ship?>][<?= $k_t?>][item][<?= $k_tt?>][huyen][<?= $k_ttt?>]" class="hide">
                                                    </div> 
                                                    <?php } ?>                                   
                                                </div>

                                                <div class="tt-price">
                                                    <div class="input-group">
                                                        <input placeholder="Nhập giá ship.." type="number" id="" class="form-control" name="<?= Cauhinh::T?>[<?= Cauhinh::ship?>][<?= $k_t?>][item][<?= $k_tt?>][gia]" value="<?= $gia?>">
                                                        <span class="input-group-addon"><?= Tuyen::_show_donvitiente()?></span>
                                                    </div>
                                                </div>

                                                <span title="Xóa" class="tt-remove glyphicon glyphicon-minus "></span>

                                                <input placeholder="Nhập thêm quận/huyện..." class="form-control input-tttg" type="text" />
                                                <i class="hide add-tttg">ấn ENTER để thêm mới</i>
                                            </div>
                                        <?php      
                                            }
                                        ?>
                                        <span title="Thêm nhóm giá quận/huyện" class="btn btn-default tt-add">
                                            <span  class="glyphicon glyphicon-plus"></span> Thêm nhóm giá quận/huyện
                                        </span>
                                        
                                        <span title="Xóa" class="t-remove glyphicon glyphicon-remove "></span>
                                    </fieldset>
                                </div>
                                
                            <?php        
                                }
                            ?>

                            <span title="Thêm tỉnh/thành phố" class="btn btn-success t-add">
                                <span  class="glyphicon glyphicon-plus"></span> Thêm tỉnh/thành phố
                            </span>
                        </div>
                    </div>
                    <script type="text/javascript">
                        // $('.input-tttg').on('keyup keypress',function(e){
                        $(document).on('keyup keypress','.input-tttg',function(e){
                            var parents = $(this).parents('.pa-i')
                            var id_tinh = parents.data('i');

                            var parent = $(this).parent();
                            var value = $(this).val()                            
                            var btn_add = parent.find('.add-tttg')
                            var keyCode = e.keyCode || e.which;
                            if (keyCode === 13){
                                var d = new Date();
                                var time = d.getTime();

                                var add_content = parent.find('.tttg-content')
                                var id_item = add_content.data('i');

                                var html = '<div class="tttg-one"><span title="Xóa" class="tttg-remove glyphicon glyphicon-remove"></span>'+value+'<input value="'+value+'" type="text" readonly name="<?= Cauhinh::T?>[<?= Cauhinh::ship?>]['+id_tinh+'][item]['+id_item+'][huyen]['+time+']"  class="hide" /></div>'  

                                if(value != ''){
                                    add_content.append(html)
                                }
                                $(this).val('')
                                btn_add.addClass('hide')
                                e.preventDefault();
                                return false;
                            }                           
                            if(value == ''){   
                                btn_add.addClass('hide')                             
                            }else{
                                btn_add.removeClass('hide')
                            }
                        })

                        function tt_add(_this, e){
                            var parents = $(_this).parents('.pa-i')
                            var id_tinh = parents.data('i');                                                     
                            var d = new Date();
                            var time = d.getTime();                                                          
                            var html = '<div class="tttg"><div class="tttg-content" data-i="'+time+'"></div><div class="tt-price"><div class="input-group"><input placeholder="Nhập giá ship.." type="number" id="" class="form-control" name="Cauhinh_fake[j9]['+id_tinh+'][item]['+time+'][gia]" value=""><span class="input-group-addon"><?= Tuyen::_show_donvitiente()?></span></div></div><span title="Xóa" class="tt-remove glyphicon glyphicon-minus "></span><input placeholder="Nhập thêm quận/huyện..." class="form-control input-tttg" type="text"><i class="hide add-tttg">ấn ENTER để thêm mới</i></div>'
                            $(html).insertBefore(_this);
                            e.preventDefault();
                            return false;                           
                        }



                        function t_add(_this, e){
                            var d = new Date();
                            var time = d.getTime();                                                          
                            var html = '<div class="pa-i" data-i="'+time+'"><fieldset><legend><input placeholder="Nhập tỉnh/thành phố..." class="form-control" value="" type="text" name="Cauhinh_fake[j9]['+time+'][tinh]"></legend><span title="Thêm nhóm giá quận/huyện" class="btn btn-default tt-add"><span class="glyphicon glyphicon-plus"></span> Thêm nhóm giá quận/huyện</span>'

                            $(html).insertBefore(_this);
                            e.preventDefault();
                            return false;                           
                        } 
                       
                    </script>
                </div>


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


  
  