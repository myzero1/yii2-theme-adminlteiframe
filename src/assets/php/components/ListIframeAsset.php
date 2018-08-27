<?php

namespace myzero1\theme\adminlteiframe\assets\php\components;

use yii\web\AssetBundle;

/**
 * Main asset for the `adminlte` theming
 */

class ListIframeAsset extends AssetBundle
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
        'css/adminlteiframe-gridview.css',
    ];

    public $js = [
        'js/app.js',
        'js/app_iframe.js',
        'js/plugins/daterangepicker.js',
        'js/app/list-crud.js',
        'js/app/utils.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'myzero1\theme\adminlteiframe\assets\php\components\plugins\SwitchAsset',
        // 'myzero1\theme\adminlteiframe\assets\php\components\plugins\BootstrapDatePickerAsset',
        'myzero1\theme\adminlteiframe\assets\php\components\plugins\DataRangePickerAsset',
        // 'myzero1\theme\adminlteiframe\assets\php\components\plugins\DataTablesAsset',
        'myzero1\theme\adminlteiframe\assets\php\components\plugins\LayerAsset',
    ];

    public $skin = ''; // blue,orange
    public $showTopNav = false; // ture,false
}
