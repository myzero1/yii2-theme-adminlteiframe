<?php

namespace myzero1\adminlteiframe\widgets;

use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\Html;

/**
 * Class Menu
 * Theme menu widget.
 */
class Menu extends \yii\widgets\Menu
{
    /**
     * @inheritdoc
     */
    public $linkTemplate = '<a href="{url}">{icon} {label} {arrow}</a>';

    /**
     * @inheritdoc
     */
    public $submenuTemplate = "\n<ul class='treeview-menu'>\n{items}\n</ul>\n";

    /**
     * @var string Class that will be added for parents "li"
     */
    public $treeClass = 'treeview';

    /**
     * @inheritdoc
     */
    public $activateParents = true;

    /**
     * @inheritdoc
     */
    protected function renderItems($items)
    {
        $requestedRoute = '/'.\Yii::$app->requestedRoute;
        $n = count($items);
        $lines = [];
        foreach ($items as $i => $item) {
            $options = array_merge($this->itemOptions, ArrayHelper::getValue($item, 'options', []));
            $tag = ArrayHelper::remove($options, 'tag', 'li');
            $class = [];
            if (!isset($item['active'])) {
                $item['active'] = $requestedRoute == $item['url'][0];
            }
            if ($item['active']) {
                $class[] = $this->activeCssClass;
            }
            if ($i === 0 && $this->firstItemCssClass !== null) {
                $class[] = $this->firstItemCssClass;
            }
            if ($i === $n - 1 && $this->lastItemCssClass !== null) {
                $class[] = $this->lastItemCssClass;
            }

            $menu = $this->renderItem($item);
            if (!empty($item['children'])) {
                $class[] = $this->treeClass;
                $menu .= strtr($this->submenuTemplate, [
                    '{items}' => $this->renderItems($item['children']),
                ]);
            }

            if (!empty($class)) {
                if (empty($options['class'])) {
                    $options['class'] = implode(' ', $class);
                } else {
                    $options['class'] .= ' ' . implode(' ', $class);
                }
            }

            $lines[] = Html::tag($tag, $menu, $options);
        }
// var_dump($lines);exit;
        return implode("\n", $lines);
    }

    /**
     * @inheritdoc
     */
    protected function renderItem($item)
    {
        if (isset($item['url'])) {
            $template = ArrayHelper::getValue($item, 'template', $this->linkTemplate);

            $replace = !empty($item['icon']) ? [
                '{url}' => Url::to($item['url']),
                '{label}' => $item['text'],
                '{icon}' => '<i class="fa ' . $item['icon'] . '"></i> ',
                '{arrow}' => !empty($item['children']) ? '<i class="fa pull-right fa-angle-left"></i>' : ''
            ] : [
                '{url}' => Url::to($item['url']),
                '{label}' => $item['text'],
                '{icon}' => $item['icon'] !== false ? '<i class="fa fa-angle-double-right"></i>' : '',
                '{arrow}' => !empty($item['children']) ? '<i class="fa pull-right fa-angle-left"></i>' : ''
            ];

            return strtr($template, $replace);
        } else {
            $template = ArrayHelper::getValue($item, 'template', $this->labelTemplate);

            $replace = !empty($item['icon']) ? [
                '{label}' => $item['text'],
                '{icon}' => '<i class="fa ' . $item['icon'] . '"></i> ',
                '{arrow}' => !empty($item['children']) ? '<i class="fa pull-right fa-angle-left"></i>' : ''
            ] : [
                '{label}' => $item['text'],
                '{icon}' => $item['icon'] !== false ? '<i class="fa fa-angle-double-right"></i>' : '',
                '{arrow}' => !empty($item['children']) ? '<i class="fa pull-right fa-angle-left"></i>' : ''
            ];

            return strtr($template, $replace);
        }
    }

    /**
     * @inheritdoc
     */
    protected function normalizeItems($items, &$active)
    {
        $requestedRoute = '/'.\Yii::$app->requestedRoute;
        foreach ($items as $i => $item) {
            if (isset($item['visible']) && !$item['visible']) {
                unset($items[$i]);
                continue;
            }
            if (!isset($item['text'])) {
                $item['text'] = '';
            }
            $encodeLabel = isset($item['encode']) ? $item['encode'] : $this->encodeLabels;
            $items[$i]['label'] = $encodeLabel ? Html::encode($item['text']) : $item['text'];
            $items[$i]['icon'] = isset($item['icon']) ? $item['icon'] : '';
            $hasActiveChild = false;
            if (isset($item['children'])) {
                $items[$i]['items'] = $this->normalizeItems($item['children'], $hasActiveChild);
                if (empty($items[$i]['items']) && $this->hideEmptyItems) {
                    unset($items[$i]['items']);
                    if (!isset($item['url'])) {
                        unset($items[$i]);
                        continue;
                    }
                }
            }
            if (!isset($item['active'])) {
                if ($this->activateParents && $hasActiveChild || $this->activateItems && $this->isItemActive($item)) {
                    $active = $items[$i]['active'] = true;
                } elseif ($requestedRoute == $items[$i]['url'][0]) {
                    $active = $items[$i]['active'] = true;
                } else {
                    $items[$i]['active'] = false;
                }
            } elseif ($item['active']) {
                $active = true;
            }
        }

        return array_values($items);
    }
}