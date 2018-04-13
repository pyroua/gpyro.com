<?php

use yii\db\Migration;

/**
 * Class m180413_104648_users_permisions
 */
class m180413_104648_users_permisions extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('auth_item', [
            'name' => 'manageUsers',
            'type' => '2',
            'description' => '',
            'created_at' => time(),
            'updated_at' => time(),
        ]);

        $this->insert('auth_item_child', [
            'parent' => 'admin',
            'child' => 'manageUsers',
        ]);
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
