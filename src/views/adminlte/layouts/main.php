<?php

/**
 * Theme main layout.
 *
 * @var \yii\web\View $this View
 * @var string $content Content
 */

use myzero1\adminlteiframe\widgets\Alert;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

$bundle = myzero1\adminlteiframe\assets\php\components\AdminLteAsset::register($this);
$bundle2 = myzero1\adminlteiframe\assets\php\components\ImgAsset::register($this);
$avatarUrl = sprintf('%s/img/myzero1.jpg', $bundle->baseUrl);

$profile = [
  'avatarUrl' => $avatarUrl,
  'username' => Yii::$app->user->isGuest ? '' : '管理员',
  'trueName' => "",
  'lastTime' => 0,
  'lastIp' => "",
  'profileUrl' => '#',
];

// var_dump($profile['avatarUrl']);exit;

$skin = \Yii::$app->assetManager->bundles['myzero1\adminlteiframe\assets\php\components\AdminLteAsset']->skin;

?>

<?= $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
  <?= $this->render('./head') ?>
</head>

<body class="<?= $skin ?>">

  <?php $this->beginBody(); ?>

  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a href="<?= Yii::$app->homeUrl ?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><?= Yii::$app->name ?></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><?= Yii::$app->name ?></span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- <i class="glyphicon glyphicon-user"></i> -->
                <img src="<?= $profile['avatarUrl'] ?>" class="user-image" alt="User Image">
                <span class="hidden-xs"><?= $profile['username'] ?> <i class="caret"></i></span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header bg-light-blue">
                  <?php if ($profile['avatarUrl'] != '') : ?>
                    <?= Html::img($profile['avatarUrl'], ['class' => 'img-circle', 'alt' => $profile['username']]) ?>
                  <?php endif; ?>
                  <p>
                    <?php echo $profile['username'] ?>
                    <small><?= Yii::t('app', '登录IP：') ?> <?= $profile['lastIp'] ?></small>
                    <small><?= Yii::t('app', '登录时间：') ?> <?= date('Y-m-d H:i:s', $profile['lastTime']) ?></small>
                  </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <?= Html::a(
                      Yii::t('app', '个人资料'),
                      [$profile['profileUrl']],
                      ['class' => 'btn btn-default btn-flat']
                    ) ?>
                  </div>
                  <div class="pull-right">
                    <?php echo Html::beginForm(['/site/logout'], 'post')
                      . Html::submitButton(
                        Yii::t('app', '安全退出'),
                        ['class' => 'btn btn-default btn-flat logout']
                      )
                      . Html::endForm()
                    ?>

                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <!-- <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"> -->
        </div>
        <div class="pull-left info">
          <!--                <p>Alexander Pierce</p>
                  <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
        </div>
      </div>
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <?= $this->render('./sidebar-menu') ?>
      </section>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          <?= $this->title ?>
          <?php if (isset($this->params['subtitle'])) : ?>
            <small><?= $this->params['subtitle'] ?></small>
          <?php endif; ?>
        </h1>
        <?= Breadcrumbs::widget(
          [
            'homeLink' => [
              'label' => '<i class="fa fa-dashboard"></i> ' . Yii::t('app', '首页'),
              'url' => '/'
            ],
            'encodeLabels' => false,
            'tag' => 'ol',
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : []
          ]
        ) ?>
      </section>

      <!-- Main content -->
      <section class="content">
        <?= Alert::widget(); ?>
        <?= $content ?>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- /.content-wrapper -->

    <?php if (isset(\Yii::$app->assetManager->bundles["myzero1\adminlteiframe\assets\php\components\MainAsset"])) {
      $footer = \Yii::$app->assetManager->bundles["myzero1\adminlteiframe\assets\php\components\MainAsset"]['footer'];
      $version = \Yii::$app->assetManager->bundles["myzero1\adminlteiframe\assets\php\components\MainAsset"]['version'];
      $copyright = \Yii::$app->assetManager->bundles["myzero1\adminlteiframe\assets\php\components\MainAsset"]['copyright'];
      $copyrightOwner = \Yii::$app->assetManager->bundles["myzero1\adminlteiframe\assets\php\components\MainAsset"]['copyrightOwner'];
      $copyrightOwnerUrl = \Yii::$app->assetManager->bundles["myzero1\adminlteiframe\assets\php\components\MainAsset"]['copyrightOwnerUrl'];
    } else {
      $footer = 'yes'; // yes , no , required
      $version = '1.0.1'; // required
      $copyright = 'Copyright © 2018-2735'; // required
      $copyrightOwner = 'myzero1'; // required
      $copyrightOwnerUrl = 'https://github.com/myzero1/yii2-theme-adminlteiframe'; // required
    }
    ?>

    <footer class="main-footer">
      <?php if ('yes' == $footer) { ?>
        <div class="pull-right hidden-xs">
          <b>Version</b> <?= $version ?>
        </div>
        <strong><?= $copyright ?><a href="<?= $copyrightOwnerUrl ?>"><?= $copyrightOwner ?></a>.</strong> All rights reserved.
      <?php } ?>
    </footer>

    <?php $this->endBody(); ?>
</body>

</html>
<?php $this->endPage(); ?>
