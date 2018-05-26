<?php

use aabc\helpers\Html;
use aabc\widgets\ActiveForm;
use backend\modules\settings\Module;
use \backend\modules\settings\models\Setting;
use aabc\helpers\ArrayHelper;
/**
 * @var aabc\web\View $this
 * @var backend\modules\settings\models\Setting $model
 * @var aabc\widgets\ActiveForm $form
 */
?>

<style type="text/css">    
    li {
        margin: 5px 0 0 0;
    }
    ul>input:hover{        
        opacity: 1;
    }
    ul>input{
        width: 400px;
        height: 34px;        
        opacity: 0.5;
        margin: 5px 0 0 0;
    }
    li>input.s_label, li>input.s_url{
        width: 200px;
        line-height: 28px;        
        padding: 2px 8px;
        font-size: 12px;
        color: #555;
        background-color: #fff;
        background-image: none;
        border: 1px solid #ccc;
        border-radius: 2px;
    }
    li>input:focus{
        /*width: 400px;*/
    }
    .removechild {
    	cursor: pointer;
    	opacity: 0
    }

    li:hover >.removechild{
    	opacity: 1;
    }

    li:hover .addchild {
    	display: block;
    }

    li:hover .add {
    	display: block;
    }

    .add,
    .addchild{
    	/*display: none;*/
    }


    ul {
	    list-style: none;
	}
</style>

<?php
use aabc\widgets\Menu;
$arr = [
        'items' => [       
            [
                'label' => 'Home',                
                'url' => [
                    'site/index'
                ],
                // 'options'=> ['class'=>'list-group-item'],                
            ], 

            ['label' => 'Products', 'url' => ['product/index'], 'items' => [
                ['label' => 'New Arrivals', 'url' => ['product/index', 'tag' => 'new']],
                ['label' => 'Most Popular', 'url' => ['product/index', 'tag' => 'popular']],
            ]],        
        ],
        'linkTemplate' => '<a href="{url}" class="mylink"><span>{label}</span></a>',
        // 'linkTemplate' => '<input name="Setting[value][0][label]" value="{label}" /> <input name="Setting[value][0][url]" value="{url}"/>',
    ];

// echo json_encode($arr);

// echo Menu::widget($arr);

// echo '<pre>';
// print_r(json_decode($model->value));

 function parseNodes($nodes,$vonglap = '') {
        $ul = "<ul>\n";        
        foreach ($nodes as $key => $node) {
                $ul .= parseNode($node,$vonglap,$key);
        }   
            $ul .= '
                <input type="button" class="add btn btn-default" value="Thêm"/>                
                ';            

        $ul .= "</ul>\n";
        return $ul;
    }

    function parseNode($node,$vonglap = '',$key = '') {
            $vonglap .= '['.$key.']';
            $li = "\t<li d-t='Setting[value]".$vonglap."'>";  
            if (isset($node->items) && is_array($node->items)) {
                $mini = '+';
            }else{
            	 $mini = '';
            }
            $li .=  $mini.'
                <input class="s_label " name="Setting[value]'.$vonglap.'[label]" value="'.(is_string($node->label)?$node->label:'').'"/>
                <input class="s_url" name="Setting[value]'.$vonglap.'[url]" value="'.(is_string($node->url)?$node->url:'').'"/>                                
                <span class="removechild glyphicon glyphicon-remove text-danger"></span>
                ';
            
            if (isset($node->items) && is_array($node->items)) {
                $li .= '';
                $vonglap .= '[items]';        
                $li .= parseNodes($node->items,$vonglap);
            }else{                
                $li .= '<ul><input type="button" class="addchild btn btn-default" value="Thêm"/></ul>';
            }
            $li .= "</li>\n";
            return $li;
    }


// $jsonstring = '{"items":[{"status":"1","label":"Trang ch\u1ee7","url":["#trang-chu"]},{"status":"","label":"Tin t\u1ee9c","url":["#tin-tuc"],"items":[{"status":"1","label":"Tin th\u1ec3 thao","url":["#tin-the-thao"],"items":[{"status":"1","label":"Tin b\u00f3ng \u0111\u00e1","url":["#tin-bong-da"]},{"status":"1","label":"Tin b\u00f3ng chuy\u1ec1n","url":["#tin-bong-chuyen"]}]},{"status":"1","label":"Tin th\u1eddi s\u1ef1","url":["#tin-thoi-su"]},{"status":"1","label":"Tin v\u0103n h\u00f3a","url":["#tin-van-hoa"]}]},{"status":"1","label":"Gi\u1edbi thi\u1ec7u","url":["#gioi-thieu"]},{"status":"1","label":"Li\u00ean h\u1ec7","url":["#lien-he"]}]}';

