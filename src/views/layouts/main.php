<?php

/**
 * Theme main layout.
 *
 * @var \yii\web\View $this View
 * @var string $content Content
 */

use myzero1app\themes\adminlteiframe\assets\php\AdminlteIframeAsset;
use myzero1app\themes\adminlteiframe\widgets\Alert;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

$bundle = AdminlteIframeAsset::register($this);

$profile = [
    'avatarUrl' => sprintf('%s/img/avatar.png', $bundle->baseUrl),
    'username' => Yii::$app->user->isGuest ? '' : Yii::$app->user->identity->user_name,
    'trueName' => "",
    'lastTime' => Yii::$app->user->identity->last_time,
    'lastIp' => "",
    'profileUrl' => '#',
];

$skin = \Yii::$app->assetManager->bundles['myzero1app\themes\adminlteiframe\assets\php\AdminlteIframeAsset']->skin;

$this->title = Yii::$app->name;

?>

<?= $this->beginPage(); ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <?= $this->render('head') ?>
    </head>
    <body class="<?= $skin ?>">

    <?php $this->beginBody(); ?>

    <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a href="<?= Yii::$app->homeUrl ?>" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <!-- <span class="logo-mini"><?= Yii::$app->name ?></span> -->
                <!-- logo for regular state and mobile devices -->
                <!-- <span class="logo-lg"><?= Yii::$app->name ?></span> -->
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <span class="site-name"><?= Yii::$app->name ?></span>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <!-- <i class="glyphicon glyphicon-user"></i> -->
                                <img src="<?= $profile['avatarUrl'] ?>" class="user-image" alt="User Image">
                                <span class="hidden-xs">
                                    欢迎&nbsp;<span><?= $profile['username'] ?>(管理员)</span>&nbsp;进入系统!&nbsp;&nbsp;
                                    <i class="caret"></i>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <?php if ($profile['avatarUrl']) : ?>
                                        <?= Html::img($profile['avatarUrl'], ['class' => 'img-circle', 'alt' => $profile['username']]) ?>
                                    <?php endif; ?>
                                    <p>
                                        <?php echo $profile['username'] ?>
                                        <small><?= Yii::t('app', '登录时间：') ?> <?= date('Y-m-d H:i:s', $profile['lastTime']) ?></small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        
                                        <a href="#" class="btn btn-default btn-flat list_cu" crud-url="/z1user/user2/change-pw" crud-method="get" crud-data="" win-title="修改密码">修改密码</a>

                                    </div>
                                    <div class="pull-right">
                                        <?php echo Html::beginForm(['/z1user/user/logout'], 'post')
                                            . Html::submitButton(
                                                Yii::t('app', '退出系统'),
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
                <?= $this->render('sidebar-menu') ?>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!--弹出层-->
        <div id="edtskins" style="display:none;width: 300px;">
            <form id="edt_pwd_form">
                <table class="td_view">
                    <tr>
                        <td class="td1">当前密码：</td>
                        <td class="td2">
                            <input type="password"  class="required form-control-me" name="oldpwd" id="oldpwd" >
                        </td>
                    </tr>
                    <tr>
                        <td class="td1">新密码：</td>
                        <td class="td2">
                            <input type="password" class="required form-control-me" id="pwd" name = "pwd" >
                        </td>
                    </tr>
                    <tr>
                        <td class="td1">新密码确认：</td>
                        <td class="td2"><input type="password" class="required form-control-me" id="repwd" name = "repwd" ></td>
                    </tr>
                </table>
            </form>
            <div class="clear"></div>
        </div>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <?php
                $controller = Yii::$app->controller->id;
                $action = Yii::$app->controller->action->id;
                $currentUrl = '/' . $controller . '/' . $action;
                // $menu = \yii\helpers\BaseArrayHelper::getColumn(Yii::$app->params['menu'], 'url');
                $menu = \yii\helpers\BaseArrayHelper::getColumn(Yii::$app->params['menu'], 'url');
                $searchKey = array_search($currentUrl, $menu);
                $icon = $currentUrl == '/site/index' ? 'fa fa-dashboard' : Yii::$app->params['menu'][$searchKey]['icon'];
                $label = $currentUrl == '/site/index' ? Yii::t('app', '首页') : Yii::$app->params['menu'][$searchKey]['label'];
                $url = $currentUrl == '/site/index' ? $currentUrl : "#";
                ?>
                <?= Breadcrumbs::widget(
                    [
                        'homeLink' => [
                            'label' => '<i class="' . $icon . '"></i> ' . $label,
                            'url' => $url
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
    </div>
        <?php $this->endBody(); ?>
    </body>

    </html>
<?php $this->endPage(); ?>