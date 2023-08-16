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
     * @param array $params ['user/delete',['id'=>1]]
     * @return string
     */
    public static function redirectParent(array $params){
        return sprintf('<script type="text/javascript">parent.location.href="%s"</script>',\yii\helpers\Url::to($params));
    }

    /**
     * Validate password
     * @param string $encrypted rsa encrypted
     * @param string $privateKey rsa privateKey
     * @return string decrypted
     */
    public static function CheckZ1password($encrypted,$privateKey){
        // https://www.yii666.com/blog/129530.html

        $bs64=base64_decode($encrypted);
        openssl_private_decrypt($bs64, $decrypted, $privateKey);

        return $decrypted;
    }

    /**
     * Check request count
     * @param string $username 
     * @param int $expires the unit is second
     * @param int $times
     * @param int $lockTime the unit is second
     * @return array $data
     */
    public static function CheckRequestCount($username,$expires=60,$times=6,$lockTime=300){
        $fileName=sprintf('%s/login_limit_%s',\Yii::getAlias("@runtime"),$username);
        $data=[
            'ok'=>false,
            'times'=>0,
            'initClientTime'=>0,
            'initServerTime'=>0,
            'token'=>'',
        ];

        $lastmod=0;
        // $t1 = microtime();
        try {
            clearstatcache();
            $lastmod=filemtime($fileName);
        } catch (\Throwable $th) {
            //throw $th;
        }

        if ($lastmod==0) {
            $data['ok']=true;
        } else {
            $diff=time()-$lastmod;
            if ($diff>$lockTime) {
                $data['ok']=true;
            } else {
                if ($diff>$expires) {
                    $data['ok']=false;
                } else {
                    $infoJson=file_get_contents($fileName);
                    $info=json_decode($infoJson,true);
                    $data=$info;

                    $data['ok']=$data['times']<$times;
                }
            }
        }

        if ($data['ok']) {
            $data['times']=$data['times']+1;

            file_put_contents(
                $fileName,
                json_encode($data)
            );
        }

        // var_dump($lastmod,$data);exit;

        return $data;
    }

}