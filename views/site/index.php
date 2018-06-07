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
                                <div id ='menu00' <?= Aabc::$app->d->u?>="<?= Sanpham::index_sp?>?sort=-<?= Sanpham::sp_id?>" class="menu-item pjb " <?= Aabc::$app->d->i?> = <?= Sanpham::tt?>>
                                    <span class="ico icon2"></span>
                                    <p>DS Sản phẩm</p>
                                </div>
                            </li>
                                                   
                            <li id ='menu00' class="menu-child" >
                                <div  id ='menu00' <?=Aabc::$app->d->u?>='i' class="menu-item pjb" <?=Aabc::$app->d->i?> = 'danhmuc'>
                                    <span class="ico icon1"></span>
                                    <p>Danh mục sản phẩm</p>
                                </div>
                            </li> 

                            <li id ='menu00' class="menu-child" >
                                <div id ='menu00' <?= Aabc::$app->d->u?>="ip_mn?g=1" class="menu-item pjb " <?= Aabc::$app->d->i?> = 'danhmuc' >
                                    <span class="ico icon2"></span>
                                    <p>MM</p>
                                </div>
                            </li>

                            

                            <li id ='menu00' class="menu-child" >
                                <div <?=Aabc::$app->d->m?>='2' id ='menu00' <?=Aabc::$app->d->u?>='ip_mn?g=1' class="menu-item pjbm" <?=Aabc::$app->d->i?> = 'danhmuc'>
                                    <span class="ico icon1"></span>
                                    <p>Menu 1</p>
                                </div>
                            </li>

                            <li id ='menu00' class="menu-child" >
                                <div <?=Aabc::$app->d->m?>='2' id ='menu00' <?=Aabc::$app->d->u?>='ip_tn' class="menu-item pjbm" <?=Aabc::$app->d->i?> = 'danhmuc'>
                                    <span class="ico icon1"></span>
                                    <p>Tính năng</p>
                                </div>
                            </li>

                            <li id ='menu00' class="menu-child" >
                                <div  id ='menu00' <?=Aabc::$app->d->u?>='i_tn' class="menu-item pjb" <?=Aabc::$app->d->i?> = 'danhmuc'>
                                    <span class="ico icon10"></span>
                                    <p>Danh sách thông số</p>
                                </div>
                            </li> 


                     
                            <li id ='menu00' class="menu-child" >                               
                                <div id ='menu00' <?=Aabc::$app->d->u?>='i' class="menu-item pjb " <?=Aabc::$app->d->i?> = <?=Aabc::$app->_model->__image?>>
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
                                <div id ='menu00' <?= Aabc::$app->d->u?>="<?= Sanpham::index_bv?>?sort=-<?= Sanpham::sp_id?>" class="menu-item pjb " <?= Aabc::$app->d->i?> = <?= Sanpham::tt?>>
                                    <span class="ico icon7"></span>
                                    <p>DS Bài viết</p>
                                </div>
                            </li>
                        
                            <li id ='menu00' class="menu-child" >
                                <div  id ='menu00' <?= Aabc::$app->d->u?> = 'i_cm' class="menu-item pjb" <?=Aabc::$app->d->i?> = 'danhmuc'>
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
                                $max =  empty($page['max'])? 1 : ($page['max'] + 1);
                            ?>
                            <?php for ($j=1; $j < $max ; $j++) { ?>
                                <li id ='menu10' class="menu-child" >
                                    <div id ='menu00' <?= Aabc::$app->d->u?>="<?= Cauhinh::cauhinh8?>?p=<?= $j?>" class="menu-item pjb_ch " <?= Aabc::$app->d->i?> = <?= Cauhinh::tt?>>
                                        <span class="ico icon<?= empty($page['child'][$j]['icon'])?'15':$page['child'][$j]['icon'] ?>"></span>
                                        <p><?= empty($page['child'][$j]['label'])?'':$page['child'][$j]['label'] ?></p>
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
                                <div id ='menu00' <?= Aabc::$app->d->u?>="<?= Cauhinh::cauhinh1?>" class="menu-item pjb_ch " <?= Aabc::$app->d->i?> = <?= Cauhinh::tt?>>
                                    <span class="ico icon2"></span>
                                    <p>Thông tin chung</p>
                                </div>
                            </li>

                            <li id ='menu10' class="menu-child" >
                                <div id ='menu00' <?= Aabc::$app->d->u?>="<?= Cauhinh::cauhinh2?>" class="menu-item pjb_ch " <?= Aabc::$app->d->i?> = <?= Cauhinh::tt?>>
                                    <span class="ico icon3"></span>
                                    <p>Thiết lập Trang chủ</p>
                                </div>
                            </li>

                            <li id ='menu10' class="menu-child" >
                                <div id ='menu00' <?= Aabc::$app->d->u?>="<?= Cauhinh::cauhinh4?>" class="menu-item pjb_ch " <?= Aabc::$app->d->i?> = <?= Cauhinh::tt?>>
                                    <span class="ico icon5"></span>
                                    <p>Các thành phần trang</p>
                                </div>
                            </li>

                            <li id ='menu10' class="menu-child" >
                                <div id ='menu00' <?= Aabc::$app->d->u?>="<?= Cauhinh::cauhinh5?>" class="menu-item pjb_ch " <?= Aabc::$app->d->i?> = <?= Cauhinh::tt?>>
                                    <span class="ico icon6"></span>
                                    <p>Chi tiết sản phẩm</p>
                                </div>
                            </li>

                            
                            <li id ='menu10' class="menu-child" >
                                <div id ='menu00' <?= Aabc::$app->d->u?>="<?= Cauhinh::cauhinh6?>" class="menu-item pjb_ch " <?= Aabc::$app->d->i?> = <?= Cauhinh::tt?>>
                                    <span class="ico icon13"></span>
                                    <p>Thiết lập Module</p>
                                </div>
                            </li>

                            <li id ='menu10' class="menu-child" >
                                <div id ='menu00' <?= Aabc::$app->d->u?>="<?= Cauhinh::cauhinh7?>" class="menu-item pjb_ch " <?= Aabc::$app->d->i?> = <?= Cauhinh::tt?>>
                                    <span class="ico icon14"></span>
                                    <p>Thiết lập Page</p>
                                </div>
                            </li>

                            <li id ='menu10' class="menu-child" >
                                <div d-m="2" id ='menu00' <?= Aabc::$app->d->u?>="<?= Cauhinh::cauhinh10?>?i=1" class="menu-item pjbm " <?= Aabc::$app->d->i?> = <?= Cauhinh::tt?>>
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
    d_i = "'.Aabc::$app->d->i.'";
    d_u = "'.Aabc::$app->d->u.'";

    d_s = "'.Aabc::$app->d->s.'";
    d_r = "'.Aabc::$app->d->r.'";
    d_c = "'.Aabc::$app->d->c.'";
    d_t = "'.Aabc::$app->d->t.'";
    d_ty = "'.Aabc::$app->d->ty.'";
    d_m = "'.Aabc::$app->d->m.'";
    d_ct = "'.Aabc::$app->d->ct.'";

    d_tp = "'.Aabc::$app->d->tp.'";
    d_lt = "'.Aabc::$app->d->lt.'";
    d_wh = "'.Aabc::$app->d->wh.'";
    d_ht = "'.Aabc::$app->d->ht.'";

    d_st = "'.Aabc::$app->d->st.'";
    d_gr = "'.Aabc::$app->d->gr.'";    

    d_lk = "'.Aabc::$app->d->lk.'";   
    d_add = "'.Aabc::$app->d->add.'";   


    d_lcs = "'.Aabc::$app->d->lcs.'";
    d_cc = "'.Aabc::$app->d->cc.'";


    d_postimg = "'.Aabc::$app->d->postimg.'";   

    d_type = "'.Aabc::$app->d->type.'"; 

    d_c_img = "'.Aabc::$app->_model->__image.'"; 
')
?>