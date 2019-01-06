<?php
return [
    'menuDefault' => [
        [
            'id' => "平台首页",
            'text' => "平台首页",
            'title'=>"平台首页",
            'icon' => "fa fa-dashboard",
            'targetType' => 'iframe-tab',
            'urlType' => 'abosulte',
            'url' => ['/site/index'],
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
    ],
    'loginedHome' => [
        'id' => "登录后可见页面",
        'title' => "登录后可见页面",
        'close' => false,
        'url' => ['/gii/extension'],
        'urlType' => "abosulte",
    ]
];