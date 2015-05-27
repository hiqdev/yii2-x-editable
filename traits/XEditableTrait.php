<?php
namespace hiqdev\xeditable\traits;

use hiqdev\xeditable\assets\XEditableAsset;
use vova07\select2\Select2Asset;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\helpers\VarDumper;
use yii\web\NotFoundHttpException;
use yii\web\View;

trait XEditableTrait
{
    public $pluginOptions;

    public $view;

    public $form = null;

    public function registerAssets()
    {
        if (empty($this->pluginOptions['type']))
            $this->pluginOptions['type'] = 'text';
        $this->view = \Yii::$app->getView();
        $xea = new XEditableAsset();
        if ($this->form)
            $xea->form = $this->form;
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
        $this->view->registerJs('$(".editable[data-name=' . $this->attribute . ']").editable(' . Json::encode($this->pluginOptions) . ');');
    }

    /**
     * @param $data
     * @throws NotFoundHttpException
     */
    public static function saveAction($data)
    {
        $model = ArrayHelper::getValue($data, 'model');
        $name = ArrayHelper::getValue($data, 'name');
        $value = ArrayHelper::getValue($data, 'value');
        if ($model === null)
            throw new NotFoundHttpException();
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