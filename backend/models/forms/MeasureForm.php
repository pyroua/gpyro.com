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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['title'], 'required'],
            [['title', 'title_full'], 'string', 'max' => 255],
        ];
    }
}