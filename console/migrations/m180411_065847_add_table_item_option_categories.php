<?php

use yii\db\Migration;

/**
 * Class m180411_065847_add_table_item_option_categories
 */
class m180411_065847_add_table_item_option_categories extends Migration
{
    const TABLE = 'item_option_categories';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE, [
            'option_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
        ]);

        $this->addPrimaryKey('id', self::TABLE, ['option_id', 'category_id']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE);
    }
}
