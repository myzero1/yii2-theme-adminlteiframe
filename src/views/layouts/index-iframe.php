<?php

/**
 * Theme main layout.
 *
 * @var \yii\web\View $this View
 * @var string $content Content
 */

use myzero1\theme\adminlteiframe\assets\php\components\IndexIframeAsset;
use yii\helpers\Html;

myzero1\theme\adminlteiframe\giimodal\GiiAsset::register($this);

$bundle = IndexIframeAsset::register($this);
// var_dump(Yii::$app->user->identity);exit;
$profile = [
    'avatarUrl' => sprintf('%s/img/avatar-default.png', $bundle->baseUrl),
    // 'username' => Yii::$app->user->isGuest ? '' : Yii::$app->user->identity->user_name,
    'username' => Yii::$app->session['logintype'] == 1 ? Yii::$app->session['staffname'] : Yii::$app->user->identity->username,
    'trueName' => "",
    'logintype' => Yii::$app->session['logintype'] == 1 ? '员工' : '代理',
    // 'lastTime' => Yii::$app->user->identity->last_time,
    'lastTime' => '14465435135',
    'lastIp' => "",
    'profileUrl' => '#',
];

$skin = \Yii::$app->assetManager->bundles['myzero1\theme\adminlteiframe\assets\php\components\IndexIframeAsset']->skin;

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

    <!--http://aimodu.org:7777/admin/index_iframe.html?q=audio&search=#-->
    <style type="text/css">
        html {
            overflow: hidden;
        }
    </style>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="../plugins/ie9/html5shiv.min.js"></script>
    <script src="../plugins/ie9/respond.min.js"></script>
    <![endif]-->

    <?php  $this->head() ?>
</head>



<body class="hold-transition skin-blue sidebar-mini fixed">
<?php  $this->beginBody() ?>
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="<?=Yii::$app->defaultRoute?>" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b><?=\Yii::$app->name?></b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b><?=\Yii::$app->name?></b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <?= Html::a('联系方式', '#', [
                            'class' => 'adminlteiframe-modal use-layer',
                            'layer-config' => '{type:2,title:"修改密码",content:"/site/contact",shadeClose:false}',
                        ]); ?>

                    </li>
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- <i class="glyphicon glyphicon-user"></i> -->
                            <img src="<?= $profile['avatarUrl'] ?>" class="user-image" alt="User Image">
                            <span class="hidden-xs">
                                欢迎&nbsp;<span><?= $profile['username'] ?>(<?= $profile['logintype']?>)</span>&nbsp;进入系统!&nbsp;&nbsp;
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
                                    <?= Html::a('修改密码', "#", [
                                        'class' => 'use-layer btn btn-default btn-flat adminlteiframe-modal show-modal',
                                        'layer-config' => '{type:2,title:"修改密码",content:"/site/change-pw",shadeClose:false}',
                                    ]); ?>

                                </div>
                                <div class="pull-right">
                                    <?php echo Html::beginForm(['/site/logout'], 'post')
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
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
            </div>
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <!--<li class="header">MAIN NAVIGATION</li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="../index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
                        <li><a href="../index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-files-o"></i>
                        <span>Layout Options</span>
                        <span class="pull-right-container">
              <span class="label label-primary pull-right">4</span>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="layout/top-nav.html"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
                        <li><a href="layout/boxed.html"><i class="fa fa-circle-o"></i> Boxed</a></li>
                        <li><a href="layout/fixed.html"><i class="fa fa-circle-o"></i> Fixed</a></li>
                        <li><a href="layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a>
                        </li>
                    </ul>
                </li>
                <li class="active">
                    <a href="widgets.html">
                        <i class="fa fa-th"></i> <span>Widgets</span>
                        <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span>
                    </a>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-pie-chart"></i>
                        <span>Charts</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="charts/chartjs.html"><i class="fa fa-circle-o"></i> ChartJS</a></li>
                        <li><a href="charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a></li>
                        <li><a href="charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a></li>
                        <li><a href="charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-laptop"></i>
                        <span>UI Elements</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="UI/general.html"><i class="fa fa-circle-o"></i> General</a></li>
                        <li><a href="UI/icons.html"><i class="fa fa-circle-o"></i> Icons</a></li>
                        <li><a href="UI/buttons.html"><i class="fa fa-circle-o"></i> Buttons</a></li>
                        <li><a href="UI/sliders.html"><i class="fa fa-circle-o"></i> Sliders</a></li>
                        <li><a href="UI/timeline.html"><i class="fa fa-circle-o"></i> Timeline</a></li>
                        <li><a href="UI/modals.html"><i class="fa fa-circle-o"></i> Modals</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-edit"></i> <span>Forms</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="forms/general.html"><i class="fa fa-circle-o"></i> General Elements</a></li>
                        <li><a href="forms/advanced.html"><i class="fa fa-circle-o"></i> Advanced Elements</a></li>
                        <li><a href="forms/editors.html"><i class="fa fa-circle-o"></i> Editors</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-table"></i> <span>Tables</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="tables/simple.html"><i class="fa fa-circle-o"></i> Simple tables</a></li>
                        <li><a href="tables/data.html"><i class="fa fa-circle-o"></i> Data tables</a></li>
                    </ul>
                </li>
                <li>
                    <a href="calendar.html">
                        <i class="fa fa-calendar"></i> <span>Calendar</span>
                        <span class="pull-right-container">
              <small class="label pull-right bg-red">3</small>
              <small class="label pull-right bg-blue">17</small>
            </span>
                    </a>
                </li>
                <li>
                    <a href="mailbox/mailbox.html">
                        <i class="fa fa-envelope"></i> <span>Mailbox</span>
                        <span class="pull-right-container">
              <small class="label pull-right bg-yellow">12</small>
              <small class="label pull-right bg-green">16</small>
              <small class="label pull-right bg-red">5</small>
            </span>
                    </a>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-folder"></i> <span>Examples</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="examples/invoice.html"><i class="fa fa-circle-o"></i> Invoice</a></li>
                        <li><a href="examples/profile.html"><i class="fa fa-circle-o"></i> Profile</a></li>
                        <li><a href="examples/login.html"><i class="fa fa-circle-o"></i> Login</a></li>
                        <li><a href="examples/register.html"><i class="fa fa-circle-o"></i> Register</a></li>
                        <li><a href="examples/lockscreen.html"><i class="fa fa-circle-o"></i> Lockscreen</a></li>
                        <li><a href="examples/404.html"><i class="fa fa-circle-o"></i> 404 Error</a></li>
                        <li><a href="examples/500.html"><i class="fa fa-circle-o"></i> 500 Error</a></li>
                        <li><a href="examples/blank.html"><i class="fa fa-circle-o"></i> Blank Page</a></li>
                        <li><a href="examples/pace.html"><i class="fa fa-circle-o"></i> Pace Page</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-share"></i> <span>Multilevel</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
                        <li>
                            <a href="#"><i class="fa fa-circle-o"></i> Level One
                                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                                <li>
                                    <a href="#"><i class="fa fa-circle-o"></i> Level Two
                                        <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                                        <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
                    </ul>
                </li>
                <li><a href="../documentation/index.html"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
                <li class="header">LABELS</li>
                <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
                <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
                <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>-->
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" id="content-wrapper" style="min-height: 421px;">
        <!--bootstrap tab风格 多标签页-->
        <div class="content-tabs">
            <button class="roll-nav roll-left tabLeft" onclick="scrollTabLeft()">
                <i class="fa fa-backward"></i>
            </button>
            <nav class="page-tabs menuTabs tab-ui-menu" id="tab-menu">
                <div class="page-tabs-content" style="margin-left: 0px;">

                </div>
            </nav>
            <button class="roll-nav roll-right tabRight" onclick="scrollTabRight()">
                <i class="fa fa-forward" style="margin-left: 3px;"></i>
            </button>
            <div class="btn-group roll-nav roll-right">
                <button class="dropdown tabClose" data-toggle="dropdown">
                    页签操作<i class="fa fa-caret-down" style="padding-left: 3px;"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-right" style="min-width: 128px;">
                    <li><a class="tabReload" href="javascript:refreshTab();">刷新当前</a></li>
                    <li><a class="tabCloseCurrent" href="javascript:closeCurrentTab();">关闭当前</a></li>
                    <li><a class="tabCloseAll" href="javascript:closeOtherTabs(true);">全部关闭</a></li>
                    <li><a class="tabCloseOther" href="javascript:closeOtherTabs();">除此之外全部关闭</a></li>
                </ul>
            </div>
            <button class="roll-nav roll-right fullscreen" onclick="App.handleFullScreen()"><i
                    class="fa fa-arrows-alt"></i></button>
        </div>
        <div class="content-iframe " style="background-color: #ffffff; ">
            <div class="tab-content " id="tab-content">

            </div>
        </div>
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.3.8
        </div>
        <strong>Copyright &copy; 2014-2016 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights
        reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
            <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <!-- Home tab content -->
            <div class="tab-pane" id="control-sidebar-home-tab">
                <h3 class="control-sidebar-heading">Recent Activity</h3>
                <ul class="control-sidebar-menu">
                    <li>
                        <a href="javascript:void(0)">
                            <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                                <p>Will be 23 on April 24th</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <i class="menu-icon fa fa-user bg-yellow"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                                <p>New phone +1(800)555-1234</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                                <p>nora@example.com</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <i class="menu-icon fa fa-file-code-o bg-green"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                                <p>Execution time 5 seconds</p>
                            </div>
                        </a>
                    </li>
                </ul>
                <!-- /.control-sidebar-menu -->

                <h3 class="control-sidebar-heading">Tasks Progress</h3>
                <ul class="control-sidebar-menu">
                    <li>
                        <a href="javascript:void(0)">
                            <h4 class="control-sidebar-subheading">
                                Custom Template Design
                                <span class="label label-danger pull-right">70%</span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <h4 class="control-sidebar-subheading">
                                Update Resume
                                <span class="label label-success pull-right">95%</span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <h4 class="control-sidebar-subheading">
                                Laravel Integration
                                <span class="label label-warning pull-right">50%</span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <h4 class="control-sidebar-subheading">
                                Back End Framework
                                <span class="label label-primary pull-right">68%</span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                            </div>
                        </a>
                    </li>
                </ul>
                <!-- /.control-sidebar-menu -->

            </div>
            <!-- /.tab-pane -->
            <!-- Stats tab content -->
            <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
            <!-- /.tab-pane -->
            <!-- Settings tab content -->
            <div class="tab-pane" id="control-sidebar-settings-tab">
                <form method="post">
                    <h3 class="control-sidebar-heading">General Settings</h3>

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Report panel usage
                            <input type="checkbox" class="pull-right" checked>
                        </label>

                        <p>
                            Some information about this general settings option
                        </p>
                    </div>
                    <!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Allow mail redirect
                            <input type="checkbox" class="pull-right" checked>
                        </label>

                        <p>
                            Other sets of options are available
                        </p>
                    </div>
                    <!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Expose author name in posts
                            <input type="checkbox" class="pull-right" checked>
                        </label>

                        <p>
                            Allow the user to show his name in blog posts
                        </p>
                    </div>
                    <!-- /.form-group -->

                    <h3 class="control-sidebar-heading">Chat Settings</h3>

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Show me as online
                            <input type="checkbox" class="pull-right" checked>
                        </label>
                    </div>
                    <!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Turn off notifications
                            <input type="checkbox" class="pull-right">
                        </label>
                    </div>
                    <!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Delete chat history
                            <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                        </label>
                    </div>
                    <!-- /.form-group -->
                </form>
            </div>
            <!-- /.tab-pane -->
        </div>
    </aside>
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>

<div id='index-iframe-home' style="height: 0;width: 0;overflow: hidden;">
    
</div>

<div id="index-iframe-left-menu" style="height: 0;width: 0;overflow: hidden;">
<?php 
    // run the Closure in menu,biggst level is 2
    $id = 0;
    if (isset(Yii::$app->params['menu'])) {
        $items = Yii::$app->params['menu'];
        foreach ($items as $k => $v) {
            if ($v instanceof Closure) {
                $items[$k] = $items[$k]();
            } else if ($k ==='url'){
                $items[$k] = yii\helpers\Url::to($v);
            } else if ($k ==='text'){
                if (!isset($items['targetType'])) {
                    $items['targetType'] = "iframe-tab";
                    $items['id'] = ++$id;
                }
            } else if (is_array($v)) {
                foreach ($v as $k1 => $v1) {
                    if ($v1 instanceof Closure) {
                        $items[$k][$k1] = $items[$k][$k1]();
                    } else if ($k1 ==='url'){
                        $items[$k][$k1] = yii\helpers\Url::to($v1);
                    } else if ($k1 ==='text'){
                        if (!isset($items[$k]['targetType'])) {
                            $items[$k]['targetType'] = "iframe-tab";
                            $items[$k]['id'] = ++$id;
                            $items[$k]['urlType'] = "abosulte";
                        }
                    } else if (is_array($v1)) {
                        foreach ($v1 as $k2 => $v2) {
                            if ($v2 instanceof Closure) {
                                $items[$k][$k1][$k2] = $items[$k][$k1][$k2]();
                            } else if ($k2 ==='url'){
                                $items[$k][$k1][$k2] = yii\helpers\Url::to($v2);
                            } else if ($k2 ==='text'){
                                if (!isset($items[$k][$k1]['targetType'])) {
                                    $items[$k][$k1]['targetType'] = "iframe-tab";
                                    $items[$k][$k1]['id'] = ++$id;
                                    $items[$k][$k1]['urlType'] = "abosulte";
                                }
                            } else if (is_array($v2)) {
                                foreach ($v2 as $k3 => $v3) {
                                    if ($v3 instanceof Closure) {
                                        $items[$k][$k1][$k2][$k3] = $items[$k][$k1][$k2][$k3]();
                                    } else if ($k3 ==='url'){
                                        $items[$k][$k1][$k2][$k3] = yii\helpers\Url::to($v3);
                                    } else if ($k3 ==='text'){
                                        if (!isset($items[$k][$k1][$k2]['targetType'])) {
                                            $items[$k][$k1][$k2]['targetType'] = "iframe-tab";
                                            $items[$k][$k1][$k2]['id'] = ++$id;
                                            $items[$k][$k1][$k2]['urlType'] = "abosulte";
                                        }
                                    } else if (is_array($v3)) {
                                        foreach ($v3 as $k4 => $v4) {
                                            if ($v4 instanceof Closure) {
                                                $items[$k][$k1][$k2][$k3][$k4] = $items[$k][$k1][$k2][$k3][$k4]();
                                            } else if ($k4 ==='url'){
                                                $items[$k][$k1][$k2][$k3][$k4] = yii\helpers\Url::to($v4);
                                            } else if ($k4 ==='text'){
                                                if (!isset($$items[$k][$k1][$k2][$k3]['targetType'])) {
                                                    $$items[$k][$k1][$k2][$k3]['targetType'] = "iframe-tab";
                                                    $$items[$k][$k1][$k2][$k3]['id'] = ++$id;
                                                    $$items[$k][$k1][$k2][$k3]['urlType'] = "abosulte";
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
// var_dump($items);exit;
    echo '[
            {
                id: "9000",
                text: "header",
                icon: "",
                isHeader: true
            },
            {
                id: "9003",
                text: "用户管理",
                url: "/user2/index",
                targetType: "iframe-tab",
                icon: "fa fa-circle-o",
                urlType: "abosulte"
            },
            {
                id: "9002",
                text: "Forms",
                icon: "fa fa-edit",
                children: [
                    {
                        id: "90021",
                        text: "user2",
                        url: "/user2/index",
                        targetType: "iframe-tab",
                        icon: "fa fa-circle-o",
                        urlType: "abosulte"
                    },
                    {
                        id: "90022",
                        text: "general",
                        url: "forms/general_iframe.html",
                        targetType: "iframe-tab",
                        icon: "fa fa-circle-o",
                        urlType: "abosulte"
                    },
                    {
                        id: "90024",
                        text: "百度",
                        url: "https://www.baidu.com",
                        targetType: "iframe-tab",
                        icon: "fa fa-circle-o",
                        urlType: "abosulte"
                    }
                ]
            }
        ]';
    // echo json_encode($items);
?>
</div>

<div id="index-iframe-home-page" style="height: 0;width: 0;overflow: hidden;">
<?php
    echo '{
        id: "-1",
        title: "欢迎页",
        close: false,
        url: "/user2/view?id=1",
        urlType: "abosulte"
    }';
?>

</div>

<?php  $this->endBody() ?>
</body>

</html>
<?php  $this->endPage() ?>


<?= yii\bootstrap\Modal::widget([
    'id' => 'modal_view_out',
]); ?>