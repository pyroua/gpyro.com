<?php

namespace backend\controllers;

use Yii;
use yii\db\ActiveRecord;

class BaseController extends \yii\web\Controller
{

    protected $modelClass;

    /**
     * @param int $id
     * @return mixed
     * @throws \Exception
     */
    protected function getModel(int $id): ActiveRecord
    {
        if (empty($this->modelClass))
        {
            throw new \Exception("Model not set!");
        }

        $model = $this->modelClass::getById($id);
        if (empty($model)) {
            throw new NotFoundHttpException('Model not found');
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
