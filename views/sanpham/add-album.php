<?php
use aabc\helpers\Html;
use backend\models\Sanpham;
use common\cont\D;

if(!isset($random)){
	$random = (string)time();
}

if(empty($star)) $star = '';

if(!isset($album)){
	$album = [
		'title' => '',
		'list' => [],
	];
}

?>
<div class="col-md-12 l-album clearfix ">
    <input type="radio" title="ALbum nổi bật" name="Al[star]" <?= $random == $star?'checked':''?> value="<?= $random ?>" class="pull-left" style="font-size: 14px;color: #6495ed;" />
    <div class="pull-left" style="width: calc(100% - 220px); padding: 0 0 0 5px;">    	
        <input type="text" name="Al[<?= $random?>][title]" placeholder="Nhập tên album ảnh..." value="<?= $album['title']?>" class="form-control" style="font-size: 14px;color: #6495ed;" />
    </div>        
    <div class="pull-left text-right"  style="width: 200px">
        <?= '<button type="button" '.D::m.' = "2" id="mb'.Sanpham::tt.'"  '.D::u .'="ga?i=icon&e=editable'.$random.'" class="btn btn-default mb" style="height: 30px;"  '. D::i.'='.Aabc::$app->_model->__image.'><span class="glyphicon glyphicon-picture mtrang"></span>Chọn ảnh</button>'?>
        <span class="btn btn-default del-album"><span class="glyphicon glyphicon-trash"></span> Xóa album</span>
    </div>

    <ul id="editable<?= $random?>" class="editable" style="padding: 0 5px"> 
        <?php            
            if(isset($album['list'])) foreach ($album['list'] as $key => $value) {
                $_Image = Aabc::$app->_model->Image;
                $img = $_Image::find()->andWhere([Aabc::$app->_image->image_id => $value])->one();
                if(isset($img)){
                    echo '<li><input type="hidden" name="Al['.$random.'][list][]" value="'.$value.'" /><img src="/thumb/75/75/'.$img[Aabc::$app->_image->image_tenfile]. '-' . $img[Aabc::$app->_image->image_id]. $img[Aabc::$app->_image->image_morong].'"><i class="js-remove">✖</i></li>';
                }                                           
            }            
        ?>           
    </ul>
    <div class="selected-product-image" dt-n='Al[<?= $random?>][list]'><input /></div>    
    <script type="text/javascript">                
        (function () {
            'use strict';
            var byId = function (id) { return document.getElementById(id); }
               
            var editableList = Sortable.create(byId('editable<?= $random?>'), {
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
