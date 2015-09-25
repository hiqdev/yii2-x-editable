<?php

/*
 * X-editable extension for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-x-editable
 * @package   yii2-x-editable
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015, HiQDev (https://hiqdev.com/)
 */

namespace hiqdev\xeditable\grid;

use hipanel\grid\DataColumn;
use hipanel\helpers\ArrayHelper;
use hiqdev\xeditable\widgets\XEditable;
use Yii;

/**
 * Class XEditableColumn
 * @package hiqdev\xeditable\grid
 */
class XEditableColumn extends DataColumn
{
    /**
     * @var array options that will be passed to X-Editable widget
     */
    public $pluginOptions = [];

    /**
     * @var array
     */
    public $widgetOptions = [];

    /**
     * @inheritdoc
     */
    protected function renderDataCellContent($model, $key, $index)
    {
        return Yii::createObject(ArrayHelper::merge([
            'class' => XEditable::className(),
            'model' => $model,
            'attribute' => $this->attribute,
            'pluginOptions' => $this->pluginOptions
        ], $this->widgetOptions))->run();
    }
}
