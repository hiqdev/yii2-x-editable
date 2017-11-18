<?php
/**
 * X-editable extension for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-x-editable
 * @package   yii2-x-editable
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015-2017, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\xeditable\widgets;

use hipanel\helpers\ArrayHelper;
use hiqdev\combo\Combo;
use hiqdev\xeditable\assets\ComboXEditableAsset;
use Yii;

class ComboXEditable extends XEditable
{
    /**
     * @var array|Combo
     */
    public $combo;

    public function init()
    {
        parent::init();

        if (!($this->combo instanceof Combo)) {
            $this->combo = ArrayHelper::merge([
                'model' => $this->model,
                'attribute' => $this->attribute,
            ], $this->combo);

            $this->combo = Yii::createObject($this->combo);
        }

        $this->combo->registerClientConfig();

        $this->pluginOptions = ArrayHelper::merge([
            'type' => 'combo',
            'placement' => 'bottom',
            'combo' => $this->combo->getPluginOptions(),
            'hash' => $this->combo->configId,
        ], $this->pluginOptions);

        $this->registerAssets();
    }

    public function registerAssets()
    {
        parent::registerAssets();
        ComboXEditableAsset::register(Yii::$app->view);
    }
}
