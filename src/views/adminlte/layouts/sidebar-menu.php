<?php

    /**
     * Sidebar menu layout.
     *
     * @var \yii\web\View $this View
     */

    use myzero1\adminlteiframe\widgets\Menu;
    use yii\helpers\Url;
    use myzero1\rbacp\helper\Helper;

    $menuDefault =  [
        [
            'id' => "Gii首页",
            'text' => "Gii首页",
            'title'=>"Gii首页",
            'icon' => "fa fa-dashboard",
            'targetType' => 'iframe-tab',
            'urlType' => 'abosulte',
            'url' => ['/gii'],
            'isHome' => true,
        ],
        [
            'id' => "Gii",
            'text' => "Gii",
            'title'=>"Gii",
            'icon' => "fa fa-laptop",
            'url' => '#',
            'children' => [
                [
                    'id' => "model",
                    'text' => "model",
                    'title'=>"model",
                    'icon' => "fa fa-angle-double-right",
                    'targetType' => 'iframe-tab',
                    'urlType' => 'abosulte',
                    'url' => ['/gii/model'],
                ],
                [
                    'id' => "crud",
                    'text' => "crud",
                    'title'=>"crud",
                    'icon' => "fa fa-angle-double-right",
                    'targetType' => 'iframe-tab',
                    'urlType' => 'abosulte',
                    'url' => ['/gii/crud'],
                ],
            ],
        ],
    ];

    if (isset($this->context->module->params['menu'])) {
        $menu = $this->context->module->params['menu'];
    } else {
        $menu = $menuDefault;
    }

    echo Menu::widget(
        [
            'options' => [
                'class' => 'sidebar-menu'
            ],
            'items' => $menu
        ]
    );

?>