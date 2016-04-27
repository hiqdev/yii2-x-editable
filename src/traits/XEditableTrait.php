<?php

/*
 * X-editable extension for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-x-editable
 * @package   yii2-x-editable
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015-2016, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\xeditable\traits;

use hipanel\helpers\ArrayHelper;
use hiqdev\xeditable\assets\XEditableAsset;
use vova07\select2\Select2Asset;
use Yii;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;

/**
 * Class XEditableTrait.
 */
trait XEditableTrait
{
    /**
     * @var array
     */
    public $pluginOptions = [];

    /**
     * @var string library to be used: bootstrap, jqueryui, plain jquery
     */
    public $library;

    /**
     * @var array will be passed to [[Html::a]] method as options
     */
    public $linkOptions = [];

    public function registerAssets()
    {
        $asset = new XEditableAsset();
        if ($this->library) {
            $asset->library = $this->library;
        }
        $asset->register(Yii::$app->view);
        if ($this->pluginOptions['type'] === 'select2') {
            Select2Asset::register(Yii::$app->view);
        }
    }

    public function init()
    {
        parent::init();
        $this->registerAssets();
    }

    public function registerMyJs($data)
    {
        if (!$this->pluginOptions['title']) {
            $this->pluginOptions['title'] = $data['model']->getAttributeLabel($data['attribute']);
        }
        if ($this->pluginOptions['url']) {
            $this->pluginOptions['url'] = Url::to($this->pluginOptions['url']);
        }
        Yii::$app->view->registerJs('$(".editable[data-name=' . $data['attribute'] . ']").editable(' . Json::htmlEncode($this->pluginOptions) . ');');
    }

    public function prepareValue($data)
    {
        if ($data['value'] !== null) {
            if ($data['value'] instanceof \Closure) {
                $value = call_user_func($data['value'], $this);
            } else {
                $value = $data['value'];
            }
        } else {
            $value = $data['model']->getAttribute($data['attribute']);
            if (is_array($value)) {
                if (ArrayHelper::isAssociative($value)) {
                    $value = array_keys($value);
                }
            } else {
                $value = [$value];
            }
        }

        $this->pluginOptions['value'] = $value;
    }

    protected function prepareDataValue($data)
    {
        if (isset($this->pluginOptions['data-value'])) {
            if ($this->pluginOptions['data-value'] instanceof \Closure) {
                $result = call_user_func($this->pluginOptions['data-value'], $this, $data);
            } else {
                $result = $this->pluginOptions['data-value'];
            }
        } else {
            $result = $this->pluginOptions['value'];
        }

        $this->pluginOptions['data-value'] = $result;
    }

    protected function prepareDisplayValue($data)
    {
        if (isset($this->pluginOptions['data-display-value'])) {
            if ($this->pluginOptions['data-display-value'] instanceof \Closure) {
                $result = call_user_func($this->pluginOptions['data-display-value'], $this, $data);
            } else {
                $result = $this->pluginOptions['data-display-value'];
            }
        } else {
            $result = $this->pluginOptions['value'];
        }

        if (is_array($result)) {
            if ($this->pluginOptions['source']) {
                $result = ArrayHelper::getValues($this->pluginOptions['source'], $result);
            }

            $result = implode('<br />', $result);
        }

        $this->pluginOptions['data-display-value'] = $result;
    }

    public function prepareHtml($data)
    {
        $this->prepareValue($data);
        $this->prepareDataValue($data);
        $this->prepareDisplayValue($data);
        $this->registerMyJs($data);

        $params = ArrayHelper::merge([
            'class' => 'editable',
            'data-pk' => $data['model']->primaryKey,
            'data-name' => $data['attribute'],
            'data-value' => $this->pluginOptions['data-value'],
        ], $this->linkOptions);

        return Html::a($this->pluginOptions['data-display-value'], '#', $params);
    }
}
