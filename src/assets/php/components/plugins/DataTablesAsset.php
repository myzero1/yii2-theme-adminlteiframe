<?php

namespace app\themes\adminlteiframe\assets\php\components\plugins;

use yii\web\AssetBundle;

/**
 * Main asset for the `adminlte` theming
 */

class DataTablesAsset extends AssetBundle
{
    public $sourcePath = '@app/themes/adminlteiframe/assets/static/plugins/datatables';
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
