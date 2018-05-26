<?php

use aabc\helpers\Html;
use aabc\helpers\Url; /*Them*/
/* @var $this aabc\web\View */
/* @var $model backend\models\Image */
/* @var $form aabc\widgets\ActiveForm */
?>

<div class="image-item">
        <div class="col-md-3 image-to-choose">
            <div class="item chimg">
                <img src="<?='/thumb/75/75/'. $model[Aabc::$app->_image->image_tenfile] . '-' . $model[Aabc::$app->_image->image_id]   . $model[Aabc::$app->_image->image_morong] ?>"  <?=Aabc::$app->d->lk?>="<?='/' .$model[Aabc::$app->_image->image_link] . $model[Aabc::$app->_image->image_tenfile] . '-' . $model[Aabc::$app->_image->image_id]   . $model[Aabc::$app->_image->image_morong] ?>"/>
                <br/><?=$model[Aabc::$app->_image->image_size]?>
            </div>
        </div>


</div>

