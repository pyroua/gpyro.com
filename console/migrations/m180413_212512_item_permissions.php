<?php

use yii\db\Migration;
use yii\rbac\DbManager;
use yii\base\InvalidConfigException;

/**
 * Class m180413_212512_item_permissions
 */
class m180413_212512_item_permissions extends Migration
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

        $items = $auth->createPermission('items');
        $items->description = 'view item options page';
        $auth->add($items);

        $deleteItems = $auth->createPermission('deleteItems');
        $auth->add($deleteItems);

        $addEditItems = $auth->createPermission('addEditItems');
        $auth->add($addEditItems);

        $auth->addChild($items, $deleteItems);
        $auth->addChild($items, $addEditItems);
        $auth->addChild($auth->getRole('admin'), $items);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180413_212512_item_permissions cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180413_212512_item_permissions cannot be reverted.\n";

        return false;
    }
    */
}
