<?php

use yii\db\Migration;

/**
 * Class m180409_190005_add_table_item_options
 */
class m180409_190006_add_table_item_option_values extends Migration
{
    const TABLE = 'item_option_values';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE, [
            'item_id' => $this->integer()->notNull(),
            'option_id' => $this->integer()->notNull(),
            'int' => $this->integer()->null(),
            'decimal' => $this->float()->null(),
            'string' => $this->string()->null(),
        ]);
        $this->addPrimaryKey('id', self::TABLE, ['item_id', 'option_id']);
        $this->createIndex( 'item_id_option_id',self::TABLE, ['item_id' ,'option_id']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('item_id_option_id',self::TABLE);

        $this->dropTable(self::TABLE);
    }

}
