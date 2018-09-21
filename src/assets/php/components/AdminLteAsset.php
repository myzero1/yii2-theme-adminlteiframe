<?php

namespace myzero1\adminlteiframe\assets\php\components;

use yii\web\AssetBundle;

/**
 * Html5shiv asset for the `adminlte` theming
 */

class AdminLteAsset extends AssetBundle
{
    public $sourcePath = '@vendor/myzero1/yii2-theme-adminlteiframe/src/assets/static/adminlteiframe';
    public $css = [
        'css/font-awesome.min.css',
        'css/ionicons.min.css',
        'css/AdminLTE.2.3.8.min.css',
        'css/skins/all-skins.min.css',
    ];

    public $js = [
        // 'js/adminlte.js',
        'js/app.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'myzero1\adminlteiframe\assets\php\components\plugins\LayerAsset',
        'myzero1\adminlteiframe\assets\php\components\plugins\TableAsset',
        'myzero1\adminlteiframe\assets\php\components\plugins\DataRangePickerAsset',
    ];

    public $skin = 'skin-blue';
}
