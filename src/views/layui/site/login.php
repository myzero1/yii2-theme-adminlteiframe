<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

myzero1\layui\assets\php\components\plugins\SwitchAsset::register($this);

$this->title = \Yii::$app->name;
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="larry-canvas" id="canvas" style="width: 100vw; height: 100vh;position: absolute;top: 0;left: 0;overflow: hidden;"></div>

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
                    'onfocus'=>"this.removeAttribute('readonly');",
                ]) ?>

            <?= $form->field($model, 'password')->passwordInput([
                    'placeholder' => '请输入',
                    'readonly' => true,
                    'onfocus'=>"this.removeAttribute('readonly');",
                ]) ?>

            <?php $model->rememberMe = 0; ?>

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
            ])->label('') ?>

            <div class="form-group">
                <?= Html::submitButton('登录', ['class' => 'btn btn-primary', 'name' => 'login-button','style' => 'width:260px;']) ?>
            </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>


<?php

$bundle = \myzero1\layui\assets\php\components\MainAsset::register(Yii::$app->view);
$bundle->css[] = 'resources/css/login.css'; // dynamic file added
$bundle->js[] = 'resources/js/login.js'; // dynamic file added
$bundle->js[] = 'resources/js/jquery.ez-bg-resize.js';

$js = <<<JS
    if(window.top!=window.self){
        window.top.location.href = window.self.location.href;
    }
JS;

$js2 = <<<JS
    $("body").ezBgResize({
    img : "$bundle->baseUrl/resources/images/login-bg3.jpg",
    opacity : .75,
    center : true
    });
JS;

$this->registerJs($js, \yii\web\View::POS_HEAD);
$this->registerJs($js2);

?>