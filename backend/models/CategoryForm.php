<?php

namespace backend\models;

/**
 * Class CategoryForm
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