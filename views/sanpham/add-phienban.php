<?php
use aabc\helpers\Html;
use backend\models\Sanpham;
use common\cont\D;

if(!isset($random_pb)){
	$random_pb = (string)time().'pb';
}

if(!isset($phienban)){
	$phienban = [
		'title' => '',
		'option' => '',
	];
}

?>
<div class="col-md-12 l-pbsp row clearfix ">
    <div class="pull-left" style="width: calc(100% - 110px); ">    	
        <input maxlength="50" type="text" name="Pb[<?= $random_pb?>][title]" placeholder="Nhập tên thông số. VD: Màu sắc, Kích thước ..." value="<?= $phienban['title']?>" class="form-control" style="font-size: 14px;" />
    </div>
    <div class="pull-left text-right"  style="width: 110px">        
        <span class="btn btn-default del-pbsp"><span class="glyphicon glyphicon-trash"></span> Xóa thông số</span>
    </div>

    <div style="width: calc(100% - 100px); float: right;" > 
        <div class="fill">
        <?php 
            if(is_array($phienban['option'])) foreach ($phienban['option'] as $key => $option) {
                echo Aabc::$app->controller->renderPartial('add-phienban-option',[
                    'option' => $option,
                    'random_pb' => $random_pb,
                    'random' => $key,
                ]); 
            }
        ?>
        </div>
        <span class="btn btn-default add-pbsp-option" <?= Aabc::$app->d->u .'='. Sanpham::addphienban.'?option=sp&pb='.$random_pb ?>  <?= Aabc::$app->d->i.'='.Sanpham::tt ?> ><span class="glyphicon text-success glyphicon-plus"></span> Thêm option</span>
    </div>
    
                        
</div>
