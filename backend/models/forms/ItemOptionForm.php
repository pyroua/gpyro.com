<?php

namespace backend\models\forms;

use Yii;
use common\models\ItemOption;

/**
 * Class ItemForm
 */
class ItemOptionForm extends \yii\base\Model
{
    //public $title;
    //public $description;
    public $title_i18n_en;
    public $title_i18n_ru;
    public $description_i18n_en;
    public $description_i18n_ru;
    public $type;
    public $categories;
    public $measure_id;
    public $default_value;

    //public $required;

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'title_i18n_en' => Yii::t('app', 'Title EN'),
            'title_i18n_ru' => Yii::t('app', 'Title RU'),
            'description_i18n_en' => Yii::t('app', 'Description RU'),
            'description_i18n_ru' => Yii::t('app', 'Description EN'),
        ];
    }

//    /**
//     * @return array
//     */
//    public function scenarios()
//    {
//        $scenarios = parent::scenarios();
//        $scenarios[self::SCENARIO_UPDATE] = [
//            //'title',
//            ItemOption::getI18nFieldTitle('title', 'en'),
//            ItemOption::getI18nFieldTitle('title', 'ru'),
//            ItemOption::getI18nFieldTitle('description', 'en'),
//            ItemOption::getI18nFieldTitle('description', 'ru'),
//            //'description',
//
//        ];
//        return $scenarios;
//    }

    public function rules()
    {
        return [
            [[
                //'title'
                ItemOption::getI18nFieldTitle('title', 'en'),
                ItemOption::getI18nFieldTitle('title', 'ru'),
            ], 'required'],
            [['type'], 'integer'],
            [[
                //'title',
                //'description',
                ItemOption::getI18nFieldTitle('title', 'en'),
                ItemOption::getI18nFieldTitle('title', 'ru'),
                ItemOption::getI18nFieldTitle('description', 'en'),
                ItemOption::getI18nFieldTitle('description', 'ru'),
                'default_value'
            ], 'string', 'max' => 255],
            //[['required'], 'boolean'],
            [['categories', 'measure_id'], 'safe']
        ];
    }

}