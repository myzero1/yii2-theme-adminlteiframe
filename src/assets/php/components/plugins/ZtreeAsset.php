<?php

namespace myzero1\adminlteiframe\assets\php\components\plugins;

use yii\web\AssetBundle;

/**
 * Main asset for the `adminlte` theming
 */

class ZtreeAsset extends AssetBundle
{
    public $sourcePath = '@vendor/myzero1/yii2-theme-adminlteiframe/src/assets/static/plugins';
    public $css = [
        'libs/ztree3/css/zTreeStyle/zTreeStyle.css',
    ];

    public $js = [
        'libs/ztree3/js/jquery.ztree.core.js',
        'libs/ztree3/js/jquery.ztree.excheck.js',
        'libs/ztree3/js/jquery.ztree.excheck.js',
        'libs/ztree3/js/jquery.ztree.exhide.js',
        'libs/ztree3/js/fuzzysearch.js',
        'use/ztree3.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
