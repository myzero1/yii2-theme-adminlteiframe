<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();

$idModelName = Inflector::camel2id(StringHelper::basename($generator->modelClass));

echo "<?php\n";
?>

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */

app\themes\adminlteiframe\giimodal\GiiAsset::register($this);

$this->title = Yii::t('yii', 'Update') . ' ' . <?= $generator->generateString(Inflector::camel2words(StringHelper::basename($generator->modelClass))) ?> . ' ' . $model-><?= $generator->getNameAttribute() ?>;
$this->params['breadcrumbs'][] = ['label' => <?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model-><?= $generator->getNameAttribute() ?>, 'url' => ['view', <?= $urlParams ?>]];
$this->params['breadcrumbs'][] = Yii::t('yii', 'Update');
?>

<div class="<?= $idModelName ?>-update">

    <?= "<?php" ?> if(!\Yii::$app->request->isAjax): ?>
    
    <h1><?= "<?= " ?>Html::encode($this->title) ?></h1>
    
    <?= "<?php" ?> endif ?>

    <?= "<?= " ?>$this->render('_form', [
        'model' => $model,
    ]) ?>

</div>