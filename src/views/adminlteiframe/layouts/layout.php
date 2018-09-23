<?php
    /**
     * Theme main layout.
     *
     * @var \yii\web\View $this View
     * @var string $content Content
     */
    
    use yii\helpers\Html;

    $bundle = myzero1\adminlteiframe\assets\php\components\LayoutAsset::register($this);
    $profile = [
        'avatarUrl' => sprintf('%s/img/myzero1.jpg', $bundle->baseUrl),
        'username' => Yii::$app->user->isGuest ? '' : '管理员',
        'logintype' => Yii::$app->session['logintype'] == 1 ? '员工' : '代理',
        'lastTime' => time(),
        'lastIp' => Yii::$app->request->userIP,
        'profileUrl' => '#',
    ];

    $skin = \Yii::$app->assetManager->bundles['myzero1\adminlteiframe\assets\php\components\LayoutAsset']->skin;
    $menuRefreshTab = \Yii::$app->assetManager->bundles['myzero1\adminlteiframe\assets\php\components\LayoutAsset']->menuRefreshTab;
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
    <body class="hold-transition <?= $skin?> sidebar-mini fixed" menu-refresh-tab="<?= $menuRefreshTab?>">
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
                                    'layer-config' => '{scrollbar:false,area:["350px","340px"],type:2,title:"联系方式",content:"/site/contact",shadeClose:false}',
                                ]); ?>

                            </li>
                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <!-- <i class="glyphicon glyphicon-user"></i> -->
                                    <img src="<?= $profile['avatarUrl'] ?>" class="user-image" alt="User Image">
                                    <span class="hidden-xs">
                                        欢迎&nbsp;<span><?= $profile['username'] ?></span>&nbsp;进入系统!&nbsp;&nbsp;
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
                                                'layer-config' => '{area:["340px","340px"],type:2,title:"修改密码",content:"/site/change-pw",shadeClose:false}',
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
                    <b>Version</b> 1.0.0.0
                </div>
                <strong>Copyright &copy; 2018-2020 <a href="https://github.com/myzero1/yii2-theme-adminlteiframe">Myzero1</a>.</strong> All rights
                reserved.
            </footer>
        </div>
        <?php
            $menuDefault = [
                [
                    'id' => "-1",
                    'text' => "首页",
                    'icon' => "fa fa-dashboard",
                    'targetType' => 'iframe-tab',
                    'urlType' => 'abosulte',
                    'url' => "/site/home",
                    'isHome' => true,
                ],
                // [
                //     'id' => "-2",
                //     'text' => "header",
                //     'icon' => "",
                //     'isHeader' => true,
                // ],
                [
                    'id' => "系统管理",
                    'text' => "系统管理",
                    'icon' => "fa fa-laptop",
                    'items' => [
                        [
                            'id' => "设置页面",
                            'text' => "设置页面",
                            'icon' => "fa fa-circle-o",
                            'targetType' => 'iframe-tab',
                            'urlType' => 'abosulte',
                            'url' => "/site/setting",
                        ],
                    ],
                ],
            ];

            if (isset($this->context->module->params['menu'])) {
                $menu = $this->context->module->params['menu'];
            } else {
                $menu = $menuDefault;
            }

            foreach ($menu as $key=>$item) {
                if (isset($item['items'])) {
                    $menu[$key]['children']=array_values($item['items']);
                }
                unset($menu[$key]['items']);
            }
            $menu=array_values($menu);

            if (count($menu) && isset($menu[0]['isHome']) && $menu[0]['isHome']) {
                $homeMenu = $menu[0];
            } else {
                if (isset($this->context->module->params['welcomeMenu'])) {
                    $homeMenu = $this->context->module->params['welcomeMenu'];
                } else {
                    throw new \yii\web\HttpException(500, '菜单配置错误');
                }
            }
        ?>
        <div id="index-iframe-left-menu" style="height: 0;width: 0;overflow: hidden;">
            <?= json_encode($menu);?>
        </div>
        <div id="index-iframe-home-page" style="height: 0;width: 0;overflow: hidden;">
            <?= json_encode($homeMenu);?>
        </div>
        <?php  $this->endBody() ?>
    </body>
</html>
<?php  $this->endPage() ?>