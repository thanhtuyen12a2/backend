<?php
use aabc\helpers\Html;   
use aabc\grid\GridView;

use aabc\helpers\Url; /*Them*/
use aabc\helpers\ArrayHelper; /*Them*/
use aabc\widgets\ActiveForm;

?>





    <?= GridView::widget([ 
        'id' => 'gr'.Aabc::$app->_model->__chinhsach,
        'options' => ['class' => 'gr'],
        'emptyText' => Aabc::$app->MyConst->gridview_khongthayketqua,
        'summary' => "<div class='sy'>(Từ {begin} - {end} trong {totalCount})</div>",
        'dataProvider' => $dataProvider,
        'rowOptions' => function($model){            
            $class = '';
            if ($model[Aabc::$app->_chinhsach->cs_status] == '2'){
                $class = 'an';
            }
            return ['class'=>$class];
        },
        //'filterModel' => $searchModel,
        'columns' => [


         [
            'class' => 'aabc\grid\CheckboxColumn',             
                'checkboxOptions' => function($model) {                  
                   return ['value' => $model[Aabc::$app->_chinhsach->cs_id]];                    
                },
                'headerOptions' => ['width' => '32'],
                'cssClass' => 'ca',
                'name' => 'tuyen', 
          ],

     


             // Aabc::$app->_chinhsach->cs_id,
             // Aabc::$app->_chinhsach->cs_type,
             [                
                'header' => 'Tên khuyến mại tặng kèm', 
                // 'visible' => Aabc::$app->user->can('web'),
                // 'contentOptions' => ['class' => 'text-center'],
                // 'headerOptions' => ['width' => '200'],              
                'format' => 'raw',
                'filterInputOptions' => [
                    'class'       => 'form-control',                    
                 ],
                'value' => function ($model) {                          
                    return Html::encode($model[Aabc::$app->_chinhsach->cs_ten]);
                }, 
            ],


            //  Aabc::$app->_chinhsach->cs_code,
             // Aabc::$app->_chinhsach->cs_ghichu,
            //  Aabc::$app->_chinhsach->cs_typetyle,
            //  Aabc::$app->_chinhsach->cs_tylechietkhau,
            //  Aabc::$app->_chinhsach->cs_apdungcho,
            //  Aabc::$app->_chinhsach->cs_dieukien,
            //  Aabc::$app->_chinhsach->cs_noidungdieukien,
             // Aabc::$app->_chinhsach->cs_status,
              [                
                'attribute' => Aabc::$app->_chinhsach->cs_apdungcho, 
                // 'visible' => Aabc::$app->user->can('web'),
                // 'contentOptions' => ['class' => 'text-center'],
                // 'headerOptions' => ['width' => '200'],              
                'format' => 'raw',
                'filterInputOptions' => [
                    'class'       => 'form-control',                    
                 ],
                'value' => function ($model) {                                         
                    if($model[Aabc::$app->_chinhsach->cs_apdungcho] == 1){
                        return '<div class=" bg-success text-center">Tất cả sản phẩm</div>';
                    }elseif($model[Aabc::$app->_chinhsach->cs_apdungcho] == 2){
                        return '<div class="text-center">Danh mục sản phẩm ('.$model->getDmcsIdDanhmucs()->count().')</div>';
                    }else{
                        return '<div class="text-center">Từng Sản phẩm ('.$model->getSpcsIdSps()->count().')</div>';
                    }
                }, 
            ],




             [                
                'attribute' => Aabc::$app->_chinhsach->cs_status, 
                // 'visible' => Aabc::$app->user->can('web'),
                // 'contentOptions' => ['class' => 'text-center'],
                // 'headerOptions' => ['width' => '200'],              
                'format' => 'raw',
                'filterInputOptions' => [
                    'class'       => 'form-control',                    
                 ],
                'value' => function ($model) {                          
                    if($model[Aabc::$app->_chinhsach->cs_status] == 1){
                        return '<div class=" bg-success text-center">Kích hoạt</div>';
                    }elseif($model[Aabc::$app->_chinhsach->cs_status] == 2){
                        return '<div class="text-center">Ngừng kích hoạt</div>';
                    }else{
                        return '';
                    }
                }, 
            ],



             [                
                'attribute' => Aabc::$app->_chinhsach->cs_ngaybatdau,  
                // 'visible' => Aabc::$app->user->can('web'),            
                'format' => 'raw',
                'filterInputOptions' => [
                    'class' => 'form-control',                    
                 ],
                'value' => function ($model) {  
                          
                    return '<div class="text-center">'.Aabc::$app->MyComponent->homnay($model[Aabc::$app->_chinhsach->cs_ngaybatdau]).'</div>';

                    // $songay = (strtotime(date("Y-m-d")) - strtotime($model[Aabc::$app->_chinhsach->cs_ngaybatdau])) /  86400;

                    // if($songay == -1){
                    //     return '<div class="text-center">Ngày mai</div>';
                    // }elseif ($songay == 0) {
                    //     return '<div class="text-center">Hôm nay</div>';
                    // }elseif ($songay == 1) {
                    //     return '<div class="text-center">Hôm qua</div>';
                    // }else{
                    //     return '<div class="text-center">' .date("Y-m-d", strtotime($model[Aabc::$app->_chinhsach->cs_ngayketthuc])). '</div>'; 
                    // }

                    // return '<div class="text-center">' .date("Y-m-d", strtotime($model[Aabc::$app->_chinhsach->cs_ngaybatdau])). '</div>';

                }, 

            ],


            [                
                'attribute' => Aabc::$app->_chinhsach->cs_ngayketthuc,  
                // 'visible' => Aabc::$app->user->can('web'),            
                'format' => 'raw',
                'filterInputOptions' => [
                    'class' => 'form-control',                    
                 ],
                'value' => function ($model) {  
                    if(isset($model[Aabc::$app->_chinhsach->cs_ngayketthuc])){               
                        return '<div class="text-center">'.Aabc::$app->MyComponent->homnay($model[Aabc::$app->_chinhsach->cs_ngayketthuc]).'</div>';
                    }else{
                        return '<div class="text-center">Vô thời hạn</div>';
                    }
                }, 

            ],

            //  Aabc::$app->_chinhsach->cs_recycle,
            //  Aabc::$app->_chinhsach->cs_ngaytao,
             // Aabc::$app->_chinhsach->cs_ngaybatdau,
             // Aabc::$app->_chinhsach->cs_ngayketthuc,
                     

             [                
                //'header' => '<a href="'.Aabc::$app->homeUrl.'sanpham">Reset</a>',
                'attribute' => Aabc::$app->_chinhsach->cs_id,
                //'headerOptions' => ['width' => '100'],                 
                'contentOptions' => [
                    'class' => 'omb',                    
                ],
                'format' => 'raw',
                'value' => function ($model) {                         
                    return '<div>'.$model[Aabc::$app->_chinhsach->cs_id].'</div><div class="omc" id="'.Aabc::$app->_model->__chinhsach.$model[Aabc::$app->_chinhsach->cs_id].'"><div class="omd">

                    <button type="button"  '.Aabc::$app->d->m.'="3"  class="mb btn btn-default" '.Aabc::$app->d->i.'='.Aabc::$app->_model->__chinhsach.'  '.Aabc::$app->d->u.'="u_km?id='.$model[Aabc::$app->_chinhsach->cs_id].'">'.Aabc::$app->MyConst->gridview_menu_suachitiet.'<span class="glyphicon glyphicon-pencil"></span></button>

                    <div class="gn"></div>
                    '.                        
                        (Aabc::$app->user->can('web') ?  ($model[Aabc::$app->_chinhsach->cs_status] == 2 ? '<button type="button" class="ml btn btn-default" '.Aabc::$app->d->i.'='.Aabc::$app->_model->__chinhsach.'   '.Aabc::$app->d->u.'="us_km?id='.$model[Aabc::$app->_chinhsach->cs_id].'">Kích hoạt<span class="glyphicon glyphicon-eye-open"></span></button>' : '<button type="button" class="ml btn btn-default" '.Aabc::$app->d->i.'='.Aabc::$app->_model->__chinhsach.'   '.Aabc::$app->d->u.'="us_km?id='.$model[Aabc::$app->_chinhsach->cs_id].'">Ngừng kích hoạt<span class="glyphicon glyphicon-eye-open"></span></button>') : "" )

                    .'
                    <button type="button" class="br btn btn-default" '.Aabc::$app->d->i.'='.Aabc::$app->_model->__chinhsach.'  '.Aabc::$app->d->u.'="rec_km?id='.$model[Aabc::$app->_chinhsach->cs_id].'">'.Aabc::$app->MyConst->gridview_menu_thungrac.'<span class="glyphicon glyphicon-trash"></span></button>

                    </div></div>';                                      
                }, 
            ],

        


        ],


         //« » ‹ ›
        'pager' => [
            'firstPageLabel' => '«',
            'prevPageLabel'  => '‹',
            'nextPageLabel' => '›',
            'lastPageLabel' => '»',

            'maxButtonCount'=>1, // Số page hiển thị ví dụ: (First  1 2 3 Last)
        ],

 ]); ?>


  

<div class="endgr">

<div class='per-page'>

<?= 
Html::dropDownList('t', Aabc::$app->request->get('t') != NULL ? Aabc::$app->request->get('t') : [10 => 10], [10 => 10, 20 => 20, 50 => 50, 100 => 100, 200 => 200], [    
    'class' => 'ipage btn btn-default',
    'id' => ''
])?></div>

<div class="sy0"></div>

 <div class='cas'>

     <select id="sel<?= Aabc::$app->_model->__chinhsach?>" class="btn btn-default">
        <option value="" selected=""><?=Aabc::$app->MyConst->gridview_selectmultiitem_chonthaotac?></option>
        <option value="1">Ngừng kích hoạt</option>
        <option value="2">Kích hoạt</option>
        <option value="3"><?=Aabc::$app->MyConst->gridview_selectmultiitem_thungrac?></option>      
    </select>

    <?= Html::button(Aabc::$app->MyConst->gridview_selectmultiitem_thuchien, [Aabc::$app->d->i => Aabc::$app->_model->__chinhsach, Aabc::$app->d->u =>'reca_km','class' => 'btn btn-default bra', 'method' => 'POST']) ?>
</div>

</div>