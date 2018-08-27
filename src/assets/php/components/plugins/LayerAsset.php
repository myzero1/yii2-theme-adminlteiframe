<?php

namespace app\themes\adminlteiframe\assets\php\components\plugins;

use yii\web\AssetBundle;

/**
 * Main asset for the `adminlte` theming
 */

class LayerAsset extends AssetBundle
{
    public $sourcePath = '@app/themes/adminlteiframe/assets/static/plugins/layer';
    public $css = [
        'theme/default/layer.css',
    ];

    public $js = [
        'layer.js',
        'layer-use.js',
    ];
}
