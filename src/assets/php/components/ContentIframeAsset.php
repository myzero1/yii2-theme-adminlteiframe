<?php

namespace myzero1\theme\adminlteiframe\assets\php\components;

use yii\web\AssetBundle;

/**
 * Main asset for the `adminlte` theming
 */

class ContentIframeAsset extends AssetBundle
{
    public $sourcePath = '@myzero1/theme/adminlteiframe/assets/static/adminlteiframe';
    //public $baseUrl = '@web';
    public $css = [
        'css/font-awesome.min.css',
        'css/ionicons.min.css',
        'css/AdminLTE.2.3.8.min.css',
        'css/skins/all-skins.min.css',
        'css/app/main.css',
        'css/app/custom.css',
    ];

    public $js = [
        'js/app.js',
        'js/app_iframe.js',
        'js/app/list-crud.js',
        'js/app/utils.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];

    public $skin = ''; // blue,orange
    public $showTopNav = false; // ture,false
}
