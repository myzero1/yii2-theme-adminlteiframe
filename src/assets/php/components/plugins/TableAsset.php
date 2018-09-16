<?php

namespace myzero1\adminlteiframe\assets\php\components\plugins;

use yii\web\AssetBundle;

/**
 * Main asset for the `adminlte` theming
 */

class TableAsset extends AssetBundle
{
    public $sourcePath = '@vendor/myzero1/yii2-theme-adminlteiframe/src/assets/static/plugins';
    public $css = [
        'libs/bootstrap-table/bootstrap-table.min.css',
        'libs/bootstrap-table/bootstrap-table-fixed-columns.css',
    ];

    public $js = [
        'libs/bootstrap-table/bootstrap-table.min.js',
        'libs/bootstrap-table/bootstrap-table-zh-CN.min.js',
        'libs/bootstrap-table/bootstrap-table-fixed-columns.js',
        'use/table.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
