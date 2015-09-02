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

class ComboXEditableAsset extends AssetBundle
{
    public $sourcePath = '@vendor/hiqdev/yii2-x-editable/src';

    public $js = [
        'assets/ComboXEditable.js'
    ];

    public $depends = [
        'hiqdev\xeditable\assets\XEditableAsset',
    ];
}
