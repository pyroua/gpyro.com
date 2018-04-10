<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "item_options".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $type
 * @property int $category_id
 * @property int $measure_id
 * @property string $default_value
 * @property int $required
 */
class ItemOption extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'item_options';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'measure_id'], 'required'],
            [['type', 'category_id', 'measure_id'], 'integer'],
            [['title', 'description', 'default_value'], 'string', 'max' => 255],
            [['required'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'type' => Yii::t('app', 'Type'),
            'category_id' => Yii::t('app', 'Category ID'),
            'measure_id' => Yii::t('app', 'Measure ID'),
            'default_value' => Yii::t('app', 'Default Value'),
            'required' => Yii::t('app', 'Required'),
        ];
    }
}
