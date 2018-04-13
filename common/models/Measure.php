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
class Measure extends BaseModel
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
        ];
    }

    /**
     * @return false|int
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function deleteMeasure()
    {
        return $this->delete();
    }
}
