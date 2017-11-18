<?php
/**
 * X-editable extension for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-x-editable
 * @package   yii2-x-editable
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015-2017, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\xeditable\assets;

use yii\web\AssetBundle;

class RemoteFormatXEditableAsset extends AssetBundle
{
    public $sourcePath = '@vendor/hiqdev/yii2-x-editable/src';

    public $js = [
        'assets/RemoteFormatXEditable.js',
    ];

    public $depends = [
        'hiqdev\xeditable\assets\XEditableAsset',
    ];
}
