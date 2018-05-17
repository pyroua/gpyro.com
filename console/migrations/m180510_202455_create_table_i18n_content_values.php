<?php

use yii\db\Migration;

/**
 * Class m180510_202455_create_table_i18n_content_values
 */
class m180510_202455_create_table_i18n_content_values extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('i18n_content_values', [
            'id' => $this->integer()->notNull(),
            'type' => $this->string()->notNull(),
            'title' => $this->string()->notNull(),
            'lang' => $this->string(2)->notNull(),
            'value' => $this->string()->notNull()
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('i18n_content_values');
    }

}
