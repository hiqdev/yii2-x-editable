<?php

/*
 * X-editable extension for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-x-editable
 * @package   yii2-x-editable
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015, HiQDev (https://hiqdev.com/)
 */

namespace hiqdev\xeditable\traits;

use hiqdev\xeditable\assets\XEditableAsset;
use vova07\select2\Select2Asset;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\helpers\VarDumper;
use yii\web\JsExpression;
use yii\web\NotFoundHttpException;
use yii\web\View;

trait XEditableTrait
{
    protected $_view;

    public function getView()
    {
        if ($this->_view === null) {
            $this->_view = Yii::$app->getView();
        }
        return $this->_view;
    }

    public $pluginOptions;

    public $form = null;

    public function registerAssets()
    {
        if (empty($this->pluginOptions['type'])) {
            $this->pluginOptions['type'] = 'text';
        }

        if (empty($this->pluginOptions['params'])) {
            if (isset($this->model)) {
                $pk                            = array_shift($this->model->primaryKey());
                $form                          = $this->model->formName();
                $this->pluginOptions['params'] = new JsExpression("function(params) {
                    var result = {};
                    result['$form'] = {};
                    result['$form'][params.name] = params.value;
                    result['$form']['$pk'] = params.pk;

                    return result;
                }");
            }
        }
        $xea = new XEditableAsset();
        if ($this->form) {
            $xea->form = $this->form;
        }
        $xea::register($this->view);
        switch ($this->pluginOptions['type']) {
            case 'select2':
                Select2Asset::register($this->view);
                break;
            case 'datetime':

                break;
            case 'date':

                break;
            case 'typeaheadjs':

                break;
            case 'combodate':

                break;
            case 'wysihtml5':

                break;
        }
    }

    public function registerClientScript()
    {
        //        $this->view->registerJs(<<<JS
//            jQuery.fn.editable.defaults.params = function(params) {
//                var data = {};
//                data['Host'] = {};
//                data['Host']['id'] = params.pk;
//                data['Host']['{$this->attribute}'] = params.value;
//                return data;
//            }
//JS
//);
        $this->view->registerJs('$(".editable[data-name=' . $this->attribute . ']").editable(' . Json::encode($this->pluginOptions) . ');');
    }

    /**
     * @param $data
     *
     * @throws NotFoundHttpException
     */
    public static function saveAction($data)
    {
        $model = ArrayHelper::getValue($data, 'model');
        $name  = ArrayHelper::getValue($data, 'name');
        $value = ArrayHelper::getValue($data, 'value');
        if ($model === null) {
            throw new NotFoundHttpException();
        }
        if (!is_array($value)) {
            if (strtotime($value)) {
                $model->$name = strtotime($value);
            } else {
                $model->$name = $value;
            }
        } else {
            $model->$name = implode(',', $value);
        }
        if ($model->validate()) {
            $model->update();
        } else {
            VarDumper::dump($model->getErrors(), 10);
        }
    }
}
