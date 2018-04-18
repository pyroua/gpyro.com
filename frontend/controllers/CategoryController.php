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
        //TODO: use relations and findOne
        $current = Category::find()->where(['id' => $id])->one();
        $items = Item::find()->where(['category_id' => $id])->all();

        return $this->render('view', ['current' => $current, 'items' => $items]);
    }

}
