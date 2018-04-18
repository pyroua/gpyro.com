<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_items".
 *
 * @property int $item_id
 * @property int $order_id
 * @property double $price
 * @property int $count
 */
class OrderItems extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_items';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_id', 'order_id', 'price', 'count'], 'required'],
            [['item_id', 'order_id', 'count'], 'integer'],
            [['price'], 'number'],
            [['item_id', 'order_id'], 'unique', 'targetAttribute' => ['item_id', 'order_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'item_id' => Yii::t('app', 'Item ID'),
            'order_id' => Yii::t('app', 'Order ID'),
            'price' => Yii::t('app', 'Price'),
            'count' => Yii::t('app', 'Count'),
        ];
    }
}
