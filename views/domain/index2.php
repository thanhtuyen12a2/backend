<?php

use aabc\helpers\Html;   
use aabc\grid\GridView;

//use aabc\bootstrap\Modal; /*Them*/
use aabc\helpers\Url; /*Them*/
use aabc\helpers\ArrayHelper; /*Them*/
use aabc\widgets\ActiveForm;
/*use app\models\Dskh; */


/* @var $this aabc\web\View */
// use backend\models\DomainSearch ;
 use backend\models\Domain ;
/* @var $dataProvider aabc\data\ActiveDataProvider */

$this->title = 'Domains';
$this->params['breadcrumbs'][] = $this->title;
?>

<div id="pjdomain" <?=Aabc::$app->d->i?>="domain" class="pj">

<div class="domain-index">

     <div class="content-left  col-md-2">
         <div class="dnn">
            <fieldset>               
               <p>                     
                <?php  
                    echo '<span>'.Aabc::$app->domain->__dm_domain.'</span>';
                    echo Html::input('text', 'dm_domain', Aabc::$app->request->get('dm_domain') != NULL ? urldecode(Aabc::$app->request->get('dm_domain')) : '' , ['class' => 'form-control inpsea', 'placeholder' => 'Tìm theo '.Aabc::$app->domain->__dm_domain]);

                ?>
                    <i class="glyphicon glyphicon-search"></i>
                </p>


                <div class="menucontent">
                    
                     <p> 
                        <?php 
                            echo '<span>'.Aabc::$app->domain->__dm_status.'</span>';
                            echo Html::dropDownList(Aabc::$app->domain->dm_status, Aabc::$app->request->get(Aabc::$app->domain->dm_status) != NULL ? Aabc::$app->request->get(Aabc::$app->domain->dm_status) : ['' => Aabc::$app->MyConst->vindex_search_chon], ['' => '--Chọn--', 1 => 'Lỗi 0', 2 => 'Lỗi < 10,000',  8 => 'Bỏ qua', 3 => 'Chưa kiểm tra',6 => 'Xấu',  4 => 'Bình thường', 5 => 'Đẹp',  7 => 'OK'], [                
                                'multiple'=>'multiple',
                                Aabc::$app->d->i => 'domain',
                                Aabc::$app->d->ty => 'checkbox',
                                // Aabc::$app->d->c => 'one',
                                Aabc::$app->d->s => 'rel',
                                'class' => 'mulr',
                                'id' => 'domain_status_select'

                            ]);

                        ?>
                     </p>


                     <p> 
                        <?php 
                            echo '<span>'.Aabc::$app->domain->__dm_tiemnang.'</span>';
                            echo Html::dropDownList(Aabc::$app->domain->dm_tiemnang, Aabc::$app->request->get(Aabc::$app->domain->dm_tiemnang) != NULL ? Aabc::$app->request->get(Aabc::$app->domain->dm_tiemnang) : ['' => Aabc::$app->MyConst->vindex_search_chon], ['' => '--Chọn--', 2 => 'Responsive', 1 => 'None'], [                
                                // 'multiple'=>'multiple',
                                Aabc::$app->d->i => 'domain',
                                Aabc::$app->d->ty => 'ra',
                                Aabc::$app->d->c => 'one',
                                Aabc::$app->d->s => 'rel',
                                'class' => 'mulr',
                                'id' => 'domain_tiemnang_select'
                            ]);

                        ?>
                     </p>

                </div>

            </fieldset>  

  
            <div class="bhelp">
                <button class="btn btn-default bhelp" d-st="1" d-gr="1">Hướng dẫn sử dụng</button>
            </div>
        </div>
    </div>



  <div class="content-right  col-md-10">

    <div class="content-right-top">       
        <?php         
        $demthungrac = count(Domain::getAllRecycle1());

            echo '<button type="button"  '.($demthungrac > 0 ? : 'disabled').'  id="mbdomainr" '.Aabc::$app->d->u.'="indexrecycle" class="btn btn-danger mb" '.Aabc::$app->d->i.'="domain"><span class="glyphicon glyphicon-trash mden"></span>'.Aabc::$app->MyConst->view_btn_thungrac.' ('.$demthungrac.')</button>';
        
        ?>

         <button type="button"  <?=Aabc::$app->d->m?>="2" id="mbdomain" <?= Aabc::$app->d->u?>="create" class="btn btn-success mb" <?= Aabc::$app->d->i?>="domain"><span class="glyphicon glyphicon-plus mtrang"></span><?= Aabc::$app->MyConst->view_btn_them?></button>
    </div>

  






    <?= GridView::widget([ 
        'id' => 'grdomain',
        'options' => ['class' => 'gr'],
        'emptyText' => Aabc::$app->MyConst->gridview_khongthayketqua,
        'summary' => "<div class='sy'>({begin} - {end} trong tổng số {totalCount})</div>",
        'dataProvider' => $dataProvider,
        // 'rowOptions' => function($model){            
        //     $class = '';
        //     if ($model[Aabc::$app->domain->dm_status] == '2'){
        //         $class = 'an';
        //     }
        //     return ['class'=>$class];
        // },
        //'filterModel' => $searchModel,
        'columns' => [


         [
            'class' => 'aabc\grid\CheckboxColumn',             
                'checkboxOptions' => function($model) {                  
                   return ['value' => $model[Aabc::$app->domain->dm_id]];                    
                },
                'headerOptions' => ['width' => '32'],
                'cssClass' => 'ca',
                'name' => 'tuyen', 
          ],

     


             // Aabc::$app->domain->dm_id,
            
              [                
                'attribute' => Aabc::$app->domain->dm_domain, 
                // 'visible' => Aabc::$app->user->can('web'),
                // 'contentOptions' => ['class' => 'text-center'],
                // 'headerOptions' => ['width' => '150'],              
                'format' => 'raw',
                'filterInputOptions' => [
                    'class'       => 'form-control',                    
                 ],
                'value' => function ($model) {                          
                    if($model[Aabc::$app->domain->dm_domain] == ''){
                        return '';
                    }else{
                        // return '*****'.substr($model[Aabc::$app->domain->dm_domain], 5, 100);
                        return $model[Aabc::$app->domain->dm_domain];
                    }

                }, 

            ],

              // Aabc::$app->domain->dm_chude,
            
             [                
                'attribute' => Aabc::$app->domain->dm_chude, 
                // 'visible' => Aabc::$app->user->can('web'),
                // 'contentOptions' => ['class' => 'text-center'],
                // 'headerOptions' => ['width' => '150'],              
                'format' => 'raw',
                'filterInputOptions' => [
                    'class'       => 'form-control',                    
                 ],
                'value' => function ($model) {                          
                    if($model[Aabc::$app->domain->dm_chude] == ''){
                        return '';
                    }else{
                        return $model[Aabc::$app->domain->dm_chude];
                    }

                }, 

            ],


             [                
                'attribute' => Aabc::$app->domain->dm_email, 
                // 'visible' => Aabc::$app->user->can('web'),
                // 'contentOptions' => ['class' => 'text-center'],
                // 'headerOptions' => ['width' => '150'],              
                'format' => 'raw',
                'filterInputOptions' => [
                    'class'       => 'form-control',                    
                 ],
                'value' => function ($model) {                          
                    if($model[Aabc::$app->domain->dm_email] == ''){
                        return '';
                    }else{
                        return $model[Aabc::$app->domain->dm_email];
                    }

                }, 

            ],


             [                
                'attribute' => Aabc::$app->domain->dm_source, 
                // 'visible' => Aabc::$app->user->can('web'),
                // 'contentOptions' => ['class' => 'text-center'],
                // 'headerOptions' => ['width' => '150'],              
                'format' => 'raw',
                'filterInputOptions' => [
                    'class'       => 'form-control',                    
                 ],
                'value' => function ($model) {                          
                    if($model[Aabc::$app->domain->dm_source] == ''){
                        return '';
                    }else{
                        return $model[Aabc::$app->domain->dm_source];
                    }

                }, 

            ],

             Aabc::$app->domain->dm_length,
             // Aabc::$app->domain->dm_tiemnang,  
             // Aabc::$app->domain->dm_status,
             


            //   [                
            //     'attribute' => Aabc::$app->domain->dm_tiemnang, 
            //     // 'visible' => Aabc::$app->user->can('web'),
            //     // 'contentOptions' => ['class' => 'text-center'],
            //     'headerOptions' => ['width' => '150'],              
            //     'format' => 'raw',
            //     'filterInputOptions' => [
            //         'class'       => 'form-control',                    
            //      ],
            //     'value' => function ($model) {                          
            //         if($model[Aabc::$app->domain->dm_tiemnang] == 2){
            //             return '<div class="bg-success text-center">Responsive</div>';
            //         }else{
            //             return '';
            //         }

            //     }, 

            // ],


             [                
                'attribute' => Aabc::$app->domain->dm_status, 
                // 'visible' => Aabc::$app->user->can('web'),
                // 'contentOptions' => ['class' => 'text-center'],
                'headerOptions' => ['width' => '150'],              
                'format' => 'raw',
                'filterInputOptions' => [
                    'class'       => 'form-control',                    
                 ],
                'value' => function ($model) {                          
                    if($model[Aabc::$app->domain->dm_status] == 1){
                        return '<div class="bg-danger text-center">'.Aabc::$app->domain->dm_status_1.'</div>';
                    }elseif($model[Aabc::$app->domain->dm_status] == 2){
                        return '<div class="bg-danger text-center">'.Aabc::$app->domain->dm_status_2.'</div>';
                    }elseif($model[Aabc::$app->domain->dm_status] == 8){
                        return '<div class="bg-danger text-center">'.Aabc::$app->domain->dm_status_8.'</div>';
                    }elseif($model[Aabc::$app->domain->dm_status] == 3){
                        return '<div class=" text-center">'.Aabc::$app->domain->dm_status_3.'</div>';
                    }elseif($model[Aabc::$app->domain->dm_status] == 4){
                        return '<div class="bg-info text-center">'.Aabc::$app->domain->dm_status_4.'</div>';
                    }elseif($model[Aabc::$app->domain->dm_status] == 5){
                        return '<div class="bg-success text-center">'.Aabc::$app->domain->dm_status_5.'</div>';
                    }elseif($model[Aabc::$app->domain->dm_status] == 6){
                        return '<div class="text-center">'.Aabc::$app->domain->dm_status_6.'</div>';
                    }else{
                        return '<div class="bg-success text-center">'.Aabc::$app->domain->dm_status_7.'</div>';
                    }

                }, 

            ],


             [                
                'attribute' => Aabc::$app->domain->dm_timedownload, 
                // 'visible' => Aabc::$app->user->can('web'),
                // 'contentOptions' => ['class' => 'text-center'],
                // 'headerOptions' => ['width' => '150'],              
                'format' => 'raw',
                'filterInputOptions' => [
                    'class'       => 'form-control',                    
                 ],
                'value' => function ($model) {                          
                    if($model[Aabc::$app->domain->dm_timedownload] == ''){
                        return '';
                    }else{
                        return $model[Aabc::$app->domain->dm_timedownload];
                    }

                }, 

            ],


            //  Aabc::$app->domain->dm_recycle,
            //  Aabc::$app->domain->dm_chude,
                     

             [                
                //'header' => '<a href="'.Aabc::$app->homeUrl.'sanpham">Reset</a>',
                'attribute' => Aabc::$app->domain->dm_id,
                //'headerOptions' => ['width' => '100'],                 
                'contentOptions' => [
                    'class' => 'omb',                    
                ],
                'format' => 'raw',
                'value' => function ($model) {                         
                    return '<div>'.$model[Aabc::$app->domain->dm_id].'</div><div class="omc" id="domain'.$model[Aabc::$app->domain->dm_id].'"><div class="omd">

                    <button type="button"   '.Aabc::$app->d->m.' ="2"  class="opennew btn btn-default"  '.Aabc::$app->d->i.'="domain" '.Aabc::$app->d->u.'="update?id='.$model[Aabc::$app->domain->dm_id].'" d-url="'.$model[Aabc::$app->domain->dm_domain].'">Xem<span class="glyphicon glyphicon-eye-open"></span></button>
                   
                    <button type="button"  '.Aabc::$app->d->m.' ="2"  class="opennew mb btn btn-default"  '.Aabc::$app->d->i.'="domain" '.Aabc::$app->d->u.'="update?id='.$model[Aabc::$app->domain->dm_id].'" d-url="'.$model[Aabc::$app->domain->dm_domain].'">Xem và Sửa<span class="glyphicon glyphicon-modal-window"></span></button>
                       
                    <button type="button"   '.Aabc::$app->d->m.' ="2"  class="mb btn btn-default"  '.Aabc::$app->d->i.'="domain" '.Aabc::$app->d->u.'="update?id='.$model[Aabc::$app->domain->dm_id].'" d-url="'.$model[Aabc::$app->domain->dm_domain].'"> Sửa<span class="glyphicon glyphicon-pencil"></span></button>
                   
                    <div class="gn"></div>

                    <button '.Aabc::$app->d->i.'="domain" class="ml btn btn-default" '.Aabc::$app->d->u.'="updatestatus?id='.$model[Aabc::$app->domain->dm_id].'&s=1">'.Aabc::$app->domain->dm_status_1.'<span class="glyphicon glyphicon-minus"></span></button>

                    <button '.Aabc::$app->d->i.'="domain" class="ml btn btn-default" '.Aabc::$app->d->u.'="updatestatus?id='.$model[Aabc::$app->domain->dm_id].'&s=8">'.Aabc::$app->domain->dm_status_8.'<span class="glyphicon glyphicon-minus"></span></button>

                    <button '.Aabc::$app->d->i.'="domain" class="ml btn btn-default" '.Aabc::$app->d->u.'="updatestatus?id='.$model[Aabc::$app->domain->dm_id].'&s=3">'.Aabc::$app->domain->dm_status_3.'<span class="glyphicon glyphicon-minus"></span></button>

                    <button '.Aabc::$app->d->i.'="domain" class="ml btn btn-default" '.Aabc::$app->d->u.'="updatestatus?id='.$model[Aabc::$app->domain->dm_id].'&s=6">'.Aabc::$app->domain->dm_status_6.'<span class="glyphicon glyphicon-minus"></span></button>

                    <button '.Aabc::$app->d->i.'="domain" class="ml btn btn-default" '.Aabc::$app->d->u.'="updatestatus?id='.$model[Aabc::$app->domain->dm_id].'&s=4">'.Aabc::$app->domain->dm_status_4.'<span class="glyphicon glyphicon-minus"></span></button>

                    <button '.Aabc::$app->d->i.'="domain" class="ml btn btn-default" '.Aabc::$app->d->u.'="updatestatus?id='.$model[Aabc::$app->domain->dm_id].'&s=5">'.Aabc::$app->domain->dm_status_5.'<span class="glyphicon glyphicon-minus"></span></button>

                    

                    <button '.Aabc::$app->d->i.'="domain" class="ml btn btn-default" '.Aabc::$app->d->u.'="updatestatus?id='.$model[Aabc::$app->domain->dm_id].'&s=7">'.Aabc::$app->domain->dm_status_7.'<span class="glyphicon glyphicon-minus"></span></button>

                    


                    <div class="gn"></div>
                   
                    <button type="button" class="br btn btn-default" '.Aabc::$app->d->i.'="domain" '.Aabc::$app->d->u.'="recycle?id='.$model[Aabc::$app->domain->dm_id].'">'.Aabc::$app->MyConst->gridview_menu_thungrac.'<span class="glyphicon glyphicon-trash"></span></button>

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
Html::dropDownList('t', Aabc::$app->request->get('t') != NULL ? Aabc::$app->request->get('t') : [10 => "10 hiển thị"], [10 => "10 hiển thị", 20 => "20 hiển thị", 50 => "50 hiển thị", 100 => "100 hiển thị", 200 => "200 hiển thị", 500 => "500 hiển thị"], [    
    'class' => 'ipage btn btn-default',
    'id' => ''
])?></div>

<div class="sy0"></div>

 <div class='cas'>

     <select id="seldomain" class="btn btn-default">
        <option value="" selected=""><?=Aabc::$app->MyConst->gridview_selectmultiitem_chonthaotac?></option>
        <option value="1"><?= Aabc::$app->domain->dm_status_1?></option>
        <option value="2"><?= Aabc::$app->domain->dm_status_2?></option>
        <option value="8"><?= Aabc::$app->domain->dm_status_8?></option>
        <option value="3"><?= Aabc::$app->domain->dm_status_3?></option>
        <option value="4"><?= Aabc::$app->domain->dm_status_4?></option>
        <option value="5"><?= Aabc::$app->domain->dm_status_5?></option>
        <option value="6"><?= Aabc::$app->domain->dm_status_6?></option>
        <option value="7"><?= Aabc::$app->domain->dm_status_7?></option>        
        <option value="9"><?=Aabc::$app->MyConst->gridview_selectmultiitem_thungrac?></option>      
        <option value="10">Mở website</option>
    </select>

    <?= Html::button(Aabc::$app->MyConst->gridview_selectmultiitem_thuchien, [Aabc::$app->d->i=>'domain',Aabc::$app->d->u =>'recycleall','class' => 'btn btn-default bra', 'method' => 'POST']) ?>
</div>

</div>
</div>

   

</div>
