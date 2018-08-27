<?php

namespace app\themes\adminlteiframe\assets\php\components\plugins;

use yii\web\AssetBundle;

/**
 * Main asset for the `adminlte` theming
 */

class LayUiAsset extends AssetBundle
{
    public $sourcePath = '@app/themes/adminlteiframe/assets/static/plugins/layui';
    public $css = [
        'css/layui.css',
    ];

    public $js = [
        'layui.js',
        'use-layui.js',
    ];
}
