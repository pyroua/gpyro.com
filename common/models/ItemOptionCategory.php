<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "item_option_categories".
 *
 * @property int $option_id
 * @property int $category_id
 * @property boolean $required
 *
 * @property Category $category
 */
class ItemOptionCategory extends BaseModel
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
            [['required'], 'boolean'],
            [['required'], 'default', 'value' => false]
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

    /**
     * @param int $categoryId
     * @param $itemOptionId
     * @return bool
     */
    public static function isRequired(int $categoryId, $itemOptionId)
    {
        $data = self::findOne(['category_id' => $categoryId, 'option_id' => $itemOptionId]);

        return ($data === null || $data->required == 0) ? false : true;
    }

}
