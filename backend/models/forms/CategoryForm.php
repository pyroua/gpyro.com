<?php

namespace backend\models\forms;

/**
 * Class CategoryForm
 */
class CategoryForm extends \yii\base\Model
{
    public $title;
    public $parent;
    public $item_options;
    public $required;

    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string'],
            [['parent'], 'integer'],
            [['item_options', 'required'], 'safe']
        ];
    }
}