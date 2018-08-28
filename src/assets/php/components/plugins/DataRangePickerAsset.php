<?php

namespace myzero1\adminlteiframe\assets\php\components\plugins;

use yii\web\AssetBundle;

/**
 * Main asset for the `adminlte` theming
 */

class DataRangePickerAsset extends AssetBundle
{
    public $sourcePath = '@vendor/myzero1/yii2-theme-adminlteiframe/src/assets/static/plugins/daterangepicker';
    //public $baseUrl = '@web';
    public $css = [
        'daterangepicker.css',
        // 'jquery.dataTables.min.css',
    ];

    public $js = [
        'moment.min.js',
        'daterangepicker.js',
    ];
}
