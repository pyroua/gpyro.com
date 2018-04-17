<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "item_option_categories".
 *
 * @property int $option_id
 * @property int $category_id
 *
 * @property Category $category
 */
class ItemOptionCategories extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'item_option_categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['option_id', 'category_id'], 'required'],
            [['option_id', 'category_id'], 'integer'],
            [['option_id', 'category_id'], 'unique', 'targetAttribute' => ['option_id', 'category_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'option_id' => Yii::t('app', 'Option ID'),
            'category_id' => Yii::t('app', 'Category ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasone(Category::class, ['id' => 'category_id']);
    }
}
