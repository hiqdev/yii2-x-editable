<?php
/**
 * X-editable extension for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-x-editable
 * @package   yii2-x-editable
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015-2017, HiQDev (http://hiqdev.com/)
 */

/**
 * {@inheritdoc}
 */

namespace hiqdev\xeditable;

use hiqdev\xeditable\traits\XEditableTrait;
use yii\base\Action;
use yii\web\NotFoundHttpException;

/**
 * usage:
 * in your controller you may write this
 * public function actions()
 *   {
 *       return [
 *           'editable' => [
 *           'class' => 'hiqdev\xeditable\XEditableAction',
 *           //'scenario'=>'editable',  //optional
 *           'modelclass' => Model::class,
 *           ],
 *       ];
 *   }.
 *
 * Class XEditableAction
 */
class XEditableAction extends Action
{
    public $modelclass;
    public $scenario = '';

    /**
     * @throws NotFoundHttpException
     */
    public function run()
    {
        if (\Yii::$app->request->isAjax) {
            $pk         = $_POST['pk'];
            $name       = $_POST['name'];
            $value      = $_POST['value'];
            $modelclass = $this->modelclass;
            $model      = $modelclass::findOne($pk);
            if ($this->scenario) {
                $model->setScenario($this->scenario);
            }
            XEditableTrait::saveAction([
                'name'  => $name,
                'value' => $value,
                'model' => $model,
            ]);
        }
    }
}
