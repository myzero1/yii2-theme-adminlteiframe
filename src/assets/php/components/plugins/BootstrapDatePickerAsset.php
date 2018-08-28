<?php

namespace myzero1\adminlteiframe\assets\php\components\plugins;

use yii\web\AssetBundle;

/**
 * Main asset for the `adminlte` theming
 */

class BootstrapDatePickerAsset extends AssetBundle
{
    public $sourcePath = '@vendor/myzero1/yii2-theme-adminlteiframe/src/assets/static/plugins/datepicker';
    //public $baseUrl = '@web';
    public $css = [
        'datepicker3.css',
    ];

    public $js = [
        'bootstrap-datepicker.js',
        'locales/bootstrap-datepicker.zh-CN.js',
    ];
}
