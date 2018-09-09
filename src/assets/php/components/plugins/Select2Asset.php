<?php

namespace myzero1\adminlteiframe\assets\php\components\plugins;

use yii\web\AssetBundle;

/**
 * Main asset for the `adminlte` theming
 */

class Select2Asset extends AssetBundle
{
    public $sourcePath = '@vendor/myzero1/yii2-theme-adminlteiframe/src/assets/static/plugins';
    public $css = [
        'libs/select2/select2.min.css',
    ];

    public $js = [
        'libs/select2/select2.full.min.js',
        'use/select2.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
