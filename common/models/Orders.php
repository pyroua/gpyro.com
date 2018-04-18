<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property int $user_id
 * @property string $status
 * @property string $ts
 */
class Orders extends \yii\db\ActiveRecord
{
    const ORDER_NEW = 0;
    const ORDER_IN_PROGRESS = 1;
    const ORDER_DONE = 2;

    private static $statusTitles = [
        self::ORDER_NEW => 'new',
        self::ORDER_IN_PROGRESS => 'in progress',
        self::ORDER_DONE => 'done',
    ];

    /**
     * @return array
     */
    public function getStatusTitles()
    {
        return self::$statusTitles;
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id'], 'integer'],
            [['status'], 'string'],
            [['ts'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'status' => Yii::t('app', 'Status'),
            'ts' => Yii::t('app', 'Ts'),
        ];
    }
}
