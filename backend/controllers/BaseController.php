<?php

namespace backend\controllers;

use Yii;

class BaseController extends \yii\web\Controller
{

    protected $modelClass;

    protected function getModel(int $id)
    {
        if (empty($this->modelClass))
        {
            throw new \Exception("Model not set!");
        }

        $model = $this->modelClass::getById($id);
        if (empty($model)) {
            throw new NotFoundHttpException('Category not found');
        }

        return $model;
    }

    /**
     * @param $type
     * @param $message
     */
    public function setFlash($type, $message)
    {
        Yii::$app->getSession()->setFlash($type, $message);
    }
}
