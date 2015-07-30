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

class XEditable extends Widget
{
    use XEditableTrait;

    public $value;

    public $model;

    public $attribute;

    public function run()
    {
        return $this->prepareHtml([
            'value'         => $this->value,
            'model'         => $this->model,
            'attribute'     => $this->attribute,
            'pluginOptions' => $this->pluginOptions,
        ]);
    }
}
