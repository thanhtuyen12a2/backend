<?php
use aabc\helpers\Html;
use aabc\helpers\ArrayHelper;
use common\components\Tuyen;

$_Sanphamdanhmuc = Aabc::$app->_model->Sanphamdanhmuc;

$model = $_Sanphamdanhmuc::find()                                        
                ->andWhere(['spdm_id_danhmuc' => $iddanhmuc])
                ->joinWith('thongtinSanpham')
                ->orderBy(['spdm_sothutu' => SORT_DESC])
                // ->asArray()
                ->all();
?>

<div class="spdm-nb">
    <table class="table table-condensed">
    <?php foreach ($model as $k => $sanpham) {
        $sp_images = explode('-',$sanpham->thongtinSanpham->sp_images);

        $anh = Tuyen::_dulieu('image', $sp_images['0'], '25x25');
    ?>
        <tr>
            <td><?= ($k + 1)?></td>
            <td><img src="<?= $anh?>" /> <?= $sanpham->thongtinSanpham->sp_tensp?></td>
            <td></td>
        </tr>
    <?php } ?>
    </table>
</div>