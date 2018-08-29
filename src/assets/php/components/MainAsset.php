<?php

namespace myzero1\adminlteiframe\assets\php\components;

use yii\web\AssetBundle;

/**
 * Main asset for the `adminlte` theming
 */

class MainAsset extends AssetBundle
{
    public $sourcePath = '@vendor/myzero1/yii2-theme-adminlteiframe/src/assets/static/adminlteiframe';
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
        'js/plugins/daterangepicker.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'myzero1\adminlteiframe\assets\php\components\plugins\LayerAsset',
        'myzero1\adminlteiframe\assets\php\components\plugins\SwitchAsset',
        'myzero1\adminlteiframe\assets\php\components\plugins\BootstrapTableAsset',
        'myzero1\adminlteiframe\assets\php\components\plugins\DataRangePickerAsset',
    ];

    public $skin = ''; // blue,orange
    public $showTopNav = false; // ture,false
}
