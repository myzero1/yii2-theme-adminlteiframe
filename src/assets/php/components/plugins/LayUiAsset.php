<?php

namespace myzero1\theme\adminlteiframe\assets\php\components\plugins;

use yii\web\AssetBundle;

/**
 * Main asset for the `adminlte` theming
 */

class LayUiAsset extends AssetBundle
{
    public $sourcePath = '@myzero1/theme/adminlteiframe/assets/static/plugins/layui';
    public $css = [
        'css/layui.css',
    ];

    public $js = [
        'layui.js',
        'use-layui.js',
    ];
}
