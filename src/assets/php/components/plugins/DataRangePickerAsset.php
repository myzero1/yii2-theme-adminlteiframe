<?php

namespace app\themes\adminlteiframe\assets\php\components\plugins;

use yii\web\AssetBundle;

/**
 * Main asset for the `adminlte` theming
 */

class DataRangePickerAsset extends AssetBundle
{
    public $sourcePath = '@app/themes/adminlteiframe/assets/static/plugins/daterangepicker';
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
