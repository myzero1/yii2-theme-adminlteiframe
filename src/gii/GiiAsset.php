<?php
/**
 * @link https://github.com/borodulin/yii2-gii-modal
 * @copyright Copyright (c) 2015 Andrey Borodulin
 * @license https://github.com/borodulin/yii2-gii-modal/blob/master/LICENSE
 */

namespace myzero1\adminlteiframe\gii;

use yii\web\AssetBundle;

/**
 * @author Andrey Borodulin
 * 
 */
class GiiAsset extends AssetBundle
{
    public $jsVersion = '1.735.1';
    public $cssVersion = '1.735.1';
    function init(){
        parent::init();
        \myzero1\adminlteiframe\assets\php\components\LayoutAsset::addVersion($this->js, $this->jsVersion, $this->css, $this->cssVersion);
    }
    
    public $sourcePath = '@vendor/myzero1/yii2-theme-adminlteiframe/src/gii/assets';
    
    public $js = [
        'js/gii.js',
    ];
    
    public $css = [
        'css/gii.css',
    ];
    public $depends = [
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
