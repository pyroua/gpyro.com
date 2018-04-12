<?php

namespace backend\controllers;

class ItemsController extends BaseController
{

    //public $modelClass = Item::class;

    public function actionIndex()
    {
        return $this->render('index');
    }

}
