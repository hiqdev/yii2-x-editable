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
use hiqdev\xeditable\traits\XEditableTrait;

/**
 * Class XEditableColumn
 * @package hiqdev\xeditable\grid
 */
class XEditableColumn extends DataColumn
{
    use XEditableTrait;

    /**
     * @inheritdoc
     */
    protected function renderDataCellContent($model, $key, $index)
    {
        return $this->prepareHtml([
            'model'         => $model,
            'attribute'     => $this->attribute,
            'pluginOptions' => $this->pluginOptions,
        ]);
    }
}
