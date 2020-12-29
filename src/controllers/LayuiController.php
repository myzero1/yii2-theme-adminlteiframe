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
class LayuiController extends Controller
{
    /**
     * Renders the main msg of site
     * @return string
     */
    public function actionMain()
    {
        return $this->render('@vendor/myzero1/yii2-theme-adminlteiframe/src/views/layui/site/main');
    }

    /**
     * Renders the main msg of notice
     * @return string
     */
    public function actionNotice()
    {
        return $this->render('@vendor/myzero1/yii2-theme-adminlteiframe/src/views/layui/site/notice');
    }

    /**
     * Renders the main msg of notice
     * @return string
     */
    public function actionE403()
    {
        return $this->render('@vendor/myzero1/yii2-theme-adminlteiframe/src/views/layui/site/e403');
    }

    /**
     * Renders the main msg of notice
     * @return string
     */
    public function actionE404()
    {
        return $this->render('@vendor/myzero1/yii2-theme-adminlteiframe/src/views/layui/site/e404');
    }

    /**
     * Renders the main msg of notice
     * @return string
     */
    public function actionE500()
    {
        return $this->render('@vendor/myzero1/yii2-theme-adminlteiframe/src/views/layui/site/e500');
    }


    /**
     * Renders the index view for the module，render the layout
     * @return string
     */
    public function actionIcons()
    {
        return $this->render('@vendor/myzero1/yii2-theme-adminlteiframe/src/views/layui/doc/icons');
    }

    /**
     * Renders the index view for the module，render the layout
     * @return string
     */
    public function actionAddress()
    {
        return $this->render('@vendor/myzero1/yii2-theme-adminlteiframe/src/views/layui/doc/address');
    }

    /**
     * Renders the index view for the module，render the layout
     * @return string
     */
    public function actionNav()
    {
        return $this->render('@vendor/myzero1/yii2-theme-adminlteiframe/src/views/layui/doc/nav');
    }

    /**
     * Renders the index view for the module，render the layout
     * @return string
     */
    public function actionBodytab()
    {
        return $this->render('@vendor/myzero1/yii2-theme-adminlteiframe/src/views/layui/doc/bodytab');
    }

    /**
     * Renders the index view for the module，render the layout
     * @return string
     */
    public function actionIntroduction()
    {
        return $this->render('@vendor/myzero1/yii2-theme-adminlteiframe/src/views/layui/business/introduction');
    }


    /**
     * Renders the index view for the module，render the layout
     * @return string
     */
    public function actionCreate()
    {
        return $this->render('@vendor/myzero1/yii2-theme-adminlteiframe/src/views/layui/user/create');
    }

    /**
     * Renders the index view for the module，render the layout
     * @return string
     */
    public function actionInit()
    {
        if (\Yii::$app->request->isPost) {
            $iniSql = '
                CREATE TABLE IF NOT EXISTS `z1_user` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
                  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
                  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                  `status` smallint(6) NOT NULL DEFAULT 10,
                  `created_at` int(11) NOT NULL,
                  `updated_at` int(11) NOT NULL,
                  PRIMARY KEY (`id`),
                  UNIQUE KEY `username` (`username`),
                  UNIQUE KEY `email` (`email`),
                  UNIQUE KEY `password_reset_token` (`password_reset_token`)
                ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
            ';
            $result = \Yii::$app->db->createCommand($iniSql)->execute();

            \Yii::$app->getSession()->setFlash('success', '恭喜你，初始化操作成功。');
        }

        return $this->render('@vendor/myzero1/yii2-theme-adminlteiframe/src/views/layui/user/init');
    }

    /**
     * Renders the index view for the module，render the layout
     * @return string
     */
    public function actionRole()
    {
        return $this->render('@vendor/myzero1/yii2-theme-adminlteiframe/src/views/layui/user/role');
    }
}
