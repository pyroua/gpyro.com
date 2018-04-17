<?php

use yii\db\Migration;

/**
 * Class m180417_175805_add_item_column
 */
class m180417_175805_add_item_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('items', 'price', $this->float()->null());
    }

}
