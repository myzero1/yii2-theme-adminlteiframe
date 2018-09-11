<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>

<h1>页面提示信息</h1>

<div class="site-error">
    <ol>
        <li>错误信息：<code><?= Html::encode($this->title) . nl2br(Html::encode($message)) ?></code></li>
        <li>当前url：<code><?= Yii::$app->request->getHostInfo().Yii::$app->request->url?></code></li>
        <li>当前视图路径：<code><?= __FILE__ ?></code></li>
        <li>若在主题的视图目录（<code><?= Yii::getAlias("@vendor/myzero1/yii2-theme-adminlteiframe/src/views/adminlteiframe")?></code>）下没有找到对应视图就会在应用的视图目录（<code><?= Yii::getAlias("@app/views")?></code>）下找视图</li>
        <li>若在主题的视图目录和应用的视图目录中都有相应的视图，则先使用主题视图目录中的视图。若要使用应用视图目录中的视图，需要手动在控制器中指定。</li>
    </ol>
</div>