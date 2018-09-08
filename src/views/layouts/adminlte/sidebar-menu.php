<?php

/**
 * Sidebar menu layout.
 *
 * @var \yii\web\View $this View
 */

use myzero1app\themes\adminlte\widgets\Menu;

    $items = [
        [
            'label' => Yii::t('app', '平台首页'),
            'url' => Yii::$app->homeUrl,
            'icon' => 'fa-dashboard',
            'active' => Yii::$app->request->url === Yii::$app->homeUrl
        ],
    ];
    
    // if (isset(Yii::$app->params['menu'])) {
    //     $items = Yii::$app->params['menu']();
    // }

    // run the Closure in menu,biggst level is 2
    if (isset(Yii::$app->params['menu'])) {
        $items = Yii::$app->params['menu'];
        foreach ($items as $k => $v) {
            if ($v instanceof Closure) {
                $items[$k] = $items[$k]();
            } else if (is_array($v)) {
                foreach ($v as $k1 => $v1) {
                    if ($v1 instanceof Closure) {
                        $items[$k][$k1] = $items[$k][$k1]();
                    } else if (is_array($v1)) {
                        foreach ($v1 as $k2 => $v2) {
                            if ($v2 instanceof Closure) {
                                $items[$k][$k1][$k2] = $items[$k][$k1][$k2]();
                            } else if (is_array($v2)) {
                                foreach ($v2 as $k3 => $v3) {
                                    if ($v3 instanceof Closure) {
                                        $items[$k][$k1][$k2][$k3] = $items[$k][$k1][$k2][$k3]();
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    

    $sMenuItems = Yii::$app->session->get('aMenuItems');
    if (1||is_null($sMenuItems)) {
        if (isset(Yii::$app->modules['rbacp'])) {
            // var_dump($items);exit;
            $itemsNew = \myzero1\rbacp\components\Rbac::getMenuItems($items);
        } else {
            $itemsNew = $items;
        }
        Yii::$app->session->set('aMenuItems', json_encode($itemsNew));
    } else {
        $itemsNew = json_decode($sMenuItems, TRUE);
    }

    echo Menu::widget(
        [
            'options' => [
                'class' => 'sidebar-menu'
            ],
            // 'items' => Yii::$app->params['menu'],
            'items' => $itemsNew
        ]
    );

    // $menu = [];
    // foreach ($itemsNew as $item) {

    //     if (isset($item['items'])) {
    //         $subItem = $item['items'];

    //         foreach ($subItem as $value) {

    //             array_push($menu, ['url' => $value['url'][0], 'icon' => $item['icon'], 'label' => $item['label']]);
    //         }
    //     }
    // }

    Yii::$app->params['menu'] = $items;

?>