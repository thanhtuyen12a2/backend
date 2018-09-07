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
        
        fieldset.group{
            margin: 0 20px;
        }
        fieldset.group>legend{
            /*background: transparent;
            color: #555;
            width: auto;*/
        }
        .ttdktk{
            margin-bottom:10px !important;
        }
    </style>
   
    <?php $form = ActiveForm::begin(['id' => 'ch-form']); ?>
     <div class="ch-index-child">
     
                           
        <div class="stg">
            
                
                <?php  $cart_dangnhap = Cauhinh::get(Cauhinh::cart_dangnhap); ?>
                <div class="col-md-6" style="margin: 0 0 0 25px;">                                     
                    <div class="form-group">
                        <div class="le"><label class="control-label" for="">Người dùng đặt hàng có cần phải Đăng nhập không?</label></div>
                        <div class="ri"> 
                            <?php                                    
                                $danhmuc = [
                                    1 => 'Không##mgr',                                    
                                    2 => 'Bắt buộc##mre',
                                ];  
                                echo Html::dropDownList(
                                    Cauhinh::T.'['.Cauhinh::cart_dangnhap.']',
                                    $cart_dangnhap,
                                    $danhmuc,
                                    [
                                        // 'multiple'=>'multiple',
                                        // Aabc::$app->d->ty => 'checkbox',                                  
                                        // Aabc::$app->d->i => Sanpham::tt,
                                        // Aabc::$app->d->t => 'sea',//Search
                                        // 'class' => 'mulr',                        
                                        // 'id' => 'home-cm-'.Cauhinh::tt
                                        Aabc::$app->d->t => 'show',
                                        Aabc::$app->d->ty => 'ra',
                                        Aabc::$app->d->i => Sanpham::tt,
                                        'class' => 'mulr',      
                                        Aabc::$app->d->c => 'one',                        
                                        'id' => 'cart-'.Cauhinh::tt.'-'.Cauhinh::cart_dangnhap,
                                    ]
                                )
                            ?>                         
                        </div>
                    </div>                    
                </div> 


                <script type="text/javascript">
                    $('input[name="<?= Cauhinh::T.'['.Cauhinh::cart_dangnhap.']'?>"]').on('click',function(){
                        var value = $(this).val()
                        if(value == 2){
                            $('.ttdktk').removeClass('hide')
                        }
                        else{
                            $('.ttdktk').addClass('hide')                            
                        }


                    })
                </script>

                <div class="clearfix"></div>

                
                <?php 
                    $arr_dangky = [
                        Cauhinh::dangky_email => 'Email',
                        Cauhinh::dangky_tendangnhap => 'Tên đăng nhập',                        
                        Cauhinh::dangky_matkhau => 'Mật khẩu',
                        Cauhinh::dangky_matkhau_nhaplai => 'Nhập lại mật khẩu',

                        Cauhinh::dangky_hoten => 'Họ tên',
                        Cauhinh::dangky_dienthoai => 'Điện thoại',
                        Cauhinh::dangky_ngaysinh => 'Ngày sinh',                        
                        Cauhinh::dangky_gioitinh => 'Giới tính',
                        Cauhinh::dangky_socmnd => 'Số CMND/Thẻ căn cước',
                        Cauhinh::dangky_diachi => 'Địa chỉ',
                          
                    ];
                ?> 
                
                <fieldset class="group ttdktk <?= $cart_dangnhap == 2?'':'hide'?>">
                    <legend>Thông tin đăng ký tài khoản</legend>
                <?php foreach ($arr_dangky as $k_dangky => $v_dangky) { ?>                     
                <div class="col-md-3 pt200">                                       
                    <div class="form-group">
                        <div class="le"><label class="control-label" for=""><?= $v_dangky?>:</label></div>
                        <div class="ri"> 
                            <?php    
                                $data = Cauhinh::get($k_dangky); 
                                $_Danhmuc  = Aabc::$app->_model->Danhmuc;
                                $danhmuc = [
                                    1 => 'Ẩn##mbl',
                                    2 => 'Hiển thị##mgr',
                                    3 => 'Bắt buộc##mre',
                                ];
                                
                              
                                echo Html::dropDownList(
                                    Cauhinh::T.'['.$k_dangky.']',
                                    $data,
                                    $danhmuc,
                                    [
                                        // 'multiple'=>'multiple',
                                        // Aabc::$app->d->ty => 'checkbox',                                  
                                        // Aabc::$app->d->i => Sanpham::tt,
                                        // Aabc::$app->d->t => 'sea',//Search
                                        // 'class' => 'mulr',                        
                                        // 'id' => 'home-cm-'.Cauhinh::tt
                                        // Aabc::$app->d->t => 'show',

                                        Aabc::$app->d->ty => 'ra',
                                        Aabc::$app->d->i => Sanpham::tt,
                                        'class' => 'mulr',      
                                        Aabc::$app->d->c => 'one',                        
                                        'id' => 'cart-'.Cauhinh::tt.'-'.$k_dangky,
                                    ]
                                )
                            ?>                         
                        </div>
                    </div>                    
                </div> 
                <?php } ?> 
                </fieldset> 



                <?php 
                    $arr_cart = [
                        Cauhinh::cart_hoten => 'Họ tên',
                        Cauhinh::cart_gioitinh => 'Giới tính',
                        Cauhinh::cart_email => 'Email',
                        Cauhinh::cart_dienthoai => 'Điện thoại',
                        Cauhinh::cart_diachi => 'Địa chỉ',
                        Cauhinh::cart_ghichu => 'Ghi chú',
                    ];
                ?> 
                
                <fieldset class="group tttt">
                    <legend>Thông tin thanh toán</legend>
                <?php foreach ($arr_cart as $k_cart => $v_cart) { ?>                     
                <div class="col-md-3 pt200">                                       
                    <div class="form-group">
                        <div class="le"><label class="control-label" for="danhmuc-dm_ten"><?= $v_cart?>:</label></div>
                        <div class="ri"> 
                            <?php    
                                $data = Cauhinh::get($k_cart); 
                                $_Danhmuc  = Aabc::$app->_model->Danhmuc;
                                $danhmuc = [
                                    1 => 'Ẩn##mbl',
                                    2 => 'Hiển thị##mgr',
                                    3 => 'Bắt buộc##mre',
                                ];
                                
                              
                                echo Html::dropDownList(
                                    Cauhinh::T.'['.$k_cart.']',
                                    $data,
                                    $danhmuc,
                                    [
                                        // 'multiple'=>'multiple',
                                        // Aabc::$app->d->ty => 'checkbox',                                  
                                        // Aabc::$app->d->i => Sanpham::tt,
                                        // Aabc::$app->d->t => 'sea',//Search
                                        // 'class' => 'mulr',                        
                                        // 'id' => 'home-cm-'.Cauhinh::tt

                                        // Aabc::$app->d->t => 'show',
                                        Aabc::$app->d->ty => 'ra',
                                        Aabc::$app->d->i => Sanpham::tt,
                                        'class' => 'mulr',      
                                        Aabc::$app->d->c => 'one',                        
                                        'id' => 'cart-'.Cauhinh::tt.'-'.$k_cart,
                                    ]
                                )
                            ?>                         
                        </div>
                    </div>                    
                </div> 
                <?php } ?>
                </fieldset> 

        </div>






        <?php 
            $arr_lienhe = [
                Cauhinh::lienhe_hoten => 'Họ tên',                
                Cauhinh::lienhe_email => 'Email',
                Cauhinh::lienhe_dienthoai => 'Điện thoại',
                Cauhinh::lienhe_noidung => 'Nội dung',
            ];
        ?>                     
        <div class="stg">
           
                <?php foreach ($arr_lienhe as $k_lienhe => $v_lienhe) { ?>                     
                <div class="col-md-3 pt200">                                     
                    <div class="form-group">
                        <div class="le"><label class="control-label" for=""><?= $v_lienhe?>:</label></div>
                        <div class="ri">                            
                            <?php    
                                $data = Cauhinh::get($k_lienhe); 
                                $_Danhmuc  = Aabc::$app->_model->Danhmuc;
                                $danhmuc = [
                                    1 => 'Ẩn##mbl',
                                    2 => 'Hiển thị##mgr',
                                    3 => 'Bắt buộc##mre',
                                ];
                              
                                echo Html::dropDownList(
                                    Cauhinh::T.'['.$k_lienhe.']',
                                    $data,
                                    $danhmuc,
                                    [
                                        // 'multiple'=>'multiple',
                                        // Aabc::$app->d->ty => 'checkbox',                                  
                                        // Aabc::$app->d->i => Sanpham::tt,
                                        // Aabc::$app->d->t => 'sea',//Search
                                        // 'class' => 'mulr',                        
                                        // 'id' => 'home-cm-'.Cauhinh::tt
                                        // Aabc::$app->d->t => 'show',

                                        Aabc::$app->d->ty => 'ra',
                                        Aabc::$app->d->i => Sanpham::tt,
                                        'class' => 'mulr',      
                                        Aabc::$app->d->c => 'one',                        
                                        'id' => 'cart-'.Cauhinh::tt.'-'.$k_lienhe,
                                    ]
                                )
                            ?>                             
                        </div>
                    </div>                    
                </div> 
                <?php } ?>             
            
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


  
  