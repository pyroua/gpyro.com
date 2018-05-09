<?php
namespace common\modules\i18n;

trait i18nTrait {

    private static $overloadCats = null;

    /**
     * @return null
     */
    public static function getOverloadCats()
    {
        if (self::$overloadCats === null) {
            self::$overloadCats = array_flip(array_keys(\Yii::$app->i18n->translations));
        }
        return self::$overloadCats;
    }

}