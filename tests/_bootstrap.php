<?php
/**
 * X-editable extension for Yii2.
 *
 * @link      https://github.com/hiqdev/yii2-x-editable
 * @package   yii2-x-editable
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015-2017, HiQDev (http://hiqdev.com/)
 */

error_reporting(E_ALL & ~E_NOTICE);

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

/// PHPUNIT 5 <-> 6 compatibility dirty hack
foreach ([
    \PHPUnit_Framework_TestCase::class => \PHPUnit\Framework\TestCase::class,
    \PHPUnit_Framework_Constraint::class => \PHPUnit\Framework\Constraint\Constraint::class,
] as $old => $new) {
    foreach ([$old => $new, $new => $old] as $one => $other) {
        if (!class_exists($one) && class_exists($other)) {
            $pos = strrpos($one, '\\');
            $class = $pos === FALSE ? $one : substr($one, $pos+1);
            $space = $pos === FALSE ? '' : substr($one, 0, $pos);
            $namespace = $space ? "namespace $space;" : '';
            eval("${namespace}abstract class $class extends \\$other {};\n");
        }
    }
}

Yii::setAlias('@prjdir', dirname(__DIR__));
