<?php

namespace myzero1\adminlteiframe\assets\php\components\plugins;

use yii\web\AssetBundle;

/**
 * Main asset for the `adminlte` theming
 */

class SwitchAsset extends AssetBundle
{
    public $sourcePath = '@vendor/myzero1/yii2-theme-adminlteiframe/src/assets/static/plugins';
    //public $baseUrl = '@web';
    public $css = [
        'libs/bootstrap-switch/bootstrap-switch.css',
    ];

    public $js = [
        'libs/bootstrap-switch/bootstrap-switch.js',
    ];
}
