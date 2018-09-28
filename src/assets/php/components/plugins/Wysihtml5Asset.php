<?php

namespace myzero1\adminlteiframe\assets\php\components\plugins;

use yii\web\AssetBundle;

/**
 * Main asset for the `adminlte` theming
 */

class Wysihtml5Asset extends AssetBundle
{
    public $jsVersion = '1.735.1';
    public $cssVersion = '1.735.1';
    function init(){
        parent::init();
        \myzero1\adminlteiframe\assets\php\components\LayoutAsset::addVersion($this->js, $this->jsVersion, $this->css, $this->cssVersion);
    }
    public $sourcePath = '@vendor/myzero1/yii2-theme-adminlteiframe/src/assets/static/plugins';
    public $css = [
        'libs/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css',
    ];

    public $js = [
        'libs/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js',
        'libs/bootstrap-wysihtml5/locales/bootstrap-wysihtml5.en-US.js',
        'libs/bootstrap-wysihtml5/locales/bootstrap-wysihtml5.zh-CN.js',
        'use/wysihtml5.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
