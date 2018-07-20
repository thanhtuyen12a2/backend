<?php
use aabc\helpers\Html;
use backend\models\Sanpham;
use common\cont\D;

if(isset($_GET['pb'])){
    $random_pb = $_GET['pb'];
}

if(!isset($random)){
	$random = (string)time().'op';
}

if(!isset($option)){
	$option = [
		'name' => '',
		'change' => '',
	];
}

?>

<div class="l-option clearfix">
        
        <input type="text" maxlength="30" name="Pb[<?= $random_pb?>][option][<?= $random?>][name]" placeholder="Tên option" value="<?= $option['name']?>" class="form-control pull-left" style="width: calc(60% - 20px); font-size: 14px;" />

        <input type="text" maxlength="15" name="Pb[<?= $random_pb?>][option][<?= $random?>][change]" placeholder="Giá chênh lệch" value="<?= $option['change']?>" class="form-control pull-left text-right" style="width: 40%; font-size: 14px;" />

        <span class="del-pbsp-option"><span class="glyphicon glyphicon-remove"></span></span>  
</div>
    
