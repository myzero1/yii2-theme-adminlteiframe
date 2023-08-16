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
     * 
     * @param string $username 
     * @param string $encrypted rsa encrypted
     * @param string $privateKey rsa privateKey
     * @return array $data
     */
    public static function CheckZ1password($username,$encrypted,$privateKey){
        // https://www.yii666.com/blog/129530.html

        // $bs64=base64_decode($encrypted);
        // openssl_private_decrypt($bs64, $decrypted, $privateKey);

        // return $decrypted;

        $data=[
            'password'=>'',
            'err'=>'',
        ];

        $ret = self::CheckRequestCount($username,$expires=60,$times=6,$lockTime=120);
        if (!$ret['ok']) {
            $data['err']='Request too frequently';
        } else {
            $ret2 = self::retryRequest($username,$ret,$encrypted,$privateKey,$expires=30);

            if (!$ret2['ok']) {
                $data['err']='Request replay';
            } else {
                $data['password']=$ret2['password'];
            }
        }

        return $data;
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
            'lastmod'=>0,
        ];

        $lastmod=0;
        $info=$data;
        // $t1 = microtime();
        try {
            clearstatcache();
            // $lastmod=filemtime($fileName);
            filemtime($fileName);
            $infoJson=file_get_contents($fileName);
            $info=json_decode($infoJson,true);
            $lastmod=$info['lastmod'];
        } catch (\Throwable $th) {
            //throw $th;
        }

        // var_dump($data['lastmod']);exit;

        if ($lastmod==0) {
            $data['ok']=true;
            $data['lastmod']=time();
        } else {
            $diff=time()-$lastmod;
            // var_dump($diff,$lockTime,$expires,$info['times'],$times);
            if ($diff>$lockTime) {
                $data['ok']=true;
                $data['times']=0;
                $data['lastmod']=time();
            } else {
                if ($diff>$expires) {
                    if ($info['times']<$times) {
                        $data['ok']=true;
                        $data['times']=0;
                        $data['lastmod']=time();
                    } else {
                        $data=$info;
                        $data['ok']=false;
                    }
                } else {
                    $data=$info;
                    $data['ok']=$data['times']<$times;
                }
            }
        }

        if ($data['ok']) {
            $data['times']=$data['times']+1;
        }

        $data['now']=time();
        file_put_contents($fileName,json_encode($data));

        // var_dump($lastmod,$data);exit;

        return $data;
    }

    
    /**
     * ReTry request
     * @param array $info from CheckRequestCount's $data
     * @param string $encrypted rsa encrypted
     * @param string $privateKey rsa privateKey
     * @param int $expires the unit is second
     * @return array $data 
     */
    public static function retryRequest($username,$info,$encrypted,$privateKey,$expires=30){
        $data=[
            'ok'=>false,
            'password'=>'',
            'err'=>'',
        ];

        if (strpos($info['token'],$encrypted)!==false) {
            $data['ok']=false;
        } else {
            $tokens=explode('|',$info['token']);
            $tokensNew=array_slice($tokens, -10);
            $tokensNew[]=$encrypted;
            $info['token'] = implode('|',$tokensNew);

            $decrypted='';
            try {
                $bs64=base64_decode($encrypted);
                openssl_private_decrypt($bs64, $decrypted, $privateKey);
            } catch (\Throwable $th) {
                //throw $th;
            }

            if ($decrypted=='') {
                $data['ok']=false;
                $data['err']='rsa err';
            } else {
                // var_dump($decrypted,substr($decrypted,0,10));exit;
                $data['password']=substr($decrypted,10);

                // 1692164714password
                if (strlen($decrypted)<10) {
                    $data['ok']=false;
                    $data['err']='password err';
                } else {
                    $timeStr=substr($decrypted,0,10);
                    $time = intval($timeStr);

                    if ($time<=1692165014) {
                        $data['ok']=false;
                        $data['err']='initClientTime err';
                    } else {
                        if ($info['initClientTime']==0) {
                            $data['ok']=true;
                            $info['initClientTime']=$time;
                            $info['initServerTime']=time();
                        } else {
                            $diffInit=$info['initServerTime']-$info['initClientTime'];
                            $serverTime=$diffInit+$time;
                            $diff=time()-$serverTime;
                            // var_dump($diff,$expires);
                            if ($diff>0 && $diff<$expires) {
                                $data['ok']=true;
                            } else {
                                $data['ok']=false;
                                $info['initClientTime']=$time;
                                $info['initServerTime']=time();
                            }
                        }
                    }
                }
            }

            $fileName=sprintf('%s/login_limit_%s',\Yii::getAlias("@runtime"),$username);
            file_put_contents($fileName,json_encode($info));

        }

        return $data;
    }

}