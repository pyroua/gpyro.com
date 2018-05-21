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
 * @property ItemOption[] $itemOptions
 * @property ItemOptionCategory[] $itemOptionsCategory
 *
 * @property Item[] $items
 * @property array $itemOptionsArrayList
 */
class Category extends BaseModel
{

    use ContentI18nTrait;

    /* i18n content fields config */
    protected $i18nType = 'category';
    public static $i18nFields = [
        'title',
    ];

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
            [[
                self::getI18nFieldTitle('title', 'ru'),
                self::getI18nFieldTitle('title', 'en'),
            ], 'required'],
            [[
                self::getI18nFieldTitle('title', 'ru'),
                self::getI18nFieldTitle('title', 'en'),
                'logo'
            ], 'string', 'max' => 255],
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
            ->viaTable(ItemOptionCategory::tableName(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemOptionsCategory()
    {
        return $this->hasMany(ItemOptionCategory::class, ['category_id' => 'id']);
    }

    /**
     * @return array
     */
    public function getItemOptionsArrayList()
    {
        $data = $this->itemOptions;

        $result = [];
        foreach ($data as $val) {
            $result[$val->id] = $val->title;
        }

        return $result;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Item::class, ['category_id' => 'id']);
    }

    /**
     * @param $optionId
     * @return bool
     */
    public function isItemOptionRequired($optionId)
    {
        $data = ItemOptionCategory::find()
            ->where(['category_id' => $this->id, 'option_id' => $optionId])
            ->one();
        if ($data) {
            /** @var ItemOptionCategory $data */
            return $data->required;
        }

        return false;
    }

    /**
     * @param $itemOptions
     * @param $required
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function processItemOptions($itemOptions, $required)
    {
        if ($this->isNewRecord && !empty($itemOptions)) {
            foreach ($itemOptions as $itemOptionId) {
                $itemOptionCategory = new ItemOptionCategory(['option_id' => $itemOptionId, 'category_id' => $this->id]);
                if (!empty($required) &&
                    in_array($itemOptionId, $required)) {
                    $itemOptionCategory->required = true;
                }
                if (!$itemOptionCategory->save()) {
                    throw new \Exception('Cant save item option category');
                }
            }
        } else if (!$this->isNewRecord) {
            // delete all itemOtions from categpory
            if (empty($itemOptions)) {
                foreach ($this->itemOptionsCategory as $categoryOption) {
                    if (!$categoryOption->delete()) {
                        throw new \Exception('Cant delete itemOptionsCategory record');
                    }
                }
            } else {
                $itemOptionsIdList = [];
                foreach ($this->itemOptionsCategory as $categoryOption) {
                    $itemOptionsIdList[] = $categoryOption->option_id;

                    // видаляєм ті парамери,які викинули з форми
                    if (!in_array($categoryOption->option_id, $itemOptions)) {
                        if (!$categoryOption->delete()) {
                            throw new \Exception('Cant delete itemOptionsCategory record');
                        }
                    } else {
                        // якшо параметр рекваєред,а в формі цього немає - значить робим не реваєред
                        if (empty($required) ||
                            !in_array($categoryOption->option_id, $required) &&
                            $categoryOption->required) {
                            $categoryOption->required = false;
                            if (!$categoryOption->save()) {
                                throw new \Exception('Cant save itemOptionsCategory record');
                            }
                        }
                        // якшо параметр не рекаєред,а в формі цього немає - значить робим реваєред
                        if (!empty($required) &&
                            in_array($categoryOption->option_id, $required) &&
                            !$categoryOption->required) {
                            $categoryOption->required = true;
                            if (!$categoryOption->save()) {
                                throw new \Exception('Cant save itemOptionsCategory record');
                            }
                        }
                    }
                }
                // додаєм параметр, якщо його немає в базі
                if (!empty($itemOptions)) {
                    foreach ($itemOptions as $optionId) {
                        if (!in_array($optionId, $itemOptionsIdList)) {
                            $itemOptionCategory = new ItemOptionCategory(['option_id' => $optionId, 'category_id' => $this->id]);
                            if (!empty($required) &&
                                in_array($optionId, $required)) {
                                $itemOptionCategory->required = true;
                            }
                            if (!$itemOptionCategory->save()) {
                                throw new \Exception('Cant save item option category');
                            }
                        }
                    }
                }
            }
        }
    }

    /**
     * @param array|null $fields
     * @return array
     */
    public static function getArrayList(array $fields = null)
    {
        $data = self::find()->all();

        $result = [];
        foreach ($data as $val) {

            $result[$val->id] = $val->title;
        }
        //var_dump($result);die;
        return $result;
    }
}
