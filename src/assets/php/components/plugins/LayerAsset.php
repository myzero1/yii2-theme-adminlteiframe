<?php

namespace myzero1\theme\adminlteiframe\assets\php\components\plugins;

use yii\web\AssetBundle;

/**
 * Main asset for the `adminlte` theming
 */

class LayerAsset extends AssetBundle
{
    public $sourcePath = '@myzero1/theme/adminlteiframe/assets/static/plugins/layer';
    public $css = [
        'theme/default/layer.css',
    ];

    public $js = [
        'layer.js',
        'layer-use.js',
    ];
}
