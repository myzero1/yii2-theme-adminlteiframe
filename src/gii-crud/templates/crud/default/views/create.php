<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$idModelName = Inflector::camel2id(StringHelper::basename($generator->modelClass));

echo "<?php\n";
?>

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */

app\themes\adminlteiframe\giimodal\GiiAsset::register($this);

$this->title = Yii::t('yii', 'Create') . ' ' . <?= $generator->generateString(Inflector::camel2words(StringHelper::basename($generator->modelClass))) ?>;
$this->params['breadcrumbs'][] = ['label' => <?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="<?= $idModelName ?>-create">

    <?= "<?php" ?> if(!\Yii::$app->request->isAjax): ?>
    
    <h1><?= "<?= " ?>Html::encode($this->title) ?></h1>
    
    <?= "<?php" ?> endif ?>

    <?= "<?= " ?>$this->render('_form', [
        'model' => $model,
    ]) ?>

</div>