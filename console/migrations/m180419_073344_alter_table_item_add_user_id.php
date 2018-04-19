<?php

use yii\db\Migration;

/**
 * Class m180419_073344_alter_table_item_add_user_id
 */
class m180419_073344_alter_table_item_add_user_id extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('items', 'user_id', $this->integer()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('items', 'user_id');
    }

}
