<?php

use yii\db\Migration;
use yii\rbac\DbManager;
use yii\base\InvalidConfigException;

/**
 * Class m180430_105132_currencies_permissions
 */
class m180430_105132_currencies_permissions extends Migration
{

    /**
     * @throws yii\base\InvalidConfigException
     * @return DbManager
     */
    protected function getAuthManager()
    {
        $authManager = Yii::$app->getAuthManager();
        if (!$authManager instanceof DbManager) {
            throw new InvalidConfigException('You should configure "authManager" component to use database before executing this migration.');
        }

        return $authManager;
    }

    /**
     * @return bool|void
     * @throws InvalidConfigException
     * @throws \yii\base\Exception
     */
    public function safeUp()
    {
        $auth = $this->getAuthManager();

        $currency = $auth->createPermission('currencies');
        $currency->description = 'view measures page';
        $auth->add($currency);

        $addEditCurrency = $auth->createPermission('addEditCurrency');
        $auth->add($addEditCurrency);

        $deleteCurrency = $auth->createPermission('deleteCurrency');
        $auth->add($deleteCurrency);

        $auth->addChild($currency, $addEditCurrency);
        $auth->addChild($currency, $deleteCurrency);
        $auth->addChild($auth->getRole('admin'), $currency);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180413_105132_measures_permissions cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180413_105132_measures_permissions cannot be reverted.\n";

        return false;
    }
    */
}
