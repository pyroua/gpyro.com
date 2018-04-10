<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "categories".
 *
 * @property int $id
 * @property string $title
 * @property int $parent
 * @property string $logo
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title', 'logo'], 'string', 'max' => 255],
            [['parent'], 'integer'],
            [['parent'], 'default', 'value' => 0]
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
            'parent' => Yii::t('app', 'Parent category'),
            'logo' => Yii::t('app', 'Logo'),
        ];
    }

    /**
     * @param int $id
     * @return null|static
     */
    public static function getById($id)
    {
        return self::findOne(['id' => $id]);
    }

    /**
     * @return false|int
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function deleteCategory() {
        return $this->delete();
    }
}
