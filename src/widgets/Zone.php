<?php

namespace myzero1app\themes\adminlte\widgets;

/**
 * Zone widget renders this zones.
 *
 * @author qinxuanwu
 */
class Zone extends \yii\bootstrap\Widget
{
    public $zones = [];
    public $options = [
        'name' => 'zone',
        'class' => 'input-md form-control-me',
        'style' => 'font-size: 12px;',
        '$selected' => '',
    ];

    /**
     * @var Model the data model that this widget is associated with.
     */
    public $model;
    /**
     * @var string the model attribute that this widget is associated with.
     */
    public $attribute;
    /**
     * @var string the input name. This must be set if [[model]] and [[attribute]] are not set.
     */
    public $name;
    /**
     * @var string the input value.
     */
    public $value;


    /**
     * Initializes the widget.
     * If you override this method, make sure you call the parent implementation first.
     */
    public function init()
    {
        if ($this->hasModel() && !isset($this->options['id'])) {
            $this->options['id'] = Html::getInputId($this->model, $this->attribute);
        }
        parent::init();
    }

    /**
     * @return bool whether this widget is associated with a data model.
     */
    protected function hasModel()
    {
        return $this->model instanceof Model && $this->attribute !== null;
    }

    public function run()
    {
        $sSelect = sprintf(
            '<select class="%s" style="%s" name="%s">', 
            $this->options['class'],
            $this->options['style'],
            $this->options['name']
        );

        foreach ($this->zones as $key => $zone) {
            $sSelect .= sprintf(
                '<option value="%d">%s</option>', 
                $zone['area_id'], 
                sprintf(
                    '%s%s', 
                    str_repeat('|--', intval($zone['level'])), 
                    $zone['area_name']
                )
            );
        }

        $sSelect .= '</select>';

        echo $sSelect;
    }
}