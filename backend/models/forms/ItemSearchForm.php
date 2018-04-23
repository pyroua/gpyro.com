<?php

namespace backend\models\forms;

class ItemSearchForm extends \yii\base\Model {

    public $query;
    public $category_id;

    public function rules()
    {
        return [
            [['category_id'], 'integer'],
            [['query'], 'safe']
        ];
    }

}