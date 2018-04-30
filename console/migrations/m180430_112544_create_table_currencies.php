<?php

use yii\db\Migration;

/**
 * Class m180430_112544_create_table_currencies
 */
class m180430_112544_create_table_currencies extends Migration
{
    const TABLE = 'currencies';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE, [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'title_full' => $this->string()->notNull(),
            'symbol' => $this->string()->notNull(),
        ]);
    }
}
