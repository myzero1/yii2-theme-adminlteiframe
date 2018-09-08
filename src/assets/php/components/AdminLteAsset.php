<?php

namespace myzero1\adminlteiframe\assets\php\components;

use yii\web\AssetBundle;

/**
 * Html5shiv asset for the `adminlte` theming
 */

class AdminLteAsset extends AssetBundle
{
    public $sourcePath = '@vendor/myzero1/yii2-theme-adminlteiframe/src/assets/static/adminlteiframe';
    public $js = [
        'js/app.js',
    ];
    public $css = [
        'AdminLTE.2.3.8.min.css',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
