<?php

namespace myzero1\adminlteiframe\assets\php\components\plugins;

use yii\web\AssetBundle;

/**
 * Main asset for the `adminlte` theming
 */

class ZtreeAsset extends AssetBundle
{
    public $jsVersion = '1.735.1';
    public $cssVersion = '1.735.1';
    function init(){
        parent::init();
        \myzero1\adminlteiframe\assets\php\components\LayoutAsset::addVersion($this->js, $this->jsVersion, $this->css, $this->cssVersion);
    }
    public $sourcePath = '@vendor/myzero1/yii2-theme-adminlteiframe/src/assets/static/plugins';
    public $css = [
        'libs/ztree3/css/zTreeStyle/zTreeStyle.css',
        // 'libs/ztree3/css/metroStyle/metroStyle.css',
    ];

    public $js = [
        'libs/ztree3/js/jquery.ztree.core.min.js',
        'libs/ztree3/js/jquery.ztree.excheck.min.js',
        'libs/ztree3/js/jquery.ztree.exhide.min.js',
        'libs/ztree3/js/fuzzysearch.min.js',
        'use/ztree3.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
