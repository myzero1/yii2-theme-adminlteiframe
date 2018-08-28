<?php

namespace myzero1\adminlteiframe\assets\php\components\plugins;

use yii\web\AssetBundle;

/**
 * Main asset for the `adminlte` theming
 */

class LayerAsset extends AssetBundle
{
    public $sourcePath = '@vendor/myzero1/yii2-theme-adminlteiframe/src/assets/static/plugins/layer';
    public $css = [
        'theme/default/layer.css',
    ];

    public $js = [
        'layer.js',
        'layer-use.js',
    ];
}
