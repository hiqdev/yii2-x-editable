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

use hiqdev\xeditable\traits\XEditableTrait;
use hipanel\grid\DataColumn;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;

class XEditableColumn extends DataColumn
{
    use XEditableTrait;

    public function init()
    {
        parent::init();
        $this->registerAssets();
    }

    /**
     * @inheritdoc
     */
    protected function renderDataCellContent($model, $key, $index)
    {
        $value = parent::renderDataCellContent($model, $key, $index);
        $this->view->registerJs(<<<JS
            jQuery.fn.editable.defaults.params = function(params) {
                var data = {};
                data['{$model->formName()}'] = {};
                data['{$model->formName()}']['id'] = params.pk;
                data['{$model->formName()}']['{$this->attribute}'] = params.value;
                return data;
            }
JS
        );
        $this->registerClientScript();

        return Html::a($value, '#', [
            'data-pk'    => $model->id,
            'data-name'  => $this->attribute,
            'data-value' => $model->{$this->attribute},
            'data-url'   => $this->pluginOptions['url'] ?: \Yii::$app->urlManager->createUrl($_SERVER['REQUEST_URI']),
            'data-type'  => $this->pluginOptions['type'],
            'class'      => 'editable',
        ]);
    }
}
