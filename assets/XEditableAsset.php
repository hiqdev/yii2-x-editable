<?php

namespace hiqdev\xeditable\assets;

use yii\web\AssetBundle;

class XEditableAsset extends AssetBundle
{
    const FORM_BOOTSTRAP3 = 'bootstrap3';
    const FORM_BOOTSTRAP = 'bootstrap';
    const FORM_JQUERY = 'jquery';
    const FORM_JQUERYUI = 'jqueryui';
    /**
     * @var string editable form engine: bootstrap, jqueryui, plain
     */
    public $form = self::FORM_BOOTSTRAP3;
    /**
     * @var string editable container type: popup or inline
     */
    public $mode = self::MODE_POPUP;

    public $sourcePath = '@bower/x-editable/dist';

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];

    public function registerAssetFiles($view)
    {
        $withoutDigitFormName = preg_replace('/[0-9]+/', '', $this->form);
        $this->js[] = $this->form . '-editable/js/' . $withoutDigitFormName . '-editable' . (YII_DEBUG ? '.js' : '.min.js');
        $this->css[] = $this->form . '-editable/css/' . $withoutDigitFormName . '-editable.css';

        parent::registerAssetFiles($view);
    }
}