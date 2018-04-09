<?php

use yii\db\Migration;

/**
 * Class m180407_210606_add_categories_table
 */
class m180407_210606_add_categories_table extends Migration
{

    const TABLE = 'categories';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE, [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'parent' => $this->integer()->notNull(),
            'logo' => $this->string()->null()
        ]);

        $this->createIndex( 'parent',self::TABLE, ['parent']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('parent',self::TABLE);

        $this->dropTable(self::TABLE);
    }

}
