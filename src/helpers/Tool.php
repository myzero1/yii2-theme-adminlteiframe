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

    /**
     * Validate password
     * @param string rsa encrypted
     * @return string decrypted
     */
    public static function CheckZ1password($encrypted,$privateKey){
        // https://www.yii666.com/blog/129530.html

        $bs64=base64_decode($encrypted);
        openssl_private_decrypt($bs64, $decrypted, $privateKey);

        return $decrypted;
    }

}
