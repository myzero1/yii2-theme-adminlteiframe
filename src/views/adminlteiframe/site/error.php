<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>

<div class="alert alert-info">
    <span style="font-size: 16px;font-weight: bold;padding-right: 10px;">当前url:</span><code><?= Yii::$app->request->getHostInfo().Yii::$app->request->url?></code>
</div>

<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        The above error occurred while the Web server was processing your request.
    </p>
    <p>
        Please contact us if you think this is a server error. Thank you.
    </p>

</div>

<div class="box box-info box-solid">
    <div class="box-header with-border">
      <h3 class="box-title">这是adminlteiframe主题的提示</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
      </div>
      <!-- /.box-tools -->
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <blockquote>
            <div>
                <h3><?= $this->context->action->uniqueId ?></h3>
                <p>
                    This is the view content for action "<?= $this->context->action->id ?>".
                    The action belongs to the controller "<?= get_class($this->context) ?>"
                    in the "<?= $this->context->module->id ?>" module.
                </p>
                <p>
                    You may customize this page by editing the following file:<br>
                    <code><?= __FILE__ ?></code>
                </p>
            </div>
        </blockquote>
        <blockquote>
            <h3>自定义adminlteifram主题</h3>
            <ul>
                <li>
                    从<code><?= Yii::getAlias("@vendor/myzero1/yii2-theme-adminlteiframe/src/views")?></code>复制views目录为<code><?= Yii::getAlias("@app/adminlteiframe-views")?></code></li>
              <li>
                    在main.php文件中设置
                    <pre>
                        'layout' => 'list-iframe',
                        'components' => [
                            ......
                            'view' => [
                                'theme' => [
                                    'pathMap' => [
                                        '@app/views' => '@app/adminlteiframe-views'
                                    ],
                                ],
                            ],
                            ......
                        ],
                    </pre>
              </li>
              <li>更加时间需要，修改<code><?= Yii::getAlias("@app/adminlteiframe-views")?></code>里面的文件</li>
            </ul>
        </blockquote>
    </div>
    <!-- /.box-body -->
</div>
