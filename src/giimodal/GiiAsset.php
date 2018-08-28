<?php
/**
 * @link https://github.com/borodulin/yii2-gii-modal
 * @copyright Copyright (c) 2015 Andrey Borodulin
 * @license https://github.com/borodulin/yii2-gii-modal/blob/master/LICENSE
 */

namespace myzero1\adminlteiframe\giimodal;

use yii\web\AssetBundle;

/**
 * @author Andrey Borodulin
 * 
 */
class GiiAsset extends AssetBundle
{
    public $sourcePath = '@vendor/myzero1/yii2-theme-adminlteiframe/src/giimodal/assets';
    
    public $js = [
        'gii-modal.js',
    ];
    public $depends = [
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
