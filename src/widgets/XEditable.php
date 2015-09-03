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
use yii\base\Model;
use yii\base\Widget;

class XEditable extends Widget
{
    use XEditableTrait;

    /**
     * @var
     */
    public $value;

    /**
     * @var Model
     */
    public $model;

    /**
     * @var string attribute name
     */
    public $attribute;

    /**
     * @var string model scenario
     */
    public $scenario;

    public function init()
    {
        parent::init();
        $this->registerAssets();
        if ($this->scenario === null) {
            $this->scenario = $this->model->scenario;
        }
        $oldScenario = $this->model->scenario;
        $this->model->scenario = $this->scenario;
        $this->pluginOptions['url'] = (isset($this->pluginOptions['url']) && mb_strlen($this->pluginOptions['url'])) ? : $this->model->scenario;
        $this->model->scenario = $oldScenario;
    }

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
