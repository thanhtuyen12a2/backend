<?php

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'language' => 'vi',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
            'rbac' => [                
                'class' => 'backend\modules\rbac\Rbac',                
            ],
            'settings' => [                
                'class' => 'backend\modules\settings\Module', 
                'sourceLanguage' => 'en'               
            ],

        ],

    'components' => [
        'cacheFrontend' => [
            'class' => 'aabc\caching\FileCache',
            'cachePath' => Aabc::getAlias('@frontend') . '/runtime/cache'
        ],
        'cache' =>[
            'class' => 'aabc\caching\FileCache',
            'cachePath' => Aabc::getAlias('@frontend') . '/runtime/cache'
         ],

         'settings' => [
            'class' => 'common\components\Settings'
        ],

        'assetManager' => [
            'bundles' => [
                'aabc\web\JqueryAsset' => [
                    'js'=>[ 'jquery.js']
                ],
                'aabc\bootstrap\BootstrapPluginAsset' => [
                    'js'=>[ 'js/bootstrap.js']
                ],
                'aabc\bootstrap\BootstrapAsset' => [
                    'css' => ['css/bootstrap.css']
                ]
            ]
        ],


        'request' => [            
            'csrfParam' => '_tk_bd',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_it_bd', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'li-bd',
        ],
        'log' => [
            'traceLevel' => AABC_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'aabc\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],

        'authManager' => [
            'class' => 'aabc\rbac\DbManager',  //Thêm
            'defaultRoles' => ['guest'],
        ],

        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'MyComponent' => [
            'class' => 'common\components\MyComponent',
        ],        
        'MyConst' => [
            'class' => 'common\components\MyConst',
        ],

        'd' => [
            'class' => 'common\components\d',
        ],

        //Compoment  
        '_sanpham' => [
           'class' => 'common\components\_sanpham',
        ],

        '_nhacungcap' => [
           'class' => 'common\components\_nhacungcap',
        ],

        '_thuonghieu' => [
           'class' => 'common\components\_thuonghieu',
        ],

        '_user' => [
           'class' => 'common\components\_user',
        ],

        '_model' => [
           'class' => 'common\components\_model',
        ],

        '_image' => [
            'class' => 'common\components\_image',
        ],

        '_up' => [
            'class' => 'common\components\_up',
        ],

        '_ngonngu' => [
            'class' => 'common\components\_ngonngu',
        ],
        '_sanphamngonngu' => [
            'class' => 'common\components\_sanphamngonngu',
        ],

        '_danhmuc' => [
            'class' => 'common\components\_danhmuc',
        ],
        '_sanphamdanhmuc' => [
            'class' => 'common\components\_sanphamdanhmuc',
        ],


        '_chinhsach' => [
            'class' => 'common\components\_chinhsach',
        ],


        '_sanphamchinhsach' => [
            'class' => 'common\components\_sanphamchinhsach',
        ],

        '_danhmucchinhsach' => [
            'class' => 'common\components\_danhmucchinhsach',
        ],


        '_cauhinhcaidat' => [
            'class' => 'common\components\_cauhinhcaidat',
        ],




        '_sanpham3' => [
            'class' => 'common\components\_sanpham3',
        ],

        'nhomsanpham' => [
            'class' => 'common\components\nhomsanpham',
        ],

        '_nhomsanpham6' => [
            'class' => 'common\components\_nhomsanpham6',
        ],

        '_nhomsanpham7' => [
           'class' => 'common\components\_nhomsanpham7',
        ],


        'thuonghieu' => [
            'class' => 'common\components\thuonghieu',
        ],
        'thuonghieu7' => [
            'class' => 'common\components\thuonghieu7',
        ],
        'khohang' => [
            'class' => 'common\components\khohang',
        ],        
        'nhacungcap' => [
            'class' => 'common\components\nhacungcap',
        ],





        'domain' => [
            'class' => 'common\components\domain',
        ],
        
        'urlManager' => [           
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'pattern' => '<k>/<f>',
                    'route' => 'site/i',
                    'defaults' => ['k' => '', 'f' => ''],
                ],

                // [
                //     'pattern' => 'settings/default',
                //     'route' => 'settings/default',                    
                // ],
            ],
        ],
        
    ],
    'params' => $params,
];
