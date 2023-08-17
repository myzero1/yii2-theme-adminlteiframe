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
    public static $privateKey = '-----BEGIN RSA PRIVATE KEY-----
MIICXwIBAAKBgQC3oSDe9Gu6AcoNU0NYQRBi3Pidwqlet/PpMddqlqnUO4sP4R0/
ABOHbf/1byVbfKsbpEQqan2+v8x7MvrjZtzl6cAqrGkp3zmfvMHSkYBaQFZym0Hc
49sMCbygCy77Hw9PnXsFIFayTsT97Whd6U8HzKg51wHoSW+eq2QmjZUCsQIDAQAB
AoGBAIHnyFRR/5/gQit5GuxlYw09m9gnbSBn7HKtYuKx4UUWNoOuUr1N9YLai7f6
wCffo0DzzZFgMsLt9t+1Kg4Tp/L/Z9n1zOIDTViETZrLChzpbaIf413d0kd7uwJd
R4L5+adKWI7KNfHiuiJOycz7njhqQGVr30U2GNRRsL0YBhhRAkEA5BIbi10bpRnC
ZCCM+sABXJPnoGwpJHZ5Q+Ntqsq5NbgBmQPZYisK5jgGUuDR1vuMkFnwve7IqEc1
So9yiYQLnQJBAM4dz0SGRzhu0GkzIvbwXRxakTjQAVH2z/mF1JnRQkMelymkwb7A
c1/N4/gWbphAoVwjnbc19YqhG2HUePPBGSUCQQDeL53R6UUTVMMCFIwDhKZO8HBI
4tY6BYkh0CB4sMI6SSaVUSCn+FLH8XCHsSn8jFdmEZjtEAE/nw+VsaXdvlwpAkEA
wWd5UExLUemxR7VDDsFWLT/SWqPbSUS1u+ZXKooPihmPL/U4EzxURkZUrjqmRdkH
UATffcV1BELOBcswP1EmvQJBALpQG6QqeFzeCjFer1LyNDyhENeceyDsJ32T9X6y
ZsfY0Y4XYNzLWsLGNsG5DT8p958wBytqZ/cnk2Kzes8RREQ=
-----END RSA PRIVATE KEY-----
'; 

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
     * https://www.yii666.com/blog/129530.html
     * openssl genrsa -out private.pem 1024 //创建私钥。密钥长度，1024觉得不够安全的话可以用2048，但是代价也相应增大
     * openssl rsa -in private.pem -pubout -out public.pem //创建公钥。这样便生产了公钥。
     * 
     * @param mixed $loginForm 
     * @param string $privateKey rsa privateKey
     * @param array $options   ['usernameKey'=>'username','passwordKey'=>'password'] 
     * @return bool $ok
     */
    public static function CheckPassword(&$loginForm,$privateKey='',$options=['usernameKey'=>'username','passwordKey'=>'password','frequentlyMsg'=>'Request too frequently','replayMsg'=>'Request replay']){
        $ok=false;

        if ($privateKey=='') {
            $privateKey = self::$privateKey;
        } else {
            // -----BEGIN RSA PRIVATE KEY-----
            // MIICXwIBAAKBgQC3oSDe9Gu6AcoNU0NYQRBi3Pidwqlet/PpMddqlqnUO4sP4R0/
            // ABOHbf/1byVbfKsbpEQqan2+v8x7MvrjZtzl6cAqrGkp3zmfvMHSkYBaQFZym0Hc
            // 49sMCbygCy77Hw9PnXsFIFayTsT97Whd6U8HzKg51wHoSW+eq2QmjZUCsQIDAQAB
            // AoGBAIHnyFRR/5/gQit5GuxlYw09m9gnbSBn7HKtYuKx4UUWNoOuUr1N9YLai7f6
            // wCffo0DzzZFgMsLt9t+1Kg4Tp/L/Z9n1zOIDTViETZrLChzpbaIf413d0kd7uwJd
            // R4L5+adKWI7KNfHiuiJOycz7njhqQGVr30U2GNRRsL0YBhhRAkEA5BIbi10bpRnC
            // ZCCM+sABXJPnoGwpJHZ5Q+Ntqsq5NbgBmQPZYisK5jgGUuDR1vuMkFnwve7IqEc1
            // So9yiYQLnQJBAM4dz0SGRzhu0GkzIvbwXRxakTjQAVH2z/mF1JnRQkMelymkwb7A
            // c1/N4/gWbphAoVwjnbc19YqhG2HUePPBGSUCQQDeL53R6UUTVMMCFIwDhKZO8HBI
            // 4tY6BYkh0CB4sMI6SSaVUSCn+FLH8XCHsSn8jFdmEZjtEAE/nw+VsaXdvlwpAkEA
            // wWd5UExLUemxR7VDDsFWLT/SWqPbSUS1u+ZXKooPihmPL/U4EzxURkZUrjqmRdkH
            // UATffcV1BELOBcswP1EmvQJBALpQG6QqeFzeCjFer1LyNDyhENeceyDsJ32T9X6y
            // ZsfY0Y4XYNzLWsLGNsG5DT8p958wBytqZ/cnk2Kzes8RREQ=
            // -----END RSA PRIVATE KEY-----

            $privateKey=str_replace(' RSA PRIVATE KEY','___RSA___PRIVATE___KEY',$privateKey);
            $privateKey=str_replace(" ","",$privateKey);
            $privateKey=str_replace("\t","",$privateKey);
            $privateKey=str_replace('___RSA___PRIVATE___KEY',' RSA PRIVATE KEY',$privateKey);
        }

        if (\Yii::$app->request->isPost) {
            $post=\Yii::$app->request->post();
            $className=$loginForm::className();
            $info=explode('\\',$className);
            $className=end($info);
            $loginForm->load(\Yii::$app->request->post());

            $ret = self::CheckZ1password(
                $post[$className][$options['usernameKey']],
                $post[$className][$options['passwordKey']],
                $privateKey
            );
            if ($ret['err']=='') {
                $_POST[$className][$options['passwordKey']]=$ret['password'];
                \Yii::$app->request->setBodyParams($_POST);
                $ok=true;
            } else {
                if ($ret['err']=='Request too frequently') {
                    $loginForm->addError('password',$options['frequentlyMsg']);
                } else {
                    $loginForm->addError('password',$options['replayMsg']);
                }
            }
        }
        
        return $ok;
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

        $ret = self::CheckRequestCount($username,$expires=60,$times=6,$lockTime=300);
        if (!$ret['ok']) {
            $data['err']='Request too frequently';
        } else {
            $ret2 = self::retryRequest($username,$ret,$encrypted,$privateKey,$expires=30);

            if (!$ret2['ok']) {
                // var_dump($ret2);exit;
                $data['err']='Request replay';
                $data['err']=$ret2['err'];
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

        $flag=md5($encrypted);
        if (strpos($info['token'],$flag)!==false) {
            $data['ok']=false;
            $data['err']='Encrypted duplicate';
        } else {
            $tokens=explode('|',$info['token']);
            $tokensNew=array_slice($tokens, -10);
            $tokensNew[]=$flag;
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