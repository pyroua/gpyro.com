<?php

namespace backend\models\forms;

/**
 * Class MeasureForm
 */
class MeasureForm extends \yii\base\Model
{

    public $id;
    public $title;
    public $title_full;
    public $category_id;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['title'], 'required'],
            [['category_id'], 'integer'],
            [['title', 'title_full'], 'string', 'max' => 255],
        ];
    }
}