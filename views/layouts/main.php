<?php

/* @var $this \aabc\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use aabc\helpers\Html;
use aabc\bootstrap\Nav;
use aabc\bootstrap\NavBar;
use aabc\widgets\Breadcrumbs;
use common\widgets\Alert;

use aabc\bootstrap\Modal; /*Them*/
use aabc\helpers\Url; /*Them*/

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<!-- <html lang="//Aabc::$app->language " > -->
<html lang="en">
<head>
    <style type="text/css">
        #aabc-debug-toolbar{display: none !important}
    </style>
    <meta charset="<?= Aabc::$app->charset ?>">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <meta name="robots" content="noodp,noindex,nofollow"/>
    <meta name="viewport" content="width=device-width, initial-scale=1,minimum-scale=1, maximum-scale=1"/>
    <?= Html::csrfMetaTags() ?>
    <!-- <title><? //echo Html::encode($this->title) ?></title> -->
    <title>Phần mềm quản lý</title>
    
    <?php $this->head() ?>
</head>
<body>
<div>
<?php $this->beginBody() ?>
   
<div class="wrap">
    <?php
    // NavBar::begin([
    //     'brandLabel' => 'AABC',
    //     'brandUrl' => Aabc::$app->homeUrl,
    //     'options' => [
    //         'class' => 'header navbar-fixed-top',
    //     ],
    // ]);
    // $menuItems = [
    //     ['label' => 'Home', 'url' => ['/site/index']],
    // ];
    // if (Aabc::$app->user->isGuest) {
    //     $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    // } else {
    //     $menuItems[] = '<li>'
    //         . Html::beginForm(['/site/logout'], 'post')
    //         . Html::submitButton(
    //             'Logout (' . Aabc::$app->user->identity->username . ')',
    //             ['class' => 'btn btn-link logout']
    //         )
    //         . Html::endForm()
    //         . '</li>';
    // }
    // echo Nav::widget([
    //     'options' => ['class' => 'navbar-nav navbar-right'],
    //     'items' => $menuItems,
    // ]);
    // NavBar::end();
    ?>



    <div class="">
        <?php
        //  Breadcrumbs::widget([
        //     'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        // ]) ?>
        <?php // Alert::widget() ?>

<?php 
        if(isset(Aabc::$app->user->identity->id)){
            // echo Aabc::$app->user->id . '</br>';
            // echo Aabc::$app->user->identity->username . '</br>';
            // echo Aabc::$app->user->identity->auth_key . '</br>';
            // echo Aabc::$app->user->identity->password_hash . '</br>';
            // echo Aabc::$app->user->identity->email . '</br>';
            // echo Aabc::$app->user->identity->status . '</br>';
        }
        // echo Aabc::$app->user->identity->tuyen . '</br>';
    ?>     

        <div id="main">
            <?= $content ?>
        </div>


        <div class="footer">           
        </div>
        <footer>
            
        </footer>

       </div>
</div>


<?php
    Modal::begin([
            'header'=>'',
            'id'=>'modalicon',
            'size'=>'modal-lg',
            'options' => [
                'tabindex' => false //for working select2
            ],
            'clientOptions' => ['backdrop' => 'static', 'keyboard' => false]
        ]);
    echo "<div id='modalContenticon' class='clcontent'></div>";
    Modal::end();
?>


<?php
    Modal::begin([
            'header'=>'',
            'id'=>'modal',
            'size'=>'modal-lg',
            'options' => [
                'tabindex' => false //for working select2
            ],
            'clientOptions' => ['backdrop' => 'static', 'keyboard' => false]
        ]);
    echo "<div id='modalContent' class='clcontent'></div>";
    Modal::end();
?>


<?php
    Modal::begin([
        'header'=>'',
        'id'=>'modal2',
        'size'=>'modal-md',        
        'options' => [
            'tabindex' => false //for working select2
        ],
        'clientOptions' => ['backdrop' => 'static', 'keyboard' => false] 
    ]);
    echo "<div id='modalContent2' class='clcontent'></div>";
    Modal::end();
?>
<?php
    Modal::begin([
        'header'=>'',
        'id'=>'modal3',
        'size'=>'modal-sm',
        'options' => [
            'tabindex' => false //for working select2
        ],
        'clientOptions' => ['backdrop' => 'static', 'keyboard' => false] 
    ]);
    echo "<div id='modalContent3' class='clcontent'></div>";
    Modal::end();
?>




<?php
    Modal::begin([
        'header'=>'<div class="gmisct">Chọn ảnh</div>',
        'id'=>'modal4',
        'size'=>'modal-lg',
        'options' => [
            'tabindex' => false //for working select2
        ],
        'clientOptions' => ['backdrop' => 'static', 'keyboard' => false] 
    ]);
    echo "<div id='modalContent4' class='clcontent'></div>";
    echo '
    <div class="form-group right">        
        <button type="button" class="btn btn-primary chona" data-dismiss="modal" aria-hidden="true">Đồng ý</button>
        <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Bỏ qua</button>
    </div>';
    Modal::end();
?>


<div id="tuyen"></div>
<div id="imgloading">   
    <div class="loader">Loading...</div>
    <!-- <img width="68px" src="<?php //echo Url::to(Aabc::$app->homeUrl.'image/loading.gif')?>" />     -->
</div>
<style type="text/css">
    .loader,
    .loader:after {
        border-radius: 50%;
        width: 10em;
        height: 10em;
    }
    .loader {
        margin: 0;
        font-size: 4px;
        position: relative;
        text-indent: -9999em;
        border-top: 1.1em solid rgba(249, 168, 19, 0.35);
        border-right: 1.1em solid rgba(249, 168, 19, 0.35);
        border-bottom: 1.1em solid rgba(249, 168, 19, 0.35);
        border-left: 1.1em solid #f9a813;
        -webkit-transform: translateZ(0);
        -ms-transform: translateZ(0);
        transform: translateZ(0);
        -webkit-animation: load8 1s infinite linear;
        animation: load8 0.5s infinite linear;
    }
    @-webkit-keyframes load8 {
      0% {
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
      }
      100% {
        -webkit-transform: rotate(360deg);
        transform: rotate(360deg);
      }
    }
    @keyframes load8 {
      0% {
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
      }
      100% {
        -webkit-transform: rotate(360deg);
        transform: rotate(360deg);
      }
    }
</style>



<!-- <div id="loading">    
    <div></div>    
</div> -->

<div class="popupalert"></div>
</div>

<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
