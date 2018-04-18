<?php

namespace frontend\controllers;

use common\models\Item;
use yii\data\ActiveDataProvider;

use common\models\Category;
use backend\helpers\CategoryHelper;

class CategoryController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionView($id)
    {
        $current = Category::findOne(['id' => $id]);
        $items = $current->items;

        return $this->render('view', ['current' => $current, 'items' => $items]);
    }

}
