<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace myzero1\theme\adminlteiframe\components;

use yii\gii\Generator;
use yii\helpers\Json;

/**
 * @author Xuanwu Qin <myzero1@sina.com>
 * @since 2.0
 */
class Helpers
{

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        $stickyAttributes = $this->model->stickyAttributes();
        if (in_array($this->attribute, $stickyAttributes, true)) {
            $this->sticky();
        }
        $hints = $this->model->hints();
        if (isset($hints[$this->attribute])) {
            $this->hint($hints[$this->attribute]);
        }
        $autoCompleteData = $this->model->autoCompleteData();
        if (isset($autoCompleteData[$this->attribute])) {
            if (is_callable($autoCompleteData[$this->attribute])) {
                $this->autoComplete(call_user_func($autoCompleteData[$this->attribute]));
            } else {
                $this->autoComplete($autoCompleteData[$this->attribute]);
            }
        }
    }
}
