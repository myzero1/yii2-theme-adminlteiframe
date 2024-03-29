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
        <?php //echo Alert::widget(); 
        ?>

        <?php

        $session = \Yii::$app->getSession();
        $flashes = $session->getAllFlashes();
        $flashesJson = json_encode($flashes);
        $session->removeAllFlashes();

        $js = "
          var flashesJson = $flashesJson

          for (let key in flashesJson) {
              if(key=='success'){
                  title='成功'
                  icon=1
              }else if(key=='fail'){
                  title='失败'
                  icon=2
              } else {
                  title=key
                  icon=0
              }

              layer.open({
                  icon: icon,
                  area: ['500px', '200px'],
                  type: 0,
                  title: title,
                  content: flashesJson[key],
                  shadeClose: false,
                  btn: ['确定'],
                  yes: function(index, layero) {
                      layer.close(index);
                  }
              });
          }
        ";

        $this->registerJs($js);
        ?>

        <?= $content ?>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- /.content-wrapper -->

    <?php

    $footerHtml = '<footer class="main-footer" style="height:0px;padding:0"></footer>';

    if (isset(\Yii::$app->assetManager->bundles["myzero1\adminlteiframe\assets\php\components\MainAsset"])) {
      if (isset(\Yii::$app->assetManager->bundles["myzero1\adminlteiframe\assets\php\components\MainAsset"]['footer'])) {
        $footerHtml = sprintf(
          '<footer class="main-footer">%s</footer>',
          \Yii::$app->assetManager->bundles["myzero1\adminlteiframe\assets\php\components\MainAsset"]['footer']
        );
      }
    }

    echo $footerHtml;

    ?>

    <?php $this->endBody(); ?>
</body>

</html>
<?php $this->endPage(); ?>