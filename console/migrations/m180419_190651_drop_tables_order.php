<?php

use yii\db\Migration;

/**
 * Class m180419_190651_drop_tables_order
 */
class m180419_190651_drop_tables_order extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropTable('orders');
        $this->dropTable('order_items');
    }

}
