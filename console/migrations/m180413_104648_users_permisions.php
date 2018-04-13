<?php

use yii\db\Migration;
use yii\rbac\DbManager;
use yii\base\InvalidConfigException;

/**
 * Class m180413_104648_users_permisions
 */
class m180413_104648_users_permisions extends Migration
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
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = $this->getAuthManager();
        $manageUsers = $auth->createPermission('manageUsers');
        $auth->add($manageUsers);
        $auth->addChild($auth->getRole('admin'), $manageUsers);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180413_104648_users_permisions cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180413_104648_users_permisions cannot be reverted.\n";

        return false;
    }
    */
}
