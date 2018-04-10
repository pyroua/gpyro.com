<?php

namespace backend\models\forms;

/**
 * Class ItemForm
 */
class CategoryForm extends \yii\base\Model
{
    public $title;
    public $parent;

    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string'],
            [['parent'], 'integer']
        ];
    }
}