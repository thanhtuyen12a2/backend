<?php
use aabc\helpers\Html;
use aabc\helpers\ArrayHelper;
use common\components\Tuyen;
use backend\models\Sanpham;

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
        <tr data-sp="<?= $sanpham->thongtinSanpham->sp_id?>" >
            <td><?= ($k + 1)?></td>
            <td><img src="<?= $anh?>" /> <?= $sanpham->thongtinSanpham->sp_tensp?></td>
            <td><span class="spdm-remove" title="Loại khỏi danh sách">✖</span></td>
        </tr>
    <?php } ?>
    </table>

    <script type="text/javascript">
        $('span.spdm-remove').click(function(){
            if(confirm('Bạn muốn loại bỏ sản phẩm này khỏi danh sách?')){
                parent = $(this).parents('tr');
                loadimg();
                $.ajax({
                    cache: false,
                    url: '<?= ADMIN.Sanpham::tt.'/'.Sanpham::removespdmnb; ?>',
                    type: 'POST',
                    data:{
                        sp : parent.attr('data-sp'),
                        dm : <?= $iddanhmuc?>,
                    },
                    success: function (data) {   
                        $('#spdm_nb').html(data);
                        unloadimg();
                    },
                    error: function () {
                        poploi();                    
                    }
                });
            }
        })
    </script>
</div>