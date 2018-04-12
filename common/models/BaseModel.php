<?php

namespace common\models;

class BaseModel extends \yii\db\ActiveRecord
{
    /**
     * @param int $id
     * @return null|static
     */
    public static function getById($id)
    {
        return self::findOne(['id' => $id]);
    }

    /**
     * @param array $fields
     * @return array
     */
    public static function getArrayList(array $fields = ['id', 'title'])
    {
        $data = self::find()->select($fields)->asArray()->all();
        $result = [];

        foreach ($data as $val) {
            $result[$val['id']] = $val['title'];
        }

        return $result;
    }
}