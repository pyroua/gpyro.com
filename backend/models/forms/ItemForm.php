<?php

namespace backend\models\forms;

/**
 * Class ItemForm
 */
class ItemForm extends \yii\base\Model
{
    public $title;
    public $description;
    public $article;
    public $category_id;

    public function rules()
    {
        return [

        ];
    }
}