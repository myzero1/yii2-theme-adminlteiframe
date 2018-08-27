<?php

/**
 * Theme main layout.
 *
 * @var \yii\web\View $this View
 * @var string $content Content
 */

use myzero1app\themes\layuiadmin\assets\php\components\LayuiAsset;
use yii\helpers\Html;

$bundle = LayuiAsset::register($this);

?>

<?php  $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?=  Yii::$app->language ?>">
<head>
    <meta charset="<?=  Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?=  Html::csrfMetaTags() ?>
    <title><?=  Html::encode($this->title) ?></title>

    <style type="text/css">
        html,body{
            min-height: 300px !important;
        }
        body{
            overflow: hidden;
        }
    </style>

    <?php  $this->head() ?>
</head>
<body class="childrenBody">
<?php  $this->beginBody() ?>

    <?=  $content ?>

<?php  $this->endBody() ?>
</body>
</html>
<?php  $this->endPage() ?>
