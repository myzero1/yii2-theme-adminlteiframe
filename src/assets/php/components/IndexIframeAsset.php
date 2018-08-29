<?php

namespace myzero1\adminlteiframe\assets\php\components;

use yii\web\AssetBundle;

/**
 * Main asset for the `adminlte` theming
 */

class IndexIframeAsset extends AssetBundle
{
    public $sourcePath = '@vendor/myzero1/yii2-theme-adminlteiframe/src/assets/static/adminlteiframe';
    //public $baseUrl = '@web';
    public $css = [
        'css/font-awesome.min.css',
        'css/ionicons.min.css',
        'css/AdminLTE.2.3.8.min.css',
        'css/skins/all-skins.min.css',
    ];

    public $js = [
        'js/app.js',
        'js/app_iframe.js',
        'js/index-iframe.js', // must after app_iframe
    ];

    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'myzero1\adminlteiframe\assets\php\components\plugins\LayerAsset',
    ];

    public $skin = 'skin-blue';
}
