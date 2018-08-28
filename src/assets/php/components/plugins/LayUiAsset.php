<?php

namespace myzero1\adminlteiframe\assets\php\components\plugins;

use yii\web\AssetBundle;

/**
 * Main asset for the `adminlte` theming
 */

class LayUiAsset extends AssetBundle
{
    public $sourcePath = '@vendor/myzero1/yii2-theme-adminlteiframe/src/assets/static/plugins/layui';
    public $css = [
        'css/layui.css',
    ];

    public $js = [
        'layui.js',
        'use-layui.js',
    ];
}
