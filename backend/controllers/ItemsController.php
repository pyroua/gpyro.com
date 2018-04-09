<?php

namespace backend\controllers;

class ItemsController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
