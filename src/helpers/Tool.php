<?php
/**
 * @link https://github.com/myzero1/yii2-theme-adminlteiframe
 * @copyright Copyright (c) 2018 Myzero1
 * @license BSD-3-Clause
 */

namespace myzero1\adminlteiframe\helpers;
/**
 * @author Myzero1
 * 
 */
class Tool
{
    /**
     * redirect parent window.
     * @param array ['user/delete',['id'=>1]]
     * @return string
     */
    public static function redirectParent(array $params){
        return sprintf('<script type="text/javascript">parent.location.href="%s"</script>',\yii\helpers\Url::to($params));
    }
}
