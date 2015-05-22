<?php

namespace hiqdev\xeditable\assets;

use yii\web\AssetBundle;

class XEditableAsset extends AssetBundle
{
    public $sourcePath = '@bower/admin-lte';

    public $css = [
        'plugins/iCheck/all.css',
    ];

    public $js = [
        'plugins/iCheck/icheck.min.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'frontend\assets\AppAsset',
    ];
}