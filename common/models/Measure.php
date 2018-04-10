<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "measures".
 *
 * @property int $id
 * @property string $title
 * @property string $title_full
 * @property int $category_id
 */
class Measure extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'measures';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['category_id'], 'integer'],
            [['title', 'title_full'], 'string', 'max' => 255],
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
            'title_full' => Yii::t('app', 'Title Full'),
            'category_id' => Yii::t('app', 'Category ID'),
        ];
    }
}
