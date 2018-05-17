<?php

namespace console\controllers;

use common\models\Item;

class TestController extends \yii\console\Controller
{


    public function actionContentLang()
    {
        $item = Item::findOne(['id' => 2]);

        var_dump($item->title_i18n_ru);
    }



}