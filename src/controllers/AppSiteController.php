<?php

namespace backend\controllers;

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
                        'actions' => ['logout', 'index'],
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
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

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
        // $this->layout = '@vendor/myzero1/yii2-theme-adminlteiframe/src/views/adminlteiframe/layouts/layout';
        $this->layout = '@app/views/adminlteiframe/layouts/layout';
        return $this->render('@vendor/myzero1/yii2-theme-adminlteiframe/src/views/adminlteiframe/site/default');
    }

    public function actionChangePw()
    {
        $modelData = [
            'passwordOld' => [
                'label' => '老密码',
            ],
            'password' => [
                'label' => '新密码'
            ],
        ];

        $keys = array_keys($modelData);
        $labels = array_combine($keys, array_column($modelData, 'label'));

        $model = new \yii\base\DynamicModel($keys);
        $model->setAttributeLabels($labels);
        $model->addRule($keys, 'safe');
        $model->addRule($keys, 'required');
        $model->addRule($keys, 'string', ['min' => 6]);
        $model->addRule(['passwordOld'], function ($attribute, $params) {
            if (!$this->hasErrors()) {
                $user = \Yii::$app->user->identity;
                if (!$user || !$user->validatePassword($this->passwordOld)) {
                    $this->addError($attribute, '老密码不对');
                }
            }
        });

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $user = \Yii::$app->user->identity;
                $user->setPassword($model->password);
                if ($user->save()) {
                    Yii::$app->getSession()->setFlash('success', '修改成功');
                    return \myzero1\adminlteiframe\helpers\Tool::redirectParent(['/']);
                } else {
                    $model->addError('password', $user->errors);
                }
            }
        }

        return $this->render('change-pw', [
            'model' => $model,
        ]);
    }

    public function actionContact()
    {
        $modelData = [
            'qq' => [
                'label' => 'QQ',
                'value' => '1235XXX',
            ],
            'phone' => [
                'label' => '手机',
                'value' => '158XXXXX',
            ],
            'email' => [
                'label' => '邮箱',
                'value' => 'XXXX@qq.com',
            ],
        ];

        $keys = array_keys($modelData);
        $labels = array_combine($keys, array_column($modelData, 'label'));
        $values = array_combine($keys, array_column($modelData, 'value'));

        $model = new \yii\base\DynamicModel($keys);
        $model->setAttributeLabels($labels);
        $model->addRule($keys, 'safe');
        $model->load($values, '');

        return $this->render('contact', [
            'model' => $model,
        ]);
    }
}
