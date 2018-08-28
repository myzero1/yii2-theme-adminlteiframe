<?php

namespace myzero1\adminlteiframe\assets\php\components\plugins;

use yii\web\AssetBundle;

/**
 * Main asset for the `adminlte` theming
 */

class JqueryUiAsset extends AssetBundle
{
    public $sourcePath = '@vendor/myzero1/yii2-theme-adminlteiframe/src/assets/static/plugins/jQueryUI';
    //public $baseUrl = '@web';
    public $css = [
        // 'css/bootstrap.min.css',
    ];

    public $js = [
        // 'jquery-ui.min.js',
        'jquery.blockUI.js',
    ];
}
