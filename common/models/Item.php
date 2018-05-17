<?php

namespace common\models;

use common\helpers\UserHelper;
use Yii;
use yii\behaviors\AttributeBehavior;
use yii\db\ActiveRecord;
use yii\helpers\BaseFileHelper;
use yii\web\UploadedFile;

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
 * @property int $user_id
 *
 * @property ItemOptionValue[] $itemOptionValues
 * @property string $logoWebPath
 * @property string $logoPath
 * @property string $imagesPath
 *
 */
class Item extends BaseModel implements \dvizh\cart\interfaces\CartElement
{

    use ContentI18nTrait;


    /* i18n content fields config */
    protected $i18nType = 'item';
    public static $i18nFields = [
        'title',
        'description'
    ];

    const SCENARIO_UPDATE = 'update';

    private $itemOptions;
    /** @var UploadedFile $file */
    private $file;

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            [
                'class' => AttributeBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'user_id'
                ],
                'value' => function ($event) {
                    return Yii::$app->user->id;
                },
            ],
        ];
    }

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
            [[
                Item::getI18nFieldTitle('title', 'en'),
                Item::getI18nFieldTitle('title', 'ru')
            ], 'required'],
            [['category_id'], 'required', 'on' => self::SCENARIO_DEFAULT],
            [[
                'article',
                'title',
                //'description',
                Item::getI18nFieldTitle('description', 'en'),
                Item::getI18nFieldTitle('description', 'ru'),
                'category_id',
                'logo',
                'video_url'
            ],
                'string',
                'max' => 255
            ],
            [['price'], 'double'],
            [['user_id'], 'integer']
        ];
    }

    /**
     * @return array
     */
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_UPDATE] = [
            //'title',
            Item::getI18nFieldTitle('title', 'en'),
            Item::getI18nFieldTitle('title', 'ru'),
            //'description',
            Item::getI18nFieldTitle('description', 'en'),
            Item::getI18nFieldTitle('description', 'ru'),
            'article',
            'price',
            'video_url',
            'file'
        ];

        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'article' => Yii::t('app', 'Article'),
            //'title' => Yii::t('app', 'Title'),
            //'description' => Yii::t('app', 'Description'),
            'category_id' => Yii::t('app', 'Category ID'),
            'price' => Yii::t('app', 'Price'),
            'logo' => Yii::t('app', 'Logo'),
            'user_id' => Yii::t('app', 'User ID'),
        ];
    }

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        return parent::beforeSave($insert);
    }

    /**
     * @param bool $insert
     * @param array $changedAttributes
     * @throws \yii\base\Exception
     */
    public function afterSave($insert, $changedAttributes)
    {
        // item option values
        foreach ($this->getItemOptions() as $id => $value) {
            if ($this->isNewRecord) {
                $itemOptionValue = new ItemOptionValue();
            } else {
                $itemOptionValue = $this->getItemOptionValue($id);
                if (!$itemOptionValue) {
                    $itemOptionValue = new ItemOptionValue();
                }
            }
            $itemOptionValue->setAttributes([
                'item_id' => $this->id,
                'option_id' => $id,
                'value' => $value
            ]);

            $itemOptionValue->setValue($value);

            if (!$itemOptionValue->save()) {
                throw new \Exception('Cant save itemOptionValue');
            }
        }

        // logo upload
        if ($this->file) {
            // save image
            $imagesPath = $this->getImagesPath();
            if (!is_dir($imagesPath)) {
                BaseFileHelper::createDirectory($imagesPath, 0777, true);
            }

            $filename = $this->getFileName();
            if ($this->file->saveAs($imagesPath . $filename)) {
                $this->deleteLogo(); // at first delete old logo
                $this->setAttribute('logo', $filename);
                $this->save();
            }
        }

        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
    }

    /**
     * @return string
     */
    public function getFileName()
    {
        return substr(md5($this->file->baseName . microtime(true)), 0, 6) .
            '.' .
            $this->file->extension;
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


    public function deleteLogo()
    {
        //delete logo
        if (!empty($this->logoPath)) {
            @unlink($this->logoPath);
        }
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

        $this->deleteLogo();

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

    public function getLogoPath()
    {
        return !empty($this->logo) ? $this->imagesPath . $this->logo : null;
    }

    /**
     * @return string
     */
    public function getLogoWebPath()
    {
        return Yii::$app->params['webDirs']['images']['items'] .
            '/' .
            $this->id .
            '/' .
            $this->logo;
    }

    //TODO: що методи роботи із замовленям роблять в товарах!!!???
    public function getCartId()
    {
        return $this->id;
    }

    public function getCartName()
    {
        return $this->title;
    }

    public function getCartPrice()
    {
        return $this->price;
    }

    public function getCartImage()
    {
        return $this->logoWebPath;
    }

    //Опции продукта для выбора при добавлении в корзину
    public function getCartOptions()
    {
        return [
            '1' => [
                'name' => 'Цвет',
                'variants' => ['1' => 'Красный', '2' => 'Белый', '3' => 'Синий'],
            ],
            '2' => [
                'name' => 'Размер',
                'variants' => ['4' => 'XL', '5' => 'XS', '6' => 'XXL'],
            ]
        ];
    }

    public function getYoutubeEmbedUrl()
    {
        if (empty($this->video_url)) {
            return;
        }

        $exploded = explode('/watch?v=', $this->video_url);
        if (isset($exploded[1])) {
            $id = substr($exploded[1], 0, 11);
            if (strlen($id) == 11) {
                return 'https://www.youtube.com/embed/' . $id;
            }
        }
    }

    /**
     * @param array $params
     * @return \yii\db\ActiveQuery
     */
    public static function search(array $params = [])
    {
        $query = self::find();

        if (!UserHelper::hasRole('admin')) {
            $query->andWhere(['=', 'user_id', Yii::$app->user->id]);
        } else {
            $query->andFilterWhere(['=', 'user_id', $params['user_id']]);
        }

        // якщо присутнє query то для xjnbhmj[ полів берем умову "АБО"
        if (!empty($params['query'])) {
            $query->orWhere(['like', 'id', $params['query']]);
            $query->orWhere(['like', 'article', $params['query']]);
            $query->orWhere(['like', 'title', $params['query']]);
            $query->orWhere(['like', 'description', $params['query']]);
        }

        $query->andFilterWhere(['=', 'category_id', $params['category_id']]);

        return $query;
    }

    /**
     * @return mixed
     */
    public function getItemOptions()
    {
        return $this->itemOptions;
    }

    /**
     * @param mixed $itemOptions
     */
    public function setItemOptions($itemOptions)
    {
        $this->itemOptions = $itemOptions;
    }

    /**
     * @param mixed $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }

    public function beforeValidate()
    {
        // $this->setI18nContentValidators();

        return parent::beforeValidate(); // TODO: Change the autogenerated stub
    }

}