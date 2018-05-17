<?php

namespace common\models;


/**
 * This is the model class for table "categories".
 *

 */
class i18nContentValue extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'i18n_content_values';
    }

    public static function primaryKey($asArray = FALSE)
    {
        return [
            'id',
            'type',
            'title',
            'lang'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['value'], 'safe']
        ];
    }



}
