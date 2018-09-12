<?php

use aabc\helpers\Html;
// use aabc\grid\GridView;

// use aabc\bootstrap\Modal;
use aabc\helpers\Url;
// use aabc\helpers\ArrayHelper; 
// use aabc\widgets\ActiveForm;
/*use app\models\Dskh; */

// use aabc\widgets\Pjax;
// use backend\models\ThuonghieuSearch ;
// use backend\models\Thuonghieu ;
/* @var $this aabc\web\View */
use backend\models\Sanpham;
use backend\models\Cauhinh;
use common\cont\D;

$this->title = 'My Aabc Application';
?>



<div class="site-index">     
    <div class="body-content">  
    <div class="row">
        <div class="showmenu" id="menu-top">
            <div id="minimenu">
                <span class="glyphicon glyphicon-chevron-up"></span>
                <!-- <span class="glyphicon glyphicon-chevron-up"></span> -->
            </div>
                

            <ul class="menu-parent">
                <li class="tongquan btnfocus">
                    <span>Sản phẩm</span>
                    <div class="menu-child-all">
                        <ul class="menu tongquan1"> 
                            <li id ='menu00' class="menu-child" >
                                <div id ='menu00' <?= D::u?>="<?= Sanpham::index_sp?>?sort=-<?= Sanpham::sp_id?>" class="menu-item pjb " <?= D::i?> = <?= Sanpham::tt?>>
                                    <span class="ico icon2"></span>
                                    <p>DS Sản phẩm</p>
                                </div>
                            </li>
                                                   
                            <li id ='menu00' class="menu-child" >
                                <div  id ='menu00' <?=D::u?>='i' class="menu-item pjb" <?=D::i?> = 'danhmuc'>
                                    <span class="ico icon1"></span>
                                    <p>Danh mục sản phẩm</p>
                                </div>
                            </li> 

                            <li id ='menu00' class="menu-child" >
                                <div id ='menu00' <?= D::u?>="ip_mn?g=1" class="menu-item pjb " <?= D::i?> = 'danhmuc' >
                                    <span class="ico icon2"></span>
                                    <p>MM</p>
                                </div>
                            </li>

                            

                            <li id ='menu00' class="menu-child" >
                                <div <?=D::m?>='2' id ='menu00' <?=D::u?>='ip_mn?g=1' class="menu-item pjbm" <?=D::i?> = 'danhmuc'>
                                    <span class="ico icon1"></span>
                                    <p>Menu 1</p>
                                </div>
                            </li>

                            <li id ='menu00' class="menu-child" >
                                <div <?=D::m?>='2' id ='menu00' <?=D::u?>='ip_tn' class="menu-item pjbm" <?=D::i?> = 'danhmuc'>
                                    <span class="ico icon1"></span>
                                    <p>Tính năng</p>
                                </div>
                            </li>

                            <li id ='menu00' class="menu-child" >
                                <div  id ='menu00' <?=D::u?>='i_tn' class="menu-item pjb" <?=D::i?> = 'danhmuc'>
                                    <span class="ico icon10"></span>
                                    <p>Danh sách thông số</p>
                                </div>
                            </li> 


                            <li id ='menu00' class="menu-child" >
                                <div  id ='menu00' <?=D::u?>='i_km' class="menu-item pjb" <?=D::i?> = 'chinhsach'>
                                    <span class="ico icon6"></span>
                                    <p>Khuyến mại</p>
                                </div>
                            </li> 


                            <li id ='menu00' class="menu-child" >
                                <div  id ='menu00' <?=D::u?>='i_bh' class="menu-item pjb" <?=D::i?> = 'chinhsach'>
                                    <span class="ico icon7"></span>
                                    <p>Chính sách</p>
                                </div>
                            </li> 

                     
                            <li id ='menu00' class="menu-child" >                               
                                <div id ='menu00' <?=D::u?>='i' class="menu-item pjb " <?=D::i?> = <?=Aabc::$app->_model->__image?>>
                                    <span class="ico icon13"></span>
                                    <p>Quản lý Ảnh</p>
                                </div>
                            </li>
                        </ul>

                    </div>
                </li>
              

                 <li class="tongquan">
                    <span>Bài viết</span>
                    <div class="menu-child-all">
                        <ul class="menu tongquan1">   
                            <li id ='menu00' class="menu-child" >
                                <div id ='menu00' <?= D::u?>="<?= Sanpham::index_bv?>?sort=-<?= Sanpham::sp_id?>" class="menu-item pjb " <?= D::i?> = <?= Sanpham::tt?>>
                                    <span class="ico icon7"></span>
                                    <p>DS Bài viết</p>
                                </div>
                            </li>
                        
                            <li id ='menu00' class="menu-child" >
                                <div  id ='menu00' <?= D::u?> = 'i_cm' class="menu-item pjb" <?=D::i?> = 'danhmuc'>
                                    <span class="ico icon10"></span>
                                    <p>Chuyên mục bài viết</p>
                                </div>
                            </li> 
                                               
                        </ul>

                    </div>
                </li>


                <li class="page">
                    <span>Giao diện</span>
                    <div class="menu-child-all">                       
                        <ul class="menu cauhinh"> 

                            <?php                             
                                $page = Cauhinh::get(Cauhinh::page.Cauhinh::template()); 
                                if(is_array($page['child'])) foreach ($page['child'] as $j => $v) {
                            ?>                                
                                <li id ='menu10' class="menu-child" >
                                    <div id ='menu00' <?= D::u(Cauhinh::cauhinh8.'?p='.$j) ?>  class="menu-item pjb_ch " <?= D::i(Cauhinh::tt)?> >
                                        <span class="ico icon<?= empty($v['icon'])?'15':$v['icon'] ?>"></span>
                                        <p><?= empty($v['label'])?'':$v['label'] ?></p>
                                    </div>
                                </li>
                            <?php } ?>
             
                        </ul>
                    </div>
                </li>




                <li class="tongquan">
                    <span>Cấu hình</span>
                    <div class="menu-child-all">                       
                        <ul class="menu cauhinh"> 
                            <li id ='menu10' class="menu-child" >
                                <div id ='menu00' <?= D::u?>="<?= Cauhinh::cauhinh1?>" class="menu-item pjb_ch " <?= D::i?> = <?= Cauhinh::tt?>>
                                    <span class="ico icon2"></span>
                                    <p>Thông tin chung</p>
                                </div>
                            </li>

                            <li id ='menu10' class="menu-child" >
                                <div id ='menu00' <?= D::u?>="<?= Cauhinh::cauhinh2?>" class="menu-item pjb_ch " <?= D::i?> = <?= Cauhinh::tt?>>
                                    <span class="ico icon3"></span>
                                    <p>Thông tin Đặt hàng</p>
                                </div>
                            </li>

                             <li id ='menu10' class="menu-child" >
                                <div id ='menu00' <?= D::u?>="<?= Cauhinh::cauhinh3?>" class="menu-item pjb_ch " <?= D::i?> = <?= Cauhinh::tt?>>
                                    <span class="ico icon4"></span>
                                    <p>Hình thức thanh Toán</p>
                                </div>
                            </li>


                         
                            <li id ='menu00' class="menu-child" >
                                <div  id ='menu00' <?=D::u?>='i_mn?g=241&amp;l=Thi%E1%BA%BFt+l%E1%BA%ADp+ti%E1%BB%81n+ship' class="menu-item pjb" <?=D::i?> = 'danhmuc'>
                                    <span class="ico icon10"></span>
                                    <p>Thiết lập phí ship</p>
                                </div>
                            </li> 













                            <li id ='menu10' class="menu-child" >
                                <div id ='menu00' <?= D::u?>="<?= Cauhinh::cauhinh4?>" class="menu-item pjb_ch " <?= D::i?> = <?= Cauhinh::tt?>>
                                    <span class="ico icon5"></span>
                                    <p>Thiết lập phí ship</p>
                                </div>
                            </li>

                            <li id ='menu10' class="menu-child" >
                                <div id ='menu00' <?= D::u?>="<?= Cauhinh::cauhinh5?>" class="menu-item pjb_ch " <?= D::i?> = <?= Cauhinh::tt?>>
                                    <span class="ico icon6"></span>
                                    <p>Chi tiết sản phẩm</p>
                                </div>
                            </li>

                            
                            <li id ='menu10' class="menu-child" >
                                <div id ='menu00' <?= D::u?>="<?= Cauhinh::cauhinh6?>" class="menu-item pjb_ch " <?= D::i?> = <?= Cauhinh::tt?>>
                                    <span class="ico icon13"></span>
                                    <p>Thiết lập Module</p>
                                </div>
                            </li>

                            <li id ='menu10' class="menu-child" >
                                <div id ='menu00' <?= D::u?>="<?= Cauhinh::cauhinh7?>" class="menu-item pjb_ch " <?= D::i?> = <?= Cauhinh::tt?>>
                                    <span class="ico icon14"></span>
                                    <p>Thiết lập Page</p>
                                </div>
                            </li>

                            <li id ='menu10' class="menu-child" >
                                <div d-m="2" id ='menu00' <?= D::u?>="<?= Cauhinh::cauhinh10?>?i=1" class="menu-item pjbm " <?= D::i?> = <?= Cauhinh::tt?>>
                                    <span class="ico icon5"></span>
                                    <p>C10</p>
                                </div>
                            </li>
                                                  
                        </ul>
                    </div>
                </li>

            </ul>
        </div>                      
               
        <div id="pagecurrent"></div>        
        <div id="content"> 
           <!--  <br/><br/><br/>
            <?php 
                // $t = Aabc::$app->settings;
                // echo '<pre>';
                // print_r(json_decode($t->get('thongtin')));

            ?> -->
        </div>
    </div>

    </div>
</div>


<?php 
$this->registerJs(
'   
    d_icon = "'.D::icon.'";
    d_i = "'.D::i.'";
    d_u = "'.D::u.'";

    d_s = "'.D::s.'";
    d_r = "'.D::r.'";
    d_c = "'.D::c.'";
    d_t = "'.D::t.'";
    d_ty = "'.D::ty.'";
    d_m = "'.D::m.'";
    d_ct = "'.D::ct.'";

    d_tp = "'.D::tp.'";
    d_lt = "'.D::lt.'";
    d_wh = "'.D::wh.'";
    d_ht = "'.D::ht.'";

    d_st = "'.D::st.'";
    d_gr = "'.D::gr.'";    

    d_lk = "'.D::lk.'";   
    d_add = "'.D::add.'";   


    d_lcs = "'.D::lcs.'";
    d_cc = "'.D::cc.'";


    d_postimg = "'.D::postimg.'";   

    d_type = "'.D::type.'"; 

    d_c_img = "'.Aabc::$app->_model->__image.'"; 
')
?>