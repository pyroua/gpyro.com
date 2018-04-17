<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "items".
 *
 * @property int $id
 * @property string $article
 * @property string $title
 * @property string $description
 * @property string $category_id
 * @property float $price
 * @property string $logo
 * @property string $video_url
 *
 * @property ItemOptionValue[] $itemOptionValues
 * @property string $logoWebPath
 *
 */
class Item extends BaseModel
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'items';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'category_id'], 'required'],
            [['article', 'title', 'description', 'category_id', 'logo', 'video_url'], 'string', 'max' => 255],
            [['price'], 'double']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'article' => Yii::t('app', 'Article'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'category_id' => Yii::t('app', 'Category ID'),
            'price' => Yii::t('app', 'Price'),
            'logo' => Yii::t('app', 'Logo'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemOptionValues()
    {
        return $this->hasMany(ItemOptionValue::class, ['item_id' => 'id']);
    }

    /**
     * @param int $optionId
     * @return null|static
     */
    public function getItemOptionValue(int $optionId)
    {
        return ItemOptionValue::findOne(['item_id' => $this->id, 'option_id' => $optionId]);
    }

    /**
     * @return false|int
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function deleteItem()
    {
        // delete option values
        foreach ($this->itemOptionValues as $optionValue) {
            if (!$optionValue->delete()) {
                throw new \Exception('Cant delete option value');
            }
        }

        //delete logo

        //delete item
        return $this->delete();
    }

    /**
     * @return string
     */
    public function getImagesPath()
    {
        return Yii::$app->params['uploadDirs']['images']['items'] . DIRECTORY_SEPARATOR . $this->id . DIRECTORY_SEPARATOR;
    }

    /**
     * @return string
     */
    public function getLogoWebPath()
    {
        return Yii::$app->params['webDirs']['images']['items'] .
            DIRECTORY_SEPARATOR .
            $this->id .
            DIRECTORY_SEPARATOR .
            $this->logo;
    }

}