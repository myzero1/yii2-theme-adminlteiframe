<?php

namespace myzero1\adminlteiframe\assets\php\components;

use yii\web\AssetBundle;

/**
 * Main asset for the `adminlte` theming
 */

class MainAsset extends AssetBundle
{
    public $jsVersion = '1.735.1';
    public $cssVersion = '1.735.1';
    public $showJParticle = 'true';

    public $footer = 'yes'; // yes , no , required
    public $version = '1.0.1'; // required
    public $copyright = 'Copyright © 2018-2735'; // required
    public $copyrightOwner = 'myzero1'; // required
    public $copyrightOwnerUrl = 'https://github.com/myzero1/yii2-theme-adminlteiframe'; // required

    function init()
    {
        parent::init();
        \myzero1\adminlteiframe\assets\php\components\LayoutAsset::addVersion($this->js, $this->jsVersion, $this->css, $this->cssVersion);
    }

    public $sourcePath = '@vendor/myzero1/yii2-theme-adminlteiframe/src/assets/static/adminlteiframe';
    //public $baseUrl = '@web';
    public $css = [
        'css/font-awesome.min.css',
        'css/ionicons.min.css',
        'css/AdminLTE.2.3.8.min.css',
        'css/adminlteiframe-custom.css',
        // 'css/skins/all-skins.min.css',
    ];

    public $js = [
        'js/app.js',
        'js/app_iframe.js',
        'js/adminlteiframe-custom.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'myzero1\adminlteiframe\assets\php\components\plugins\LayerAsset',
        'myzero1\adminlteiframe\assets\php\components\plugins\TableAsset',
    ];
}
