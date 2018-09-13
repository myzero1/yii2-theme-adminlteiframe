<?php

/**
 * Theme main layout.
 *
 * @var \yii\web\View $this View
 * @var string $content Content
 */

use yii\helpers\Html;

$bundle = myzero1\adminlteiframe\assets\php\components\MainAsset::register($this);
myzero1\adminlteiframe\gii\GiiAsset::register($this);
myzero1\adminlteiframe\assets\php\components\plugins\BootstrapTableAsset::register($this);

?>

<?php  $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?=  Yii::$app->language ?>">

    <head>
        <meta charset="<?=  Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <?=  Html::csrfMetaTags() ?>
        <title><?=  Html::encode($this->title) ?></title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="../plugins/ie9/html5shiv.min.js"></script>
        <script src="../plugins/ie9/respond.min.js"></script>
        <![endif]-->

        <?php  $this->head() ?>
    </head>
    <body class="iframe-list-content hold-transition skin-blue sidebar-mini" >
        <?php  $this->beginBody() ?>
        <!-- Main content -->
        <section class="content list-content">
            <?= myzero1\adminlteiframe\widgets\Alert::widget(); ?>
            <?= $content ?>
        </section>
        <!-- /.content -->
        <?php
            $js = "
                var t=setTimeout(function(){
                        $('.adminlteiframe-alert').slideUp(1000);
                    },1000);
            ";

            $this->registerJs($js);
        ?>
        <?php  $this->endBody() ?>
    </body>
</html>
<?php  $this->endPage() ?>