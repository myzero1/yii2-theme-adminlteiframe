<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Place */

myzero1\adminlteiframe\gii\GiiAsset::register($this);

?>

<div class="place-create">

    <?php if (!\Yii::$app->request->isAjax) : ?>

        <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?php endif ?>

    <div class="use-form">

        <?php $form = ActiveForm::begin(['id' => 'layer-form-' . $this->context->action->id, 'options' => ['class' => 'adminlteiframe-form']]) ?>

        <?= $form->field($model, 'passwordOld')->passwordInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

        <div class="form-group form-acitons">
            <?= Html::submitButton('保存', ['class' => 'btn btn-primary pull-right']) ?>
        </div>

        <?php ActiveForm::end() ?>

    </div>

</div>