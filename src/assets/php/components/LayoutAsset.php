<?php

namespace myzero1\adminlteiframe\assets\php\components;

use yii\web\AssetBundle;

/**
 * Main asset for the `adminlte` theming
 */

class LayoutAsset extends AssetBundle
{
    public $skin = 'skin-blue';
    public $menuRefreshTab = true; //true,false
    public $jsVersion = '1.735.1';
    public $cssVersion = '1.735.1';
    function init(){
        parent::init();
        $this->css[] = sprintf('css/skins/%s.css', $this->skin);
        self::addVersion($this->js, $this->jsVersion, $this->css, $this->cssVersion);
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
        'js/index-iframe.js', // must after app_iframe
        'js/adminlteiframe-custom.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'myzero1\adminlteiframe\assets\php\components\plugins\LayerAsset',
    ];



    public static function addVersion(&$js, $jsVersion, &$css, $cssVersion){
        if (is_array($js)) {
            $jsArr = $js;
            
            foreach ($jsArr as $jsItem) {
                $jsNew[] = $jsItem . '?ver=' . $jsVersion;
            }
            $js = $jsNew;
        }
        if (is_array($css)) {
            $cssArr = $css;
            $cssNew = [];
            foreach ($cssArr as $cssItem) {
                $cssNew[] = $cssItem . '?ver=' . $cssVersion;
            }
            $css = $cssNew;
        }
    }
}
