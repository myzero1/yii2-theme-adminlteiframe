<?php

namespace myzero1app\themes\adminlteiframe\assets\php\components\plugins;

use yii\web\AssetBundle;

/**
 * Main asset for the `adminlte` theming
 */

class JqueryAsset extends AssetBundle
{
    public $sourcePath = '@myzero1app/themes/adminlteiframe/assets/static/plugins/jQuery';
    //public $baseUrl = '@web';
    public $css = [
        // 'css/bootstrap.min.css',
    ];

    public $js = [
        'jquery-2.2.3.min.js',
    ];
}
