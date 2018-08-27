<?php

namespace myzero1\theme\adminlteiframe\assets\php\components\plugins;

use yii\web\AssetBundle;

/**
 * Main asset for the `adminlte` theming
 */

class JqueryUiAsset extends AssetBundle
{
    public $sourcePath = '@myzero1/theme/adminlteiframe/assets/static/plugins/jQueryUI';
    //public $baseUrl = '@web';
    public $css = [
        // 'css/bootstrap.min.css',
    ];

    public $js = [
        // 'jquery-ui.min.js',
        'jquery.blockUI.js',
    ];
}
