<?php

/**
 * Sidebar menu layout.
 *
 * @var \yii\web\View $this View
 */

use myzero1\adminlteiframe\widgets\Menu;

$main = require __DIR__ . '/../../../config/main.php';

$menuDefault = $main['menuDefault'];

if (isset($this->context->module->params['menu'])) {
    $menu = $this->context->module->params['menu'];
}
if (isset(\Yii::$app->params['menu'])) {
    $menu = \Yii::$app->params['menu'];
} else {
    $menu = $menuDefault;
}

if (class_exists('\myzero1\rbacp\components\Rbac')) {
    $bootstrapClass = [];
    foreach (Yii::$app->bootstrap as $k => $v) {
        if (is_array($v) && isset($v['class'])) {
            $bootstrapClass[] = $v['class'];
        }
    }
    // $bootstrapClass = array_column(Yii::$app->bootstrap, 'class');
    if (in_array('\myzero1\rbacp\Bootstrap', $bootstrapClass)) {
        $menu = \myzero1\rbacp\components\Rbac::getMenuItems($menu);
    }
}

echo Menu::widget(
    [
        'options' => [
            'class' => 'sidebar-menu'
        ],
        'items' => $menu
    ]
);
