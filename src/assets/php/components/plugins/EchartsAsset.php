<?php

namespace myzero1\adminlteiframe\assets\php\components\plugins;

use yii\web\AssetBundle;

/**
 * Main asset for the `adminlte` theming
 */

class EchartsAsset extends AssetBundle
{
    public $jsVersion = '1.735.1';
    public $cssVersion = '1.735.1';
    function init(){
        parent::init();
        \myzero1\adminlteiframe\assets\php\components\LayoutAsset::addVersion($this->js, $this->jsVersion, $this->css, $this->cssVersion);
    }
    public $sourcePath = '@vendor/myzero1/yii2-theme-adminlteiframe/src/assets/static/plugins';
    public $css = [
        // 'libs/layer/theme/default/layer.css',
    ];

    public $js = [
        'libs/echarts/echarts.min.js',
        'use/echarts.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
