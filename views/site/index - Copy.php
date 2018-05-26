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
                    <span>Tổng quan</span>
                    <div class="menu-child-all">
                        <ul class="menu tongquan1"> 
                             <li id ='menu00' class="menu-child" >
                                <div id ='menu00' <?= Aabc::$app->d->u?>="<?= Sanpham::index_sp?>?sort=-sp_id" class="menu-item pjb " <?= Aabc::$app->d->i?> = <?= Sanpham::tt?>>
                                    <span class="ico icon1"></span>
                                    <p>Sản phẩm</p>
                                </div>
                            </li>

                            <li id ='menu00' class="menu-child" >
                                <div id ='menu00' <?= Aabc::$app->d->u?>="<?= Sanpham::index_bv?>?sort=-sp_id" class="menu-item pjb " <?=Aabc::$app->d->i?> = <?= Sanpham::tt?> >
                                    <span class="ico icon3"></span>
                                    <p>Bài viết</p>
                                </div>
                            </li>

                            <li id ='menu0' class="menu-child" >
                                <div id ='menu0' <?=Aabc::$app->d->u?>='index2?sort=-dm_id&amp;dm_status[]=3&amp;dm_status[]=6&amp;dm_status[]=4&amp;dm_status[]=5&amp;dm_status[]=7' class="menu-item pjb" <?=Aabc::$app->d->i?> = 'domain'>
                                    <span class="ico icon2"></span>
                                    <p>Domain</p>
                                </div>
                            </li>

                            <li id ='menu00' class="menu-child" >
                                <div <?=Aabc::$app->d->m?>='2' id ='menu00' <?=Aabc::$app->d->u?>='ip' class="menu-item pjbm" <?=Aabc::$app->d->i?> = 'danhmuc'>
                                    <span class="ico icon1"></span>
                                    <p>Danh mục sản phẩm</p>
                                </div>
                            </li>

                            <li id ='menu00' class="menu-child" >
                                <div <?=Aabc::$app->d->m?>='2' id ='menu00' <?=Aabc::$app->d->u?>='ip_cm' class="menu-item pjbm" <?=Aabc::$app->d->i?> = 'danhmuc'>
                                    <span class="ico icon1"></span>
                                    <p>Danh mục bài viết</p>
                                </div>
                            </li>

                            <li id ='menu00' class="menu-child" >
                                <div <?=Aabc::$app->d->m?>='2' id ='menu00' <?=Aabc::$app->d->u?>='ip_dm' class="menu-item pjbm" <?=Aabc::$app->d->i?> = 'danhmuc'>
                                    <span class="ico icon1"></span>
                                    <p>Danh mục nổi bật</p>
                                </div>
                            </li>

                            <li id ='menu00' class="menu-child" >
                                <div <?=Aabc::$app->d->m?>='2' id ='menu00' <?=Aabc::$app->d->u?>='ip_mn' class="menu-item pjbm" <?=Aabc::$app->d->i?> = 'danhmuc'>
                                    <span class="ico icon1"></span>
                                    <p>Danh mục menu</p>
                                </div>
                            </li>

                            <li id ='menu00' class="menu-child" >
                                <div <?=Aabc::$app->d->m?>='2' id ='menu00' <?=Aabc::$app->d->u?>='ip_tn' class="menu-item pjbm" <?=Aabc::$app->d->i?> = 'danhmuc'>
                                    <span class="ico icon1"></span>
                                    <p>Danh mục tính năng</p>
                                </div>
                            </li>
                        </ul>

                         <ul class="menu">  
                            <li id ='menu00' class="menu-child" >
                                <div  id ='menu00' <?=Aabc::$app->d->u?>='i' class="menu-item pjb" <?=Aabc::$app->d->i?> = 'danhmuc'>
                                    <span class="ico icon11"></span>
                                    <p>Danh mục sản phẩm</p>
                                </div>
                            </li>

                            <li id ='menu00' class="menu-child" >
                                <div  id ='menu00' <?=Aabc::$app->d->u?>='i_cm' class="menu-item pjb" <?=Aabc::$app->d->i?> = 'danhmuc'>
                                    <span class="ico icon12"></span>
                                    <p>Chuyên mục bài viết</p>
                                </div>
                            </li>

                            <li id ='menu00' class="menu-child" >
                                <div  id ='menu00' <?=Aabc::$app->d->u?>='i_dm' class="menu-item pjb" <?=Aabc::$app->d->i?> = 'danhmuc'>
                                    <span class="ico icon13"></span>
                                    <p>Danh mục nổi bật</p>
                                </div>
                            </li>

                            <li id ='menu00' class="menu-child" >
                                <div  id ='menu00' <?=Aabc::$app->d->u?>='i_mn' class="menu-item pjb" <?=Aabc::$app->d->i?> = 'danhmuc'>
                                    <span class="ico icon14"></span>
                                    <p>Quản lý menu</p>
                                </div>
                            </li>

                            <li id ='menu00' class="menu-child" >
                                <div  id ='menu00' <?=Aabc::$app->d->u?>='i_tn' class="menu-item pjb" <?=Aabc::$app->d->i?> = 'danhmuc'>
                                    <span class="ico icon15"></span>
                                    <p>Thông số tính năng</p>
                                </div>
                            </li>

                           

                            
                        </ul>



                        <ul class="menu"> 
                             <li id ='menu0' class="menu-child" >
                                 <div id ='menu0112' <?=Aabc::$app->d->u?>='' class="menu-item pjbm " <?=Aabc::$app->d->i?> = 'itemhelp'>
                                    <span class="ico icon5"></span>
                                    <p>Item help</p>
                                </div>
                            </li>


                             <li id ='menu00' class="menu-child" >                               
                                <div id ='menu00' <?=Aabc::$app->d->u?>='i' class="menu-item pjb " <?=Aabc::$app->d->i?> = <?=Aabc::$app->_model->__image?>>
                                    <span class="ico icon1"></span>
                                    <p>QL Ảnh</p>
                                </div>
                            </li>
                             <li id ='menu00' class="menu-child" >                               
                                <div id ='menu00' <?=Aabc::$app->d->u?>='ip' class="menu-item pjbm " <?=Aabc::$app->d->i?> = <?=Aabc::$app->_model->__image?>>
                                    <span class="ico icon1"></span>
                                    <p>QL Ảnh m</p>
                                </div>
                            </li>

                            <li id ='menu0' class="menu-child" >
                                <div id ='menu0' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham')?> class="menu-item pjb" <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon14"></span>
                                    <p>Thống kê doanh thu</p>
                                </div>
                            </li>
                           
                           
                        </ul>
                    </div>
                </li>

                <li>
                    <span>Danh mục</span>
                    <div class="menu-child-all">
                        <ul class="menu"> 
                            
                            <li id ='menu0' class="menu-child" >
                                <div id ='menu0' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham')?> class="menu-item pjb" <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon2"></span>
                                    <p>Sản phẩm</p>
                                </div>
                            </li>

                            <li id ='menu0' class="menu-child" >
                                <div id ='menu0' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham')?> class="menu-item pjb" <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon3"></span>
                                    <p>Thống kê doanh thu</p>
                                </div>
                            </li>
                        </ul>

                         <ul class="menu"> 
                             <li id ='menu00' class="menu-child" >
                                <div id ='menu00' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham?sort=-sp_id')?> class="menu-item pjb " <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon4"></span>
                                    <p>Danh sách</p>
                                </div>
                            </li>
                            <li id ='menu0' class="menu-child" >
                                <div id ='menu0' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham')?> class="menu-item pjb" <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon5"></span>
                                    <p>Sản phẩm</p>
                                </div>
                            </li>

                            <li id ='menu0' class="menu-child" >
                                <div id ='menu0' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham')?> class="menu-item pjb" <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon6"></span>
                                    <p>Thống kê doanh thu</p>
                                </div>
                            </li>
                        </ul>


                         <ul class="menu"> 
                             <li id ='menu00' class="menu-child" >
                                <div id ='menu00' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham?sort=-sp_id')?> class="menu-item pjb " <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon7"></span>
                                    <p>Danh sách</p>
                                </div>
                            </li>
                            <li id ='menu0' class="menu-child" >
                                <div id ='menu0' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham')?> class="menu-item pjb" <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon8"></span>
                                    <p>Sản phẩm</p>
                                </div>
                            </li>

                            <li id ='menu0' class="menu-child" >
                                <div id ='menu0' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham')?> class="menu-item pjb" <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon9"></span>
                                    <p>Thống kê doanh thu</p>
                                </div>
                            </li>
                            <li id ='menu0' class="menu-child" >
                                <div id ='menu0' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham')?> class="menu-item pjb" <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon10"></span>
                                    <p>Sản phẩm</p>
                                </div>
                            </li>

                           
                        </ul>

                        <ul class="menu"> 
                             <li id ='menu00' class="menu-child" >
                                <div id ='menu00' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham?sort=-sp_id')?> class="menu-item pjb " <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon12"></span>
                                    <p>Danh sách</p>
                                </div>
                            </li>
                            <li id ='menu0' class="menu-child" >
                                <div id ='menu0' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham')?> class="menu-item pjb" <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon13"></span>
                                    <p>Sản phẩm</p>
                                </div>
                            </li>

                            <li id ='menu0' class="menu-child" >
                                <div id ='menu0' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham')?> class="menu-item pjb" <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon14"></span>
                                    <p>Thống kê doanh thu</p>
                                </div>
                            </li>
                            <li id ='menu0' class="menu-child" >
                                <div id ='menu0' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham')?> class="menu-item pjb" <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon15"></span>
                                    <p>Sản phẩm</p>
                                </div>
                            </li>

                            <li id ='menu0' class="menu-child" >
                                <div id ='menu0' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham')?> class="menu-item pjb" <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon16"></span>
                                    <p>Thống kê doanh thu</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>



                <li>
                    <span>Sản phẩm</span>
                    <div class="menu-child-all">
                        <ul class="menu">                             
                            <li id ='menu0' class="menu-child" >
                                <div id ='menu0' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham')?> class="menu-item pjb" <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon2"></span>
                                    <p>Sản phẩm</p>
                                </div>
                            </li>

                            <li id ='menu0' class="menu-child" >
                                <div id ='menu0' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham')?> class="menu-item pjb" <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon3"></span>
                                    <p>Thống kê doanh thu</p>
                                </div>
                            </li>
                        </ul>

                         <ul class="menu"> 
                             <li id ='menu00' class="menu-child" >
                                <div id ='menu00' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham?sort=-sp_id')?> class="menu-item pjb " <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon4"></span>
                                    <p>Danh sách</p>
                                </div>
                            </li>
                            <li id ='menu0' class="menu-child" >
                                <div id ='menu0' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham')?> class="menu-item pjb" <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon5"></span>
                                    <p>Sản phẩm</p>
                                </div>
                            </li>

                            <li id ='menu0' class="menu-child" >
                                <div id ='menu0' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham')?> class="menu-item pjb" <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon6"></span>
                                    <p>Thống kê doanh thu</p>
                                </div>
                            </li>
                        </ul>


                         <ul class="menu"> 
                             <li id ='menu00' class="menu-child" >
                                <div id ='menu00' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham?sort=-sp_id')?> class="menu-item pjb " <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon7"></span>
                                    <p>Danh sách</p>
                                </div>
                            </li>
                            <li id ='menu0' class="menu-child" >
                                <div id ='menu0' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham')?> class="menu-item pjb" <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon8"></span>
                                    <p>Sản phẩm</p>
                                </div>
                            </li>

                            <li id ='menu0' class="menu-child" >
                                <div id ='menu0' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham')?> class="menu-item pjb" <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon9"></span>
                                    <p>Thống kê doanh thu</p>
                                </div>
                            </li>
                            <li id ='menu0' class="menu-child" >
                                <div id ='menu0' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham')?> class="menu-item pjb" <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon10"></span>
                                    <p>Sản phẩm</p>
                                </div>
                            </li>

                            <li id ='menu0' class="menu-child" >
                                <div id ='menu0' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham')?> class="menu-item pjb" <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon11"></span>
                                    <p>Thống kê doanh thu</p>
                                </div>
                            </li>
                        </ul>

                        <ul class="menu"> 
                             <li id ='menu00' class="menu-child" >
                                <div id ='menu00' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham?sort=-sp_id')?> class="menu-item pjb " <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon12"></span>
                                    <p>Danh sách</p>
                                </div>
                            </li>
                            <li id ='menu0' class="menu-child" >
                                <div id ='menu0' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham')?> class="menu-item pjb" <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon13"></span>
                                    <p>Sản phẩm</p>
                                </div>
                            </li>

                            <li id ='menu0' class="menu-child" >
                                <div id ='menu0' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham')?> class="menu-item pjb" <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon14"></span>
                                    <p>Thống kê doanh thu</p>
                                </div>
                            </li>
                            <li id ='menu0' class="menu-child" >
                                <div id ='menu0' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham')?> class="menu-item pjb" <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon15"></span>
                                    <p>Sản phẩm</p>
                                </div>
                            </li>

                            <li id ='menu0' class="menu-child" >
                                <div id ='menu0' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham')?> class="menu-item pjb" <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon16"></span>
                                    <p>Thống kê doanh thu</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>



                <li>
                    <span>Nghiệp vụ</span>
                    <div class="menu-child-all">
                        <ul class="menu"> 
                             <li id ='menu00' class="menu-child" >
                                <div id ='menu00' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham?sort=-sp_id')?> class="menu-item pjb " <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon1"></span>
                                    <p>Danh sách</p>
                                </div>
                            </li>
                            <li id ='menu0' class="menu-child" >
                                <div id ='menu0' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham')?> class="menu-item pjb" <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon2"></span>
                                    <p>Sản phẩm</p>
                                </div>
                            </li>
                           
                        </ul>

                         <ul class="menu"> 
                             <li id ='menu00' class="menu-child" >
                                <div id ='menu00' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham?sort=-sp_id')?> class="menu-item pjb " <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon4"></span>
                                    <p>Danh sách</p>
                                </div>
                            </li>
                            <li id ='menu0' class="menu-child" >
                                <div id ='menu0' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham')?> class="menu-item pjb" <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon5"></span>
                                    <p>Sản phẩm</p>
                                </div>
                            </li>

                            <li id ='menu0' class="menu-child" >
                                <div id ='menu0' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham')?> class="menu-item pjb" <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon6"></span>
                                    <p>Thống kê doanh thu</p>
                                </div>
                            </li>
                        </ul>


                         <ul class="menu"> 
                             <li id ='menu00' class="menu-child" >
                                <div id ='menu00' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham?sort=-sp_id')?> class="menu-item pjb " <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon7"></span>
                                    <p>Danh sách</p>
                                </div>
                            </li>
                           

                            <li id ='menu0' class="menu-child" >
                                <div id ='menu0' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham')?> class="menu-item pjb" <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon9"></span>
                                    <p>Thống kê doanh thu</p>
                                </div>
                            </li>
                            <li id ='menu0' class="menu-child" >
                                <div id ='menu0' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham')?> class="menu-item pjb" <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon10"></span>
                                    <p>Sản phẩm</p>
                                </div>
                            </li>

                            <li id ='menu0' class="menu-child" >
                                <div id ='menu0' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham')?> class="menu-item pjb" <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon11"></span>
                                    <p>Thống kê doanh thu</p>
                                </div>
                            </li>
                        </ul>

                        <ul class="menu"> 
                             <li id ='menu00' class="menu-child" >
                                <div id ='menu00' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham?sort=-sp_id')?> class="menu-item pjb " <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon12"></span>
                                    <p>Danh sách</p>
                                </div>
                            </li>
                            <li id ='menu0' class="menu-child" >
                                <div id ='menu0' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham')?> class="menu-item pjb" <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon13"></span>
                                    <p>Sản phẩm</p>
                                </div>
                            </li>

                            <li id ='menu0' class="menu-child" >
                                <div id ='menu0' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham')?> class="menu-item pjb" <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon14"></span>
                                    <p>Thống kê doanh thu</p>
                                </div>
                            </li>
                            <li id ='menu0' class="menu-child" >
                                <div id ='menu0' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham')?> class="menu-item pjb" <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon15"></span>
                                    <p>Sản phẩm</p>
                                </div>
                            </li>

                            <li id ='menu0' class="menu-child" >
                                <div id ='menu0' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham')?> class="menu-item pjb" <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon16"></span>
                                    <p>Thống kê doanh thu</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>


                <li>
                    <span>Bài viết</span>
                    <div class="menu-child-all">
                        <ul class="menu">                             
                            <li id ='menu0' class="menu-child" >
                                <div id ='menu0' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham')?> class="menu-item pjb" <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon2"></span>
                                    <p>Sản phẩm</p>
                                </div>
                            </li>
                          
                        </ul>

                         <ul class="menu"> 
                             <li id ='menu00' class="menu-child" >
                                <div id ='menu00' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham?sort=-sp_id')?> class="menu-item pjb " <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon4"></span>
                                    <p>Danh sách</p>
                                </div>
                            </li>
                            <li id ='menu0' class="menu-child" >
                                <div id ='menu0' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham')?> class="menu-item pjb" <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon5"></span>
                                    <p>Sản phẩm</p>
                                </div>
                            </li>

                            <li id ='menu0' class="menu-child" >
                                <div id ='menu0' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham')?> class="menu-item pjb" <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon6"></span>
                                    <p>Thống kê doanh thu</p>
                                </div>
                            </li>
                        </ul>


                         <ul class="menu"> 
                             <li id ='menu00' class="menu-child" >
                                <div id ='menu00' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham?sort=-sp_id')?> class="menu-item pjb " <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon7"></span>
                                    <p>Danh sách</p>
                                </div>
                            </li>
                            <li id ='menu0' class="menu-child" >
                                <div id ='menu0' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham')?> class="menu-item pjb" <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon8"></span>
                                    <p>Sản phẩm</p>
                                </div>
                            </li>

                            <li id ='menu0' class="menu-child" >
                                <div id ='menu0' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham')?> class="menu-item pjb" <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon9"></span>
                                    <p>Thống kê doanh thu</p>
                                </div>
                            </li>
                            <li id ='menu0' class="menu-child" >
                                <div id ='menu0' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham')?> class="menu-item pjb" <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon10"></span>
                                    <p>Sản phẩm</p>
                                </div>
                            </li>

                            <li id ='menu0' class="menu-child" >
                                <div id ='menu0' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham')?> class="menu-item pjb" <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon11"></span>
                                    <p>Thống kê doanh thu</p>
                                </div>
                            </li>
                        </ul>

                        <ul class="menu"> 
                             <li id ='menu00' class="menu-child" >
                                <div id ='menu00' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham?sort=-sp_id')?> class="menu-item pjb " <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon12"></span>
                                    <p>Danh sách</p>
                                </div>
                            </li>
                            <li id ='menu0' class="menu-child" >
                                <div id ='menu0' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham')?> class="menu-item pjb" <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon13"></span>
                                    <p>Sản phẩm</p>
                                </div>
                            </li>

                            <li id ='menu0' class="menu-child" >
                                <div id ='menu0' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham')?> class="menu-item pjb" <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon14"></span>
                                    <p>Thống kê doanh thu</p>
                                </div>
                            </li>
                            <li id ='menu0' class="menu-child" >
                                <div id ='menu0' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham')?> class="menu-item pjb" <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon15"></span>
                                    <p>Sản phẩm</p>
                                </div>
                            </li>

                            <li id ='menu0' class="menu-child" >
                                <div id ='menu0' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham')?> class="menu-item pjb" <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon16"></span>
                                    <p>Thống kê doanh thu</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>


                <li>
                    <span>Báo cáo - Thống kê</span>
                    <div class="menu-child-all">
                       
                         <ul class="menu"> 
                             <li id ='menu00' class="menu-child" >
                                <div id ='menu00' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham?sort=-sp_id')?> class="menu-item pjb " <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon4"></span>
                                    <p>Danh sách</p>
                                </div>
                            </li>
                            <li id ='menu0' class="menu-child" >
                                <div id ='menu0' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham')?> class="menu-item pjb" <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon5"></span>
                                    <p>Sản phẩm</p>
                                </div>
                            </li>

                            <li id ='menu0' class="menu-child" >
                                <div id ='menu0' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham')?> class="menu-item pjb" <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon6"></span>
                                    <p>Thống kê doanh thu</p>
                                </div>
                            </li>
                        </ul>


                         <ul class="menu"> 
                             <li id ='menu00' class="menu-child" >
                                <div id ='menu00' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham?sort=-sp_id')?> class="menu-item pjb " <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon7"></span>
                                    <p>Danh sách</p>
                                </div>
                            </li>
                            <li id ='menu0' class="menu-child" >
                                <div id ='menu0' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham')?> class="menu-item pjb" <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon8"></span>
                                    <p>Sản phẩm</p>
                                </div>
                            </li>

                            <li id ='menu0' class="menu-child" >
                                <div id ='menu0' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham')?> class="menu-item pjb" <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon9"></span>
                                    <p>Thống kê doanh thu</p>
                                </div>
                            </li>
                            <li id ='menu0' class="menu-child" >
                                <div id ='menu0' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham')?> class="menu-item pjb" <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon10"></span>
                                    <p>Sản phẩm</p>
                                </div>
                            </li>

                            <li id ='menu0' class="menu-child" >
                                <div id ='menu0' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham')?> class="menu-item pjb" <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon11"></span>
                                    <p>Thống kê doanh thu</p>
                                </div>
                            </li>
                        </ul>

                        <ul class="menu"> 
                             <li id ='menu00' class="menu-child" >
                                <div id ='menu00' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham?sort=-sp_id')?> class="menu-item pjb " <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon12"></span>
                                    <p>Danh sách</p>
                                </div>
                            </li>
                            <li id ='menu0' class="menu-child" >
                                <div id ='menu0' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham')?> class="menu-item pjb" <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon13"></span>
                                    <p>Sản phẩm</p>
                                </div>
                            </li>

                            <li id ='menu0' class="menu-child" >
                                <div id ='menu0' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham')?> class="menu-item pjb" <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon14"></span>
                                    <p>Thống kê doanh thu</p>
                                </div>
                            </li>
                            <li id ='menu0' class="menu-child" >
                                <div id ='menu0' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham')?> class="menu-item pjb" <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon15"></span>
                                    <p>Sản phẩm</p>
                                </div>
                            </li>

                            <li id ='menu0' class="menu-child" >
                                <div id ='menu0' <?=Aabc::$app->d->u?>=<?=Url::to(Aabc::$app->homeUrl.'sanpham')?> class="menu-item pjb" <?=Aabc::$app->d->i?> = 'sanpham'>
                                    <span class="ico icon16"></span>
                                    <p>Thống kê doanh thu</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>

                 <li>
                    <span>Cài đặt - Cấu hình</span>
                    <div class="menu-child-all">
                        <ul class="menu">                             
                            <li id ='' class="menu-child" >
                                <div id ='' <?=Aabc::$app->d->u?>='u' class="menu-item pjb " <?=Aabc::$app->d->i?> = <?=Aabc::$app->_model->__cauhinhcaidat?> >
                                    <span class="ico icon3"></span>
                                    <p>Thông tin chung</p>
                                </div>
                            </li>

                            <li id ='' class="menu-child" >
                                <div id ='' <?=Aabc::$app->d->u?>='i_b?sort=-sp_id' class="menu-item pjb " <?=Aabc::$app->d->i?> = <?=Aabc::$app->_model->__sanpham?> >
                                    <span class="ico icon3"></span>
                                    <p>Quản lý Menu</p>
                                </div>
                            </li>

                            <li id ='' class="menu-child" >
                                <div id ='' <?=Aabc::$app->d->u?>='i_b?sort=-sp_id' class="menu-item pjb " <?=Aabc::$app->d->i?> = <?=Aabc::$app->_model->__sanpham?> >
                                    <span class="ico icon3"></span>
                                    <p>Quản lý Slide ảnh</p>
                                </div>
                            </li>

                            <li id ='' class="menu-child" >
                                <div id ='' <?=Aabc::$app->d->u?>='i_b?sort=-sp_id' class="menu-item pjb " <?=Aabc::$app->d->i?> = <?=Aabc::$app->_model->__sanpham?> >
                                    <span class="ico icon3"></span>
                                    <p>Phân quyền người dùng</p>
                                </div>
                            </li>
                        </ul>

                         <ul class="menu"> 
                             <li id ='' class="menu-child" >
                                <div id ='' <?=Aabc::$app->d->u?>='i_km?sort=-cs_id' class="menu-item pjb " <?=Aabc::$app->d->i?> = <?=Aabc::$app->_model->__chinhsach?> >
                                    <span class="ico icon4"></span>
                                    <p>Khuyến mại tặng kèm</p>
                                </div>
                            </li>

                            <li id ='' class="menu-child" >
                                <div id ='' <?=Aabc::$app->d->u?>='i_bh?sort=-cs_id' class="menu-item pjb " <?=Aabc::$app->d->i?> = <?=Aabc::$app->_model->__chinhsach?> >
                                    <span class="ico icon5"></span>
                                    <p>Chính sách bảo hành</p>
                                </div>
                            </li>

                            <li id ='' class="menu-child" >
                                <div id ='' <?=Aabc::$app->d->u?>='i_gh?sort=-cs_id' class="menu-item pjb " <?=Aabc::$app->d->i?> = <?=Aabc::$app->_model->__chinhsach?> >
                                    <span class="ico icon6"></span>
                                    <p>Chính sách giao hàng</p>
                                </div>
                            </li>
                        </ul>


                         <ul class="menu"> 
                             
                        </ul>

                        <ul class="menu"> 
                             
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
'   d_i = "'.Aabc::$app->d->i.'";
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