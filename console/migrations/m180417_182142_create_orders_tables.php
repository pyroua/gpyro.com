<?php

use yii\db\Migration;

/**
 * Class m180417_182142_create_orders_tables
 */
class m180417_182142_create_orders_tables extends Migration
{

    const TABLE_ORDER = 'orders';
    const TABLE_ORDER_ITEMS = 'order_items';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE_ORDER, [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'status' => "ENUM(0, 1, 2)",
            'ts' => $this->timestamp()

        ]);

        $this->createTable(self::TABLE_ORDER_ITEMS, [
            'item_id' => $this->integer()->notNull(),
            'order_id' => $this->integer()->notNull(),
            'price' => $this->double()->notNull(),
            'count'=> $this->integer()->notNull(),
        ]);
        $this->addPrimaryKey('id', self::TABLE_ORDER_ITEMS, ['item_id', 'order_id']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE_ORDER);
        $this->dropTable(self::TABLE_ORDER_ITEMS);
    }

}
