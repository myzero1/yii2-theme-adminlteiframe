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
class DemoController extends Controller
{
    /**
     * Demo page.
     *
     * @return string
     */
    public function actionLevel1()
    {
        return $this->render('@vendor/myzero1/yii2-theme-adminlteiframe/src/views/adminlteiframe/site/default');
    }

    /**
     * Demo page.
     *
     * @return string
     */
    public function actionLevel21()
    {
        return $this->render('@vendor/myzero1/yii2-theme-adminlteiframe/src/views/adminlteiframe/site/default');
    }

    /**
     * Demo page.
     *
     * @return string
     */
    public function actionLevel22()
    {
        return $this->render('@vendor/myzero1/yii2-theme-adminlteiframe/src/views/adminlteiframe/site/default');
    }
}
