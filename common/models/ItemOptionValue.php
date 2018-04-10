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
 */
class ItemOptionValue extends \yii\db\ActiveRecord
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
}
