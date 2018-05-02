<?php

namespace backend\models\forms;

class ItemSearchForm extends \yii\base\Model
{

    public $query;
    public $category_id;
    public $user_id;

    public function rules()
    {
        return [
            [['category_id', 'user_id'], 'integer'],
            [['query'], 'safe'],
            [['query'], 'filter', 'filter' => 'trim']
        ];
    }

}