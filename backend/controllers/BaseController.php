<?php

namespace backend\controllers;

use Yii;

class BaseController extends \yii\web\Controller {

    public function setFlash($type, $message)
    {
        Yii::$app->getSession()->setFlash($type, $message);
    }
}
