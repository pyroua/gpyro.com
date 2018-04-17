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
 *
 * @property ItemOptionCategories $itemOptions
 * @property Item[] $items
 */
class Category extends BaseModel
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
     * @return false|int
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function deleteCategory()
    {
        return $this->delete();
    }

    /**
     * @param string $title
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function search(string $title)
    {
         return self::find()->where(['ilike', 'title', $title])->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemOptions()
    {
        return $this->hasMany(ItemOption::class, ['id' => 'option_id'])
            ->viaTable(ItemOptionCategories::tableName(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Item::class, ['category_id' => 'id']);
    }
}
