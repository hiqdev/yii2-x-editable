<?php

/**
 * @inheritdoc
 */
namespace hiqdev\xeditable;

use hiqdev\xeditable\traits\XEditableTrait;
use yii\base\Action;
use yii\console\Response;
use yii\helpers\VarDumper;
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
 *           'modelclass' => Model::className(),
 *           ],
 *       ];
 *   }
 *
 * Class XEditableAction
 * @package hiqdev\xeditable
 */
class XEditableAction extends Action
{
    public $modelclass;
    public $scenario = '';

    /**
     * @throws traits\NotFoundHttpException
     */
    public function run()
    {
        if (\Yii::$app->request->isAjax) {
            $pk = $_POST['pk'];
            $name = $_POST['name'];
            $value = $_POST['value'];
            $modelclass = $this->modelclass;
            $model = $modelclass::findOne($pk);
            if ($this->scenario) {
                $model->setScenario($this->scenario);
            }
            XEditableTrait::saveAction([
                'name' => $name,
                'value' => $value,
                'model' => $model,
            ]);
        }
    }
}
