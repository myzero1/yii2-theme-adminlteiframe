<?php

namespace myzero1\theme\adminlteiframe\assets\php\components\plugins;

use yii\web\AssetBundle;

/**
 * Main asset for the `adminlte` theming
 */

class SwitchAsset extends AssetBundle
{
    public $sourcePath = '@myzero1/theme/adminlteiframe/assets/static/plugins/bootstrap-switch';
    //public $baseUrl = '@web';
    public $css = [
        'bootstrap-switch.css',
    ];

    public $js = [
        'bootstrap-switch.js',
    ];
}
