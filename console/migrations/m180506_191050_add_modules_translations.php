<?php

use yii\db\Migration;
use console\helpers\MigrationHelper;

/**
 * Class m180506_191050_add_modules_translations
 */
class m180506_191050_add_modules_translations extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        MigrationHelper::importTranslations('@vendor/dektrium/yii2-user/messages/ru', 'ru-RU');
        MigrationHelper::importTranslations('@vendor/dvizh/yii2-cart/src/messages/ru-RU', 'ru-RU');
        MigrationHelper::importTranslations('@common/modules/order/src/messages/ru-RU', 'ru-RU');
    }

}
