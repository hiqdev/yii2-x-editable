<?php

/*
 * X-editable extension for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-x-editable
 * @package   yii2-x-editable
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015, HiQDev (https://hiqdev.com/)
 */

namespace hiqdev\xeditable\assets;

use yii\web\AssetBundle;

class XEditableAsset extends AssetBundle
{
    const LIBRARY_BOOTSTRAP3 = 'bootstrap3';
    const LIBRARY_BOOTSTRAP  = 'bootstrap';
    const LIBRARY_JQUERYUI   = 'jqueryui';
    const LIBRARY_JQUERY     = 'jquery';

    /**
     * @var string library to be used: bootstrap, jqueryui, plain jquery
     */
    public $library = self::LIBRARY_BOOTSTRAP3;

    public $sourcePath = '@bower/x-editable/dist';

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];

    public function registerAssetFiles($view)
    {
        $nodigitLib  = preg_replace('/[0-9]+/', '', $this->library);
        $this->js[]  = $this->library . '-editable/js/' . $nodigitLib . '-editable' . (YII_DEBUG ? '.js' : '.min.js');
        $this->css[] = $this->library . '-editable/css/' . $nodigitLib . '-editable.css';

        parent::registerAssetFiles($view);
    }
}
