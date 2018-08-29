<?php

namespace myzero1\adminlteiframe\assets\php\components\plugins;

use yii\web\AssetBundle;

/**
 * Main asset for the `adminlte` theming
 */

class LayerAsset extends AssetBundle
{
    public $sourcePath = '@vendor/myzero1/yii2-theme-adminlteiframe/src/assets/static/plugins';
    public $css = [
        'libs/layer/theme/default/layer.css',
    ];

    public $js = [
        'libs/layer/layer.js',
        'use/layer.js',
    ];
}
