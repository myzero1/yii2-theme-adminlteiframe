<?php
namespace myzero1\adminlteiframe\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index','layout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        $privateKey = '-----BEGIN RSA PRIVATE KEY-----
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

        $ok=\myzero1\adminlteiframe\helpers\Tool::CheckPassword(
            $model,
            $privateKey,
            [
                'usernameKey'=>'username',
                'passwordKey'=>'password',
                'frequentlyMsg'=>'请求太频繁请稍后再试',
                'replayMsg'=>'请不要重复提交',
            ]
        );

        if ($ok && $model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            // return $this->renderAjax('login-custom1', [
            // return $this->renderAjax('login-custom', [
            return $this->renderAjax('login', [
            // return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Placeholdon layout.
     *
     * @return string
     */
    public function actionLayout()
    {
        // var_dump('expression');exit;
        $this->layout = '@vendor/myzero1/yii2-theme-adminlteiframe/src/views/adminlteiframe/layouts/layout';
        return $this->render('@vendor/myzero1/yii2-theme-adminlteiframe/src/views/adminlteiframe/site/default');
    }
}
