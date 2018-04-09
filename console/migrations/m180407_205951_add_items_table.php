<?php

use yii\db\Migration;

/**
 * Class m180407_205951_add_items_table
 */
class m180407_205951_add_items_table extends Migration
{

    const TABLE_ITEMS = 'items';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE_ITEMS, [
            'id' => $this->primaryKey(),
            'article' => $this->string()->null(),
            'title' => $this->string()->notNull(),
            'description' => $this->string()->null(),
            'category_id' => $this->string()->notNull(),
            'logo' => $this->string()->null(),
        ]);

        $this->createIndex('category_id', self::TABLE_ITEMS, ['category_id']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('category_id', self::TABLE_ITEMS);

        $this->dropTable(self::TABLE_ITEMS);
    }

}
