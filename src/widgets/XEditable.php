<?php

/*
 * X-editable extension for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-x-editable
 * @package   yii2-x-editable
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015, HiQDev (https://hiqdev.com/)
 */

namespace hiqdev\xeditable\widgets;

use hiqdev\xeditable\traits\XEditableTrait;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class XEditable extends Widget
{
    use XEditableTrait;

    public $model = null;

    public $value = null;

    public $attribute;

    private $params = [];

    public function init()
    {
        parent::init();
        $this->registerAssets();
    }

    public function run()
    {
        $this->registerClientScript();
        $this->generateParams();

        return $this->htmlOptions();
    }

    public function htmlOptions()
    {
        return Html::a($this->value ?: $this->model->{$this->attribute}, '#', $this->params);
    }

    private function generateParams()
    {
        $default = [
            'class' => 'editable',
        ];
        if ($this->model) {
            $localParams = [
                'data-type'  => $this->pluginOptions['type'],
                'data-name'  => $this->attribute,
                'data-pk'    => $this->model->id,
                'data-value' => $this->model->{$this->attribute},
                'data-title' => $this->model->getAttributeLabel($this->attribute),
            ];
        } else {
            $localParams = [
                'data-type' => $this->pluginOptions['type'],
                'data-name' => $this->attribute,
                'data-pk'   => $this->id,
            ];
        }
        $this->params = ArrayHelper::merge($default, $localParams);
    }
}
