<?php

namespace backend\models\forms;

/**
 * Class CurrencyForm
 */
class CurrencyForm extends \yii\base\Model
{

    public $id;
    public $title;
    public $title_full;
    public $symbol;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['title', 'title_full'], 'required'],
            [['title', 'title_full', 'symbol'], 'string', 'max' => 255],
        ];
    }
}