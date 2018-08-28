<?php

namespace myzero1\adminlteiframe\assets\php\components\plugins;

use yii\web\AssetBundle;

/**
 * Main asset for the `adminlte` theming
 */

class DataTablesAsset extends AssetBundle
{
    public $sourcePath = '@vendor/myzero1/yii2-theme-adminlteiframe/src/assets/static/plugins/datatables';
    //public $baseUrl = '@web';
    public $css = [
        'dataTables.bootstrap.css',
        // 'jquery.dataTables.min.css',
    ];

    public $js = [
        'jquery.dataTables.min.js',
        'dataTables.bootstrap.js',
        // 'jquery.dataTables.min.js',
    ];
}