// $model->value = '';
if(empty($model->value)){
    $model->value = '{"items":[{"status":" ","label":" ","url":[" "]}]}';
}
$jsonstring = $model->value;
    //Gọi menu ra
    // echo Menu::widget(json_decode($jsonstring,true)); 

    $t = Aabc::$app->settings;
    // echo '<pre>';
    // print_r(($t->get('thongtin2')));
    // print_r(($t->get('tuyen')));
    // print_r(($t->get('thanhtuyen')));
    $menu = $t->get('menu');
    // echo Menu::widget(json_decode($menu,true)); 
    

?>

<?php
$this->registerJs(
    "   
    $(document).on('click', 'span.removechild', function() {        
    	if(confirm('Bạn muốn xóa?')){
	        var parent = $(this).parent().parent();         
	        if(parent.find('>li').length == 1){            
	            parent.find('>input').removeClass('add').addClass('addchild');
	        }        
	        $(this).parent().remove();
	    }
    });






    $(document).on('click', '.addchild', function() { 
        var s_clone = $(this).parent().parent()[0].outerHTML+'<input type=button class=\"add btn btn-default\" value=\"Thêm\"></ul>';   
        $(s_clone).insertBefore($(this));
        element_append = $(this).parent().find('>li').eq(0);
        var s_name = element_append.attr('d-t');
        s_name += '[items][0]';
        element_append.attr('d-t',s_name);
        element_append.find('.s_label').attr('name',s_name+'[label]').attr('value','#name');
        element_append.find('.s_url').attr('name',s_name+'[url]').attr('value','#link');
        element_append.find('.s_status').attr('name',s_name+'[status]');
        $(this).remove();

    });






    $(document).on('click', '.add', function() { 
        var index_append = $(this).parent().find('>li').length; //Dem so li, de tinh ra gia tri index cua li append moi.
        var s_clone = $(this).parent().find('>li').eq(0)[0].outerHTML;
        $(s_clone).insertBefore($(this));
        element_append = $(this).parent().find('>li').eq(index_append);
        element_append.find('ul').html('<input type=button class=\"addchild btn btn-default\" value=\"Thêm\">');  
        var s_name = $(this).parent().parent().attr('d-t');
        if(typeof(s_name) !== 'undefined'){
            s_name += '[items]['+index_append+']';
            // alert('1');
        }else{
             s_name = 'Setting[value]['+index_append+']';
             // alert('2');
         }       
        element_append.attr('d-t',s_name);
        element_append.find('.s_label').attr('name',s_name+'[label]').attr('value','#name');
        element_append.find('.s_url').attr('name',s_name+'[url]').attr('value','#link');
        element_append.find('.s_status').attr('name',s_name+'[status]');
    });


    "
);


?>

<script type="text/javascript">
    
</script>




<div class="setting-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>


    <?php
    //Gọi form edit
        $html = parseNodes(json_decode($jsonstring)->items);
        echo $html;

    ?>

    <div class="form-group">
        <?=
        Html::submitButton(
            $model->isNewRecord ? Module::t('settings', 'Create') :
                Module::t('settings', 'Update'),
            [
                'class' => $model->isNewRecord ?
                    'btn btn-success' : 'btn btn-primary'
            ]
        ) ?>
    </div>

    <?= $form->field($model, 'section')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'key')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'section')
        ->dropDownList(
            ArrayHelper::map(
                        Setting::find()->select('section')->distinct()->where(['<>', 'section', ''])->all(),
                        'section',
                        'section'
                    ),
            ['prompt'=>'']    // options
        );

        
    ?>

    <?= $form->field($model, 'active')->checkbox(['value' => 1]) ?>

    <?php
    // $form->field($model, 'type')->dropDownList(
        // $model->getTypes()
    // )->hint(Module::t('settings', 'Change at your own risk')) ?>

    

    <?php ActiveForm::end(); ?>

</div>
