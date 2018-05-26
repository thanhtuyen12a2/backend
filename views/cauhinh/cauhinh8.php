<?php
use common\cont\D;
use backend\models\Sanpham;
use backend\models\Cauhinh;
use aabc\helpers\Html;
use aabc\grid\GridView;
// use aabc\bootstrap\Modal; /*Them*/
use aabc\helpers\Url; /*Them*/
use aabc\helpers\ArrayHelper; /*Them*/
use aabc\widgets\ActiveForm;
?>

    <script type="text/javascript">
      $('[data-toggle="tooltip"]').tooltip();
  </script>

    <?php
        $_Cauhinh = Cauhinh::M;
        $model = new $_Cauhinh;

        if(empty($number)) $number = 0;
        // if(isset($_GET['page'])){
        //     $number = $_GET['page'];
        // }
        $module = Cauhinh::get(Cauhinh::module);
        $page = Cauhinh::get(Cauhinh::page);         
        $max_page =  empty($page['max'])? 1 : ($page['max'] + 1);
        $max_module =  empty($module['max'])? 1 : ($module['max'] + 1);
    ?>
  

<style type="text/css">
    [class*='col-md-'] {
        margin: 0;
        padding: 0;
    }
</style>

<div class="ch-index-child">
    <div class="stg">
        <fieldset>
            <legend><?= empty($page['child'][$number]['label'])?'':$page['child'][$number]['label'] ?></legend>   
            <?php 
                $html = empty($page['child'][$number]['content'])?'':$page['child'][$number]['content'];
                for ($j=1; $j < $max_module ; $j++) {
                    $idmodule = $j;
                    $lable = empty($module['child'][$idmodule]['label'])?'':$module['child'][$idmodule]['label'];
                    
                    $replace = '<div d-m="2" d-u="ip_mn?g='.$idmodule.'&l='. urlencode($lable).'" class="module-child pjbm"  d-i="danhmuc">Module: '. $lable .'</div>';                    
                    $html = str_replace('###'.$j.'###',$replace,$html);
                }

                $s_arr = [
                    1 => 'Slogan top',
                    2 => 'Ảnh Banner',
                ];

                for ($i=1; $i < 10 ; $i++) {
                    if(isset($s_arr[$i])){
                        $s = $s_arr[$i];
                        $replace_2 = '<div d-m="2" d-u="'.Cauhinh::cauhinh10.'?i='.$i.'" class="module-child pjbm"  d-i="'.Cauhinh::tt.'">Module: '.$s.'</div>';                    
                        $html = str_replace('@@@'.$i.'@@@',$replace_2,$html);
                    }
                }
                echo $html;
            ?> 
               

        </fieldset>
    </div>


</div>
  


  
  