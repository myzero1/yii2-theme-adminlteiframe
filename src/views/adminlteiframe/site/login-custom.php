<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

myzero1\adminlteiframe\assets\php\components\plugins\SwitchAsset::register($this);
myzero1\adminlteiframe\assets\php\components\plugins\Z1passwordAsset::register($this);

$this->title = \Yii::$app->name;
$this->params['breadcrumbs'][] = $this->title;

$bundle = myzero1\adminlteiframe\assets\php\components\ImgAsset::register($this);
$bg = sprintf('%s/img/login-bg32.jpg', $bundle->baseUrl);
$loginBg = sprintf('url(%s) #3c8dbc no-repeat center center', $bg);

if (isset(\Yii::$app->assetManager->bundles["myzero1\adminlteiframe\assets\php\components\MainAsset"])) {
    if (isset(\Yii::$app->assetManager->bundles["myzero1\adminlteiframe\assets\php\components\MainAsset"]['loginBg'])) {
        $loginBg = \Yii::$app->assetManager->bundles["myzero1\adminlteiframe\assets\php\components\MainAsset"]['loginBg'];
    }
}

?>

<div class="larry-canvas" id="canvas" style="width: 100vw; height: 100vh;position: absolute;top: 0;left: 0;overflow: hidden;<?php echo $loginBg; ?>"></div>

<div class="ali-form-layout">
    <div class="ali-form-header-layout">
        <div class="ali-form-header">
            <span class="app-name"><?= Html::encode($this->title) ?></span>
        </div>
    </div>
    <div class="ali-form-body">
        <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => true]); ?>

        <?= $form->field($model, 'username')->textInput([
            'placeholder' => '请输入',
            'readonly' => true,
            'onfocus' => "this.removeAttribute('readonly');",
        ]) ?>

        <?= $form->field($model, 'password')->passwordInput([
            'placeholder' => '请输入',
            'readonly' => true,
            'onfocus' => "this.removeAttribute('readonly');",
            'data-provide' => 'z1password',
            'rsa-key-public' => 'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQC3oSDe9Gu6AcoNU0NYQRBi3Pidwqlet/PpMddqlqnUO4sP4R0/ABOHbf/1byVbfKsbpEQqan2+v8x7MvrjZtzl6cAqrGkp3zmfvMHSkYBaQFZym0Hc49sMCbygCy77Hw9PnXsFIFayTsT97Whd6U8HzKg51wHoSW+eq2QmjZUCsQIDAQAB',
        ]) ?>

        <?= $form
        ->field(new \myzero1\captcha\models\Captcha(['scenario'=>'jsPhp']),'verifyCode')
        ->widget(\myzero1\captcha\widgets\Captcha::className(),
            [
                'imageOptions'=>[
                    'alt'=>'点击换图',
                    'title'=>'点击换图',
                    'style'=>'cursor:pointer;position:absolute;right:1px;top:1px;height:32px;z-index:1;border-radius: 0px 3px 3px 0px;'
                ]
            ]
        )
        ?>

        <!-- <?php $model->rememberMe = 0; ?>

        <?= $form->field($model, 'rememberMe', [
            'labelOptions' => [
                'style' => '
                        padding:0;
                    ',
            ],
            'options' => [
                'style' => '
                        width:400px;
                    ',
            ],
        ])->checkbox([
            'id' => 'mywitch',
            'data-handle-width' => '105',
            'data-on-color' => 'primary',
            'data-on-text' => '要记住密码',
            'data-off-color' => 'info',
            'data-off-text' => '不记住密码',
            'data-label-text' => '要记住密码',
            'checked' => $model->rememberMe == '1' ? true : false,
        ])->label('') ?> -->

        <div class="form-group">
            <?= Html::submitButton('登录', ['class' => 'btn btn-primary', 'name' => 'login-button', 'style' => 'width:260px;']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>

<?php
$showJParticle = 'false';
if (isset(\Yii::$app->assetManager->bundles["myzero1\adminlteiframe\assets\php\components\MainAsset"]['showJParticle'])) {
    $showJParticle = \Yii::$app->assetManager->bundles["myzero1\adminlteiframe\assets\php\components\MainAsset"]['showJParticle'];
}
?>

<div id="jParticle" show="<?= $showJParticle ?>"></div>

<?php

$bundle = \myzero1\adminlteiframe\assets\php\components\MainAsset::register(Yii::$app->view);
$bundle->css[] = 'css/login.css'; // dynamic file added
$bundle->js[] = 'js/login.js'; // dynamic file added

$js = <<<JS
    if(window.top!=window.self){
        window.top.location.href = window.self.location.href;
    }
JS;

$this->registerJs($js, \yii\web\View::POS_HEAD);

?>