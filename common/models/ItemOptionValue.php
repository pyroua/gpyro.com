<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "item_option_values".
 *
 * @property int $item_id
 * @property int $option_id
 * @property int $int
 * @property double $decimal
 * @property string $string
 *
 * @property string $value
 *
 * @property Item $item
 * @property ItemOption $itemOption
 */
class ItemOptionValue extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'item_option_values';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_id', 'option_id'], 'required'],
            [['item_id', 'option_id', 'int'], 'integer'],
            [['decimal'], 'number'],
            [['string'], 'string', 'max' => 255],
            [['item_id', 'option_id'], 'unique', 'targetAttribute' => ['item_id', 'option_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'item_id' => Yii::t('app', 'Item ID'),
            'option_id' => Yii::t('app', 'Option ID'),
            'int' => Yii::t('app', 'Int'),
            'decimal' => Yii::t('app', 'Decimal'),
            'string' => Yii::t('app', 'String'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemOption()
    {
        return $this->hasOne(ItemOption::class, ['id' => 'option_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Item::class, ['id' => 'item_id']);
    }


    /**
     * Defines wich field use to get data
     *
     */
    public function getValue()
    {
        $types = ['int', 'decimal', 'string'];
        foreach ($types as $type) {
            if (!empty($this->$type)) {
                return $this->$type;
            }
        }

        return null;
    }

    /**
     * @param $value
     * @throws \Exception
     */
    public function setValue($value)
    {
        switch ($this->itemOption->type) {
            case 0:
                $this->int = $value;
                break;

            case 1:
                $this->decimal = $value;
                break;

            case 2:
                $this->string = $value;
                break;

            case 3:
                $this->string = $value;
                break;

            default:
                throw new \Exception('Wrong type');

        }
    }
}
