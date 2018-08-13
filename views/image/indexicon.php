<?php

use aabc\helpers\Html;   
use aabc\grid\GridView;
use aabc\widgets\ListView;

//use aabc\bootstrap\Modal; /*Them*/
use aabc\helpers\Url; /*Them*/
use aabc\helpers\ArrayHelper; /*Them*/
use aabc\widgets\ActiveForm;

use common\components\Tuyen;
/*use app\models\Dskh; */


/* @var $this aabc\web\View */
// use backend\models\ImageSearch ;
// use backend\models\Image ;
/* @var $dataProvider aabc\data\ActiveDataProvider */

$this->title = 'Images';
$this->params['breadcrumbs'][] = $this->title;

if(empty($icon)) $icon = '';

?>

<div id="pj<?=Aabc::$app->_model->__image?>"    <?=Aabc::$app->d->i?>=<?= Aabc::$app->_model->__image?> class="pj gmi">

    <h1>Chọn icon</h1>


<div id="list-icon" class="<?= Aabc::$app->_model->__image?>-index">
    <style type="text/css">
        button{
            cursor: pointer !important;
        }
        #search_btn{
            cursor: pointer !important;
            margin: 0 0 10px 0;
            color: #fff;
            background-color: #5cb85c;
            border-color: #4cae4c;
            padding: 5px 10px;
            width: auto;
            text-align: center;
            font-size: 14px;
            border: 0;
            text-decoration: none;
            vertical-align: baseline;
            position: static;
            transition: none;
            font: normal normal normal 12px Arial,Helvetica,Tahoma,Verdana,Sans-Serif;
            white-space: nowrap;
            cursor: auto;
            float: none;
        }
        a#search_btn>span{
            font-family: 'Glyphicons Halflings' !important;
            color: #FFF;
        }

        .box-cmau {
            position: absolute;
            top: 50px;
            z-index: 9999;
        }
        .cmau {            
            width: 20px;
            height: 20px;
            display: inline-flex;
            margin: 0;
            cursor: pointer;
        }
    </style>
            <div class="box-cmau">
                <strong>Chọn màu sắc: </strong>
                <div id="m-1" class="cmau"></div>
                <div id="m-2" class="cmau"></div>
                <div id="m-3" class="cmau"></div>
                <div id="m-4" class="cmau"></div>
                <div id="m-5" class="cmau"></div>
                <div id="m-6" class="cmau"></div>
                <div id="m-7" class="cmau"></div>
                <div id="m-8" class="cmau"></div>
                <div id="m-9" class="cmau"></div>
                <div id="m-10" class="cmau"></div>
                <div id="m-11" class="cmau"></div>
                <div id="m-12" class="cmau"></div>
                <div id="m-13" class="cmau"></div>
                <div id="m-14" class="cmau"></div>
                <div id="m-15" class="cmau"></div>
                <div id="m-16" class="cmau"></div>
                <div id="m-17" class="cmau"></div>
                <div id="m-18" class="cmau"></div>
                <div id="m-19" class="cmau"></div>
                <div id="m-20" class="cmau"></div>
                <div id="m-21" class="cmau"></div>
                <div id="m-22" class="cmau"></div>
                <div id="m-23" class="cmau"></div>
                <div id="m-24" class="cmau"></div>
                <div id="m-25" class="cmau"></div>
                <div id="m-26" class="cmau"></div>
                <div id="m-27" class="cmau"></div>
                              
            </div>

            <div class="tim-icon">

                <?php 
                    $d_u = '';
                    if(!empty($_GET['s'])) $d_u = $_GET['s'];
                ?>

                <input value="<?= $d_u?>" id="search_img_icon" placeholder="Tìm kiếm icon..." type="text" name="search_img" style="padding: 3px 5px;    border: 1px solid #aaa;width: 200px;background: #FFF;">
                                                
            </div>

            <script type="text/javascript">
            
                $('#search_img_icon').on('keyup keypress', function(e) {
                    v = $(this).val().toUpperCase()
                    // console.log(v)
                    $('#list-icon .image-item').each(function(){
                        content = $(this).find('.item.chicon>p').html().toUpperCase();                        
                        if(content.indexOf(v) > -1){
                            $(this).removeClass('hide')
                        }else{
                            $(this).addClass('hide')
                        }
                    })                    
                })
                

            </script>


<style type="text/css">
    input#search_img_icon {
    font-size: 12px;
    /* line-height: 12px; */
}
    .icon {
        width: 40px;
        height: 40px;
        margin: 5px auto 10px auto;
    }

    .item.chosen-image:before{
        margin: 0;
        border: 2px solid #2496da !important;
    }

   .item {
        float: left;
        position: relative;
        margin: 4px 3px 4px 2px;
        text-align: center;
            width: 70px;
        padding: 5px;
        height: 100px;
        font-size: 12px;
    }

    .list-view {
        float: left;
        width: 100%;

    }

    #pjimage .endgr {
        float: left;
        margin: 10px 0;
        width: 100%;
        text-align: center;
        background: transparent;
    }


     .image-to-choose .item::before {
        border: thin solid #DCDCDC;
        border-radius: 3px;
        z-index: 1;
        content: "";
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
    }


    

</style>

    <?php 
    if(is_array($data)) foreach ($data as $k => $v) {?>
        <?php 
            if(strpos($k,'---') !== false){
                echo '<div class="clearfix"></div>';
            }else{
        ?>
            <div class="image-item">
                <div class="image-to-choose">
                    <div class="item chicon" <?= Tuyen::lk .'='.$k?> >                    
                        <?php                         
                            echo Tuyen::_icon($k);
                        ?>
                        <p><?= $v?></p>                    
                    </div>
                </div>
            </div>  
        <?php } ?>

    <?php } ?>
   

<div style="clear: both"></div>

</div>
</div>



    <div class="form-group right">        
        <button type="button" class="btn btn-primary choni" data-e="<?= $element?>" data-dismiss="modal" aria-hidden="true">Đồng ý</button>
        <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Đóng</button>
    </div>
