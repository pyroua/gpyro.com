<?php

namespace frontend\widgets;


use Yii;
use yii\bootstrap\Widget;

use common\models\Category;
use backend\helpers\CategoryHelper;

class CategoriesList extends Widget
{
    public function run()
    {
        $categories = Category::find()->all();
        return $this->render('categories-list', ['categories' => CategoryHelper::buildCatTree($categories, false)]);

        //$categories = Yii::$app->catalog->getCategories();
        //return $this->render('categories-list', ['categories' => $categories]);
    }

} 