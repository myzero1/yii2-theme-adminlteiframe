<?php

namespace myzero1myzero1\adminlteiframe\assets\php\components\plugins;

use yii\web\AssetBundle;

/**
 * Main asset for the `adminlte` theming
 */

class JqueryAsset extends AssetBundle
{
    public $sourcePath = '@myzero1myzero1/adminlteiframe/assets/static/plugins/jQuery';
    //public $baseUrl = '@web';
    public $css = [
        // 'css/bootstrap.min.css',
    ];

    public $js = [
        'jquery-2.2.3.min.js',
    ];
}
