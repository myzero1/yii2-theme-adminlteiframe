<?php  $this->beginPage(); ?>
    <!DOCTYPE html>
    <html lang="<?=  Yii::$app->language ?>">
    <head>
        <?=  $this->render('./head') ?>
    </head>
    <body class="bg-black">
    <?php  $this->beginBody(); ?>
    <?=  $content ?>
    <?php  $this->endBody(); ?>
    </body>
    </html>
<?php  $this->endPage(); ?>