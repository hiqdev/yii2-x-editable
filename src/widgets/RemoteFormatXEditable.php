<?php

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

    public function registerAssets() {
        parent::registerAssets();
        RemoteFormatXEditableAsset::register(Yii::$app->view);
    }
}