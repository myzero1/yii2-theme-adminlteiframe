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
            'id' => "level1",
            'text' => "level1",
            'title'=>"level1",
            'icon' => "fa fa-dashboard",
            'targetType' => 'iframe-tab',
            'urlType' => 'abosulte',
            'url' => ['/demo/level1'],
        ],
        [
            'id' => "level2",
            'text' => "level2",
            'title'=>"level2",
            'icon' => "fa fa-laptop",
            'url' => ['#'],
            'children' => [
                [
                    'id' => "level21",
                    'text' => "level21",
                    'title'=>"level21",
                    'icon' => "fa fa-angle-double-right",
                    'targetType' => 'iframe-tab',
                    'urlType' => 'abosulte',
                    'url' => ['/demo/level21'],
                ],
                [
                    'id' => "level22",
                    'text' => "level22",
                    'title'=>"level22",
                    'icon' => "fa fa-angle-double-right",
                    'targetType' => 'iframe-tab',
                    'urlType' => 'abosulte',
                    'url' => ['/demo/level22'],
                ],
            ],
        ],
    ],
    'loginedHome' => [
        'id' => "登录后可见页面",
        'title' => "登录后可见页面",
        'close' => false,
        'url' => ['/demo/level1'],
        'urlType' => "abosulte",
    ],
];