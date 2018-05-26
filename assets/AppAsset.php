<?php

namespace backend\assets;

use aabc\web\AssetBundle;


class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/fontawesome-all.min.css',
        // 'css/styles2.php',
        // 'css/gbootstrap.css.php',
        // 'css/jquery.contextMenu.css',
    ];
    public $js = [
    	'js/main.js',
        'js/index.js',
        'js/event.js',
        'js/jquery.number.min.js',
        // 'js/sortimg.min.js',
        // 'js/aabc.js',
        // 'js/jquery.contextMenu.js',
    ];
    public $depends = [
        'aabc\web\AabcAsset',
        'aabc\bootstrap\BootstrapAsset',
    ];
}
