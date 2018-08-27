<?php

/**
 * Theme main layout.
 *
 * @var \yii\web\View $this View
 * @var string $content Content
 */

use myzero1app\themes\layuiadmin\assets\php\ThemingAsset;
use yii\helpers\Html;

$bundle = ThemingAsset::register($this);


$this->title = Yii::$app->name;

$profile = [
    'avatarUrl' => sprintf('%s/images/avatar.png', $bundle->baseUrl),
    'username' => Yii::$app->user->isGuest ? '' : Yii::$app->user->identity->user_name,
    'trueName' => "",
    'lastTime' => Yii::$app->user->identity->last_time,
    'lastIp' => "",
    'profileUrl' => '#',
];

$skin = \Yii::$app->assetManager->bundles['myzero1app\themes\layuiadmin\assets\php\ThemingAsset']->skin;
$showTopNav = \Yii::$app->assetManager->bundles['myzero1app\themes\layuiadmin\assets\php\ThemingAsset']->showTopNav;

$homeMenu = \Yii::$app->params['menu']['backend_home'][0];

?>

<?= $this->beginPage(); ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <?= $this->render('head') ?>
    </head>
    <body class="main_body <?php echo $skin;?>">

        <?php $this->beginBody(); ?>

        <div class="layui-layout layui-layout-admin">
            <!-- 顶部 -->
            <div class="layui-header header">
                <div class="layui-main mag0">
                    <a href="#" class="logo"><?=\Yii::$app->name?></a>
                    <!-- 显示/隐藏菜单 -->
                    <a href="javascript:;" class="seraph hideMenu icon-caidan"></a>
                    <?php if ($showTopNav) { ?>
                    <!-- 顶级菜单 -->
                    <ul class="layui-nav mobileTopLevelMenus" mobile>
                        <li class="layui-nav-item" data-menu="contentManagement">
                            <a href="javascript:;"><i class="seraph icon-caidan"></i><cite>layuiCMS</cite></a>
                            <dl class="layui-nav-child">
                                <dd class="layui-this" data-menu="contentManagement"><a href="javascript:;"><i class="layui-icon" data-icon="&#xe63c;">&#xe63c;</i><cite>内容管理</cite></a></dd>
                                <dd data-menu="memberCenter"><a href="javascript:;"><i class="seraph icon-icon10" data-icon="icon-icon10"></i><cite>用户中心</cite></a></dd>
                                <dd data-menu="systemeSttings"><a href="javascript:;"><i class="layui-icon" data-icon="&#xe620;">&#xe620;</i><cite>系统设置</cite></a></dd>
                                <dd data-menu="seraphApi"><a href="javascript:;"><i class="layui-icon" data-icon="&#xe705;">&#xe705;</i><cite>使用文档</cite></a></dd>
                            </dl>
                        </li>
                    </ul>
                    <ul class="layui-nav topLevelMenus" pc>
                        <li class="layui-nav-item layui-this" data-menu="contentManagement">
                            <a href="javascript:;"><i class="layui-icon" data-icon="&#xe63c;">&#xe63c;</i><cite>内容管理</cite></a>
                        </li>
                        <li class="layui-nav-item" data-menu="memberCenter" pc>
                            <a href="javascript:;"><i class="seraph icon-icon10" data-icon="icon-icon10"></i><cite>用户中心</cite></a>
                        </li>
                        <li class="layui-nav-item" data-menu="systemeSttings" pc>
                            <a href="javascript:;"><i class="layui-icon" data-icon="&#xe620;">&#xe620;</i><cite>系统设置</cite></a>
                        </li>
                        <li class="layui-nav-item" data-menu="seraphApi" pc>
                            <a href="javascript:;"><i class="layui-icon" data-icon="&#xe705;">&#xe705;</i><cite>使用文档</cite></a>
                        </li>
                    </ul>
                    <?php } ?>
                    <!-- 顶部右侧菜单 -->
                    <ul class="layui-nav top_menu">
                        <li class="layui-nav-item" pc>
                            <a href="javascript:;" class="clearCache"><i class="layui-icon" data-icon="&#xe640;">&#xe640;</i><cite>清除缓存</cite><span class="layui-badge-dot"></span></a>
                        </li>
                        <li class="layui-nav-item" id="userInfo">
                            <a href="javascript:;"><img src="<?=$profile['avatarUrl']?>" class="layui-nav-img userAvatar" width="35" height="35"><cite class="adminName"><?=$profile['username']?></cite></a>
                            <dl class="layui-nav-child">
                                <dd>
                                    <a href="javascript:;" data-url="page/user/userInfo.html">
                                        <i class="seraph icon-ziliao" data-icon="icon-ziliao"></i>
                                        <cite>个人资料</cite>
                                    </a>
                                </dd>
                                <dd>
                                    <a href="javascript:;" data-url="page/user/changePwd.html">
                                        <i class="seraph icon-xiugai" data-icon="icon-xiugai"></i>
                                        <cite>修改密码</cite>
                                    </a>
                                </dd>
                                <dd>
                                    <a href="page/login/login.html" class="signOut">
                                        <i class="seraph icon-tuichu"></i>
                                        <cite>退出</cite>
                                    </a>
                                </dd>
                            </dl>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- 左侧导航 -->
            <div class="layui-side layui-bg-black">
                <div class="user-photo">
                    <p>你好！<span class="userName"><?=$profile['username']?></span>, 欢迎登录</p>
                </div>
                <div class="navBar layui-side-scroll" id="navBar">
                    <ul class="layui-nav layui-nav-tree">
                        <li class="layui-nav-item layui-this">
                            <a href="javascript:;" data-url="<?=yii\helpers\Url::to($homeMenu['url'])?>"><i class="<?=$homeMenu['icon']?>" data-icon="<?=$homeMenu['icon']?>"></i><cite><?=$homeMenu['label']?></cite></a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- 右侧内容 -->
            <div class="layui-body layui-form">
                <div class="layui-tab mag0" lay-filter="bodyTab" id="top_tabs_box">
                    <ul class="layui-tab-title top_tab" id="top_tabs">
                        <li class="layui-this" lay-id=""><i class="<?=$homeMenu['icon']?>"></i><cite><?=$homeMenu['label']?></cite></li>
                    </ul>
                    <ul class="layui-nav closeBox">
                      <li class="layui-nav-item">
                        <a href="javascript:;"><i class="layui-icon caozuo">&#xe643;</i> 页面操作</a>
                        <dl class="layui-nav-child">
                          <dd><a href="javascript:;" class="refresh refreshThis"><i class="layui-icon">&#x1002;</i> 刷新当前</a></dd>
                          <dd><a href="javascript:;" class="closePageOther"><i class="seraph icon-prohibit"></i> 关闭其他</a></dd>
                          <dd><a href="javascript:;" class="closePageAll"><i class="seraph icon-guanbi"></i> 关闭全部</a></dd>
                        </dl>
                      </li>
                    </ul>
                    <div class="layui-tab-content clildFrame">
                        <div class="layui-tab-item layui-show">
                            <iframe src="<?=yii\helpers\Url::to($homeMenu['url'])?>"></iframe>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 底部 -->
            <div class="layui-footer footer">
                <p><span><?=\Yii::$app->name?></span></p>
            </div>
        </div>

        <!-- 移动导航 -->
        <div class="site-tree-mobile"><i class="layui-icon">&#xe602;</i></div>
        <div class="site-mobile-shade"></div>
        <div id="nav-data" style="height: 0;width: 0;overflow: hidden;">
            <?php 

                // run the Closure in menu,biggst level is 2
                if (isset(Yii::$app->params['menu'])) {
                    $items = Yii::$app->params['menu'];
                    foreach ($items as $k => $v) {
                        if ($v instanceof Closure) {
                            $items[$k] = $items[$k]();
                        } else if ($k ==='url'){
                            $items[$k] = yii\helpers\Url::to($v);
                        } else if (is_array($v)) {
                            foreach ($v as $k1 => $v1) {
                                if ($v1 instanceof Closure) {
                                    $items[$k][$k1] = $items[$k][$k1]();
                                } else if ($k1 ==='url'){
                                    $items[$k][$k1] = yii\helpers\Url::to($v1);
                                } else if (is_array($v1)) {
                                    foreach ($v1 as $k2 => $v2) {
                                        if ($v2 instanceof Closure) {
                                            $items[$k][$k1][$k2] = $items[$k][$k1][$k2]();
                                        } else if ($k2 ==='url'){
                                            $items[$k][$k1][$k2] = yii\helpers\Url::to($v2);
                                        } else if (is_array($v2)) {
                                            foreach ($v2 as $k3 => $v3) {
                                                if ($v3 instanceof Closure) {
                                                    $items[$k][$k1][$k2][$k3] = $items[$k][$k1][$k2][$k3]();
                                                } else if ($k3 ==='url'){
                                                    var_dump($v3);exit;
                                                    $items[$k][$k1][$k2][$k3] = yii\helpers\Url::to($v3);
                                                } else if (is_array($v3)) {
                                                    foreach ($v3 as $k4 => $v4) {
                                                        if ($v4 instanceof Closure) {
                                                            $items[$k][$k1][$k2][$k3][$k4] = $items[$k][$k1][$k2][$k3][$k4]();
                                                        } else if ($k4 ==='url'){
                                                            $items[$k][$k1][$k2][$k3][$k4] = yii\helpers\Url::to($v4);
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

                echo json_encode($items)
            ?>
            </div>
        <?php $this->endBody(); ?>
    </body>

    </html>
<?php $this->endPage(); ?>