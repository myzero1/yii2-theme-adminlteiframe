<?php

    /**
     * Sidebar menu layout.
     *
     * @var \yii\web\View $this View
     */

    use myzero1\adminlteiframe\widgets\Menu;
    use yii\helpers\Url;
    use myzero1\rbacp\helper\Helper;

    $sUri = \myzero1\rbacp\helper\Helper::getUri();

    // var_dump($sUri);exit;

    $sRbacpModuleName = Helper::getRbacpModuleName();
    $menuDefault = [
        [
            'text' => Yii::t('app', 'rbacp首页'),
            // 'url' => sprintf('/admin/%s/default/index', $sRbacpModuleName),
            'url' => [sprintf('/%s/default/index', $sRbacpModuleName)],
            'icon' => 'fa-dashboard',
            'active' => $sUri === sprintf('%s/%s/default/index', \Yii::$app->homeUrl, $sRbacpModuleName)
        ],
        [
            'text' => Yii::t('app', 'rbacp数据库'),
            'url' => '#',
            'icon' => 'fa-database',
            'items' => [
                [
                    'text' => Yii::t('app', 'rbacp添加数据'),
                    'url' => [sprintf('/%s/default/migrate-up', $sRbacpModuleName)],
                ],
                [
                    'text' => Yii::t('app', 'rbacp删除数据'),
                    'url' => [sprintf('/%s/default/migrate-down', $sRbacpModuleName)],
                ],
            ]
        ],
        [
            'text' => Yii::t('app', 'rbacp权限管理'),
            'url' => '#',
            'icon' => ' fa-cubes',
            'items' => [
                [
                    'text' => Yii::t('app', '角色管理'),
                    'url' => [sprintf('/%s/rbacp-role/index', $sRbacpModuleName)],
                    'active' => in_array($sUri, [
                        sprintf('%s/%s/rbacp-role/index', \Yii::$app->homeUrl, $sRbacpModuleName),
                        sprintf('%s/%s/rbacp-role/create', \Yii::$app->homeUrl, $sRbacpModuleName),
                        sprintf('%s/%s/rbacp-role/update', \Yii::$app->homeUrl, $sRbacpModuleName),
                    ]),
                ],
                [
                    'text' => Yii::t('app', '授权管理'),
                    'url' => [sprintf('/%s/rbacp-user-view/index', $sRbacpModuleName)],
                    'active' => in_array($sUri, [
                        sprintf('%s/%s/rbacp-user-view/index', \Yii::$app->homeUrl, $sRbacpModuleName),
                        sprintf('%s/%s/rbacp-user-view/update', \Yii::$app->homeUrl, $sRbacpModuleName),
                    ]),
                ],
                [
                    'text' => Yii::t('app', '功能权限'),
                    'url' => [sprintf('/%s/rbacp-privilege/index', $sRbacpModuleName)],
                    'active' => in_array($sUri, [
                        sprintf('%s/%s/rbacp-privilege/index', \Yii::$app->homeUrl, $sRbacpModuleName),
                        sprintf('%s/%s/rbacp-privilege/create', \Yii::$app->homeUrl, $sRbacpModuleName),
                        sprintf('%s/%s/rbacp-privilege/update', \Yii::$app->homeUrl, $sRbacpModuleName),
                    ]),
                ],
                [
                    'text' => Yii::t('app', '数据策略'),
                    'url' => [sprintf('/%s/rbacp-policy/index', $sRbacpModuleName)],
                    'active' => in_array($sUri, [
                        sprintf('%s/%s/rbacp-policy/index', \Yii::$app->homeUrl, $sRbacpModuleName),
                        sprintf('%s/%s/rbacp-policy/create', \Yii::$app->homeUrl, $sRbacpModuleName),
                        sprintf('%s/%s/rbacp-policy/update', \Yii::$app->homeUrl, $sRbacpModuleName),
                    ]),
                ],
            ]
        ],
    ];

    if (isset($this->context->module->params['menu'])) {
        $menu = $this->context->module->params['menu'];
    } else {
        $menu = $menuDefault;
    }
    // $menu = $menuDefault;
// var_dump($menu);exit;
    echo Menu::widget(
        [
            'options' => [
                'class' => 'sidebar-menu'
            ],
            'items' => $menu
        ]
    );

?>