<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->searchModelClass, '\\') ?> */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="adminlteiframe-action-box <?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-search">

    <?= "<?php " ?>$form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= "<?php // echo " ?>$form->field($model, 'id')->textInput(['data-provide' =>"z1datarangepicker",'data-z1datarangepicker-config' => '{singleDatePicker: false}'])?>

<?php
$count = 0;
foreach ($generator->getColumnNames() as $attribute) {
    if (++$count < 6) {
        echo "    <?= " . $generator->generateActiveSearchField($attribute) . " ?>\n\n";
    } else {
        echo "    <?php // echo " . $generator->generateActiveSearchField($attribute) . " ?>\n\n";
    }
}
?>
    <div class="form-group aciotns">
        <?= "<?= " ?>Html::submitButton(<?= $generator->generateString('搜索') ?>, ['class' => 'btn btn-primary']) ?>

        <?= "<?= " ?>Html::a('添加', ['create'], [
            'class' => 'btn btn-success show-modal',
            'data-target' => '#modal_view',
            'data-header' => 'Create User2',
        ]); ?>

       <?= "<?= " ?>Html::a('批量删除', ['delete-selected','ids' => ''], [
            'class' => 'btn btn-danger show-modal',
            'data-target' => '#modal_view',
            'data-header' => '批量删除',
            'confirm-msg' => '一旦删除，无法恢复，是否删除选定的数据？',
            'id' => 'delete-selected',
        ]); ?>

    </div>

    <?= "<?php " ?>ActiveForm::end(); ?>

</div>
