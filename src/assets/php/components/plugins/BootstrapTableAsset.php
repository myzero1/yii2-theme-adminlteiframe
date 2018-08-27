<?php

namespace app\themes\adminlteiframe\assets\php\components\plugins;

use yii\web\AssetBundle;

/**
 * Main asset for the `adminlte` theming
 */

class BootstrapTableAsset extends AssetBundle
{
    public $sourcePath = '@app/themes/adminlteiframe/assets/static/plugins/bootstrap-table';
    //public $baseUrl = '@web';
    public $css = [
        'bootstrap-table.min.css',
        'bootstrap-table-fixed-columns.css',
    ];

    public $js = [
        'bootstrap-table.min.js',
        'bootstrap-table-zh-CN.min.js',
        'bootstrap-table-fixed-columns.js',
    ];
}
