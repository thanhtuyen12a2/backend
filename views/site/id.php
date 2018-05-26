<?php
use aabc\helpers\Html;
// use aabc\grid\GridView;

// use aabc\bootstrap\Modal;
use aabc\helpers\Url;
// use aabc\helpers\ArrayHelper; 
// use aabc\widgets\ActiveForm;
/*use app\models\Dskh; */

// use aabc\widgets\Pjax;
// use backend\models\ThuonghieuSearch ;
// use backend\models\Thuonghieu ;
/* @var $this aabc\web\View */

$this->title = 'My Aabc Application';
?>



<?php 
$this->registerJs(  
"    
    $.ajax({
        cache: false,
        url: window.location.href,
        type: 'POST',                                     
        success: function (data) {                                      
            $('#main').html(data); 
            // unloadimg(); 
        },
        error: function () {
            // poploi();                    
        }
    }); 


    



")
?>


