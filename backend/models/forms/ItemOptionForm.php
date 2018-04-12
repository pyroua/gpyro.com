<?php

namespace backend\models\forms;

/**
 * Class ItemForm
 *
 *
 */
class ItemOptionForm extends \yii\base\Model
{
    public $title;
    public $description;
    public $type;
    public $categories;
    public $measure_id;
    public $default_value;
    public $required;

    public function rules()
    {
        return [
            [['title', 'measure_id'], 'required'],
            [['type', 'measure_id'], 'integer'],
            [['title', 'description', 'default_value'], 'string', 'max' => 255],
            [['required'], 'boolean'],
            [['categories'], 'safe']
        ];
    }

}