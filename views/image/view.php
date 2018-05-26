<?php

use aabc\helpers\Html;
use aabc\widgets\DetailView;
use aabc\helpers\Url; /*Them*/
/* @var $this aabc\web\View */
/* @var $model backend\models\Image */

$this->title = 'Chi tiết ảnh';
$this->params['breadcrumbs'][] = ['label' => 'Images', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="<?= Aabc::$app->_model->__image?>-view dtview">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    $_Image = Aabc::$app->_model->Image;

    $searchnext = $_Image::find()
                ->andWhere(['>', Aabc::$app->_image->image_id, $model[Aabc::$app->_image->image_id]])
                ->orderBy([Aabc::$app->_image->image_id=>SORT_ASC])
                ->one();

    $searchpre = $_Image::find()
                ->andWhere(['<', Aabc::$app->_image->image_id, $model[Aabc::$app->_image->image_id]])
                ->orderBy([Aabc::$app->_image->image_id=>SORT_DESC])
                ->one();
    // echo '<pre>';
    // print_r($search);die;
    ?>



    <div class="imgct">
        <?php 
        $size = $model[Aabc::$app->_image->image_size];    
        $findme   = 'x';
        $pos = strpos($size, $findme);
        $height = (int)substr($size,$pos+1,5);
        $tyle = 0;
        if($height > 450){
            $tyle = (int)(450 / $height * 100);
            $height = 450;
        }else{
            $tyle = 100;
        }        
        
        echo '<div class="imgcti">
            <img src="'.Url::to('' . $model[Aabc::$app->_image->image_link] . $model[Aabc::$app->_image->image_tenfile] . '-' . $model[Aabc::$app->_image->image_id]   . $model[Aabc::$app->_image->image_morong], true).'?t='.Time().'" height="'.$height.'" title="Click vào để mở ảnh ra tab mới."/>
            </div><br/>';


        if(isset($searchpre)){
            echo '<button type="button"  '.Aabc::$app->d->m.'=""  class="kcm mb btn btn-primary fl" '.Aabc::$app->d->i.'='.Aabc::$app->_model->__image.'  '.Aabc::$app->d->u.'="v?id='.$searchpre[Aabc::$app->_image->image_id].'">'.Aabc::$app->MyConst->gridview_menu_cuhon.'</button>';
        }


        echo '<i>Hiển thị tỷ lệ '.$tyle.'% so với thực tế. <a target="_blank" href="'.Url::to('' .$model[Aabc::$app->_image->image_link] . $model[Aabc::$app->_image->image_tenfile] . '-' . $model[Aabc::$app->_image->image_id]   . $model[Aabc::$app->_image->image_morong], true).'">
            (xem thực tế)
            </a></i>';

         if(isset($searchnext)){
            echo '<button type="button"  '.Aabc::$app->d->m.'=""  class="kcm mb btn btn-success fr" '.Aabc::$app->d->i.'='.Aabc::$app->_model->__image.'  '.Aabc::$app->d->u.'="v?id='.$searchnext[Aabc::$app->_image->image_id].'">'.Aabc::$app->MyConst->gridview_menu_moihon.'</button>';
        }

        ?>
    </div>

    <div class='pt2'>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [  
            Aabc::$app->_image->image_tenfile,

            [
                'label'=> 'Đường dẫn',
                'format'=>'raw',                
                'value'=> Url::to('' .$model[Aabc::$app->_image->image_link] . $model[Aabc::$app->_image->image_tenfile] . '-' . $model[Aabc::$app->_image->image_id]   . $model[Aabc::$app->_image->image_morong], true),
            ],
                        
            Aabc::$app->_image->image_size,
            
            [
                'label' => Aabc::$app->_image->__image_byte, 
                'value' => $model[Aabc::$app->_image->image_byte] . ' KiB',
            ]
            
        ],
    ]) ?>
    </div>

    <div class="dnn">
        <fieldset>               
            <legend>Chức năng</legend>

            <?php
                echo 
                    '<button type="button"  '.Aabc::$app->d->m.'=""  class="kcm mb btn btn-default fl" '.Aabc::$app->d->i.'='.Aabc::$app->_model->__image.'  '.Aabc::$app->d->u.'="v?id='.$model[Aabc::$app->_image->image_id].'&ro=1">Xoay ảnh sang trái</button>

                    <button type="button"  '.Aabc::$app->d->m.'=""  class="kcm mb btn btn-default fl" '.Aabc::$app->d->i.'='.Aabc::$app->_model->__image.'  '.Aabc::$app->d->u.'="v?id='.$model[Aabc::$app->_image->image_id].'&ro=3">Xoay ảnh sang phải</button>

                     <button type="button" title="Sẽ được chuyển vào thùng rác" class="br btn btn-danger fl" '.Aabc::$app->d->m.'="" '.Aabc::$app->d->i.'='.Aabc::$app->_model->__image.'  '.Aabc::$app->d->u.'="rec?id='.$model[Aabc::$app->_image->image_id].'">'.Aabc::$app->MyConst->gridview_menu_thungrac.'</button>

                    ';

            ?>
        </fieldset> 
    </div>
    <div style="clear: both;"></div>
</div>
