<?php

namespace myzero1\theme\adminlteiframe\assets\php\components\plugins;

use yii\web\AssetBundle;

/**
 * Main asset for the `adminlte` theming
 */

class DataRangePickerAsset extends AssetBundle
{
    public $sourcePath = '@myzero1/theme/adminlteiframe/assets/static/plugins/daterangepicker';
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
