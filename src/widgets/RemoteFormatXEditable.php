<?php
/**
 * X-editable extension for Yii2.
 *
 * @link      https://github.com/hiqdev/yii2-x-editable
 * @package   yii2-x-editable
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015-2017, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\xeditable\widgets;

use hipanel\helpers\ArrayHelper;
use hiqdev\xeditable\assets\RemoteFormatXEditableAsset;
use Yii;

class RemoteFormatXEditable extends XEditable
{
    public function init()
    {
        parent::init();

        $this->pluginOptions = ArrayHelper::merge([
            'type' => 'remoteformat',
        ], $this->pluginOptions);
    }

    public function registerAssets()
    {
        parent::registerAssets();
        RemoteFormatXEditableAsset::register(Yii::$app->view);
    }
}
