<?php

namespace app\themes\adminlteiframe\assets\php\components\plugins;

use yii\web\AssetBundle;

/**
 * Main asset for the `adminlte` theming
 */

class SwitchAsset extends AssetBundle
{
    public $sourcePath = '@app/themes/adminlteiframe/assets/static/plugins/bootstrap-switch';
    //public $baseUrl = '@web';
    public $css = [
        'bootstrap-switch.css',
    ];

    public $js = [
        'bootstrap-switch.js',
    ];
}
