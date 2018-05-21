<?php

namespace backend\models\forms;

use Yii;
use common\models\Category;

/**
 * Class CategoryForm
 */
class CategoryForm extends \yii\base\Model
{

    public $title_i18n_en;
    public $title_i18n_ru;
    public $title;
    public $parent;
    public $item_options;
    public $required;


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            Category::getI18nFieldTitle('title', 'en') => Yii::t('app', 'Title EN'),
            Category::getI18nFieldTitle('title', 'ru') => Yii::t('app', 'Title RU'),
        ];
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [[
                Category::getI18nFieldTitle('title', 'en'),
                Category::getI18nFieldTitle('title', 'ru')
            ], 'required'],
            [[
                Category::getI18nFieldTitle('title', 'en'),
                Category::getI18nFieldTitle('title', 'ru')
            ], 'string'],
            [['parent'], 'integer'],
            [['item_options', 'required'], 'safe']
        ];
    }
}