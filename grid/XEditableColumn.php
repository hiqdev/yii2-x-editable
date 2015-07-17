<?php
namespace hiqdev\xeditable\grid;

use hiqdev\xeditable\assets\XEditableAsset;
use hiqdev\xeditable\traits\XEditableTrait;
use yii\grid\DataColumn;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
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
    protected function getDataCellContent($model, $key, $index)
    {
        if (empty($this->value)) {
            $value = ArrayHelper::getValue($model, $this->attribute);
        } else {
            $value = call_user_func($this->value, $model, $index, $this);
        }
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
            'data-pk' => $model->id,
            'data-name' => $this->attribute,
            'data-value' => $model->{$this->attribute},
            'data-url' => $this->pluginOptions['url'] ? : \Yii::$app->urlManager->createUrl($_SERVER['REQUEST_URI']),
            'data-type' => $this->pluginOptions['type'],
            'class' => 'editable'
        ]);
    }

    /**
     * @inheritdoc
     */
    protected function renderDataCellContent($model, $key, $index)
    {
        return $this->grid->formatter->format($this->getDataCellContent($model, $key, $index), $this->format);
    }
}