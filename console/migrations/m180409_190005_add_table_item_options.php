<?php

use yii\db\Migration;

/**
 * Class m180409_190005_add_table_item_options
 */
class m180409_190005_add_table_item_options extends Migration
{
    const TABLE = 'item_options';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE, [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'description' => $this->string()->null(),
            'type' => $this->integer(),
            'category_id' => $this->integer()->null(),
            'measure_id' => $this->integer()->notNull(),
            'default_value' => $this->string()->null(),
            'required' => $this->boolean()->defaultValue(false)->notNull(),
        ]);

        $this->createIndex( 'category_id',self::TABLE, ['category_id']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('category_id',self::TABLE);

        $this->dropTable(self::TABLE);
    }

}
