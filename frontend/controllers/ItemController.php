<?php

namespace frontend\controllers;

use common\models\Item;
use common\models\ItemOption;
use common\models\ItemOptionValue;
use yii\data\ActiveDataProvider;

use common\models\Category;
use backend\helpers\CategoryHelper;

class ItemController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionView($id)
    {
        //$categories = Category::find()->all();
        //$current = Category::find()->where(['id' => $id])->one();

        $item = Item::find()->where(['id' => $id])->one();
        $itemOptions = ItemOptionValue::find()->where(['item_id' => $id])->all();

        return $this->render('view', ['item' => $item, 'itemOptions' => $itemOptions]);
    }

}

