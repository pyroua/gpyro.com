<?php

use yii\db\Migration;

/**
 * Class m180409_190607_add_table_measures
 */
class m180409_190607_add_table_measures extends Migration
{
    const TABLE = 'measures';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE, [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'title_full' => $this->string()->null(),
            'category_id' => $this->integer()->null()
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
