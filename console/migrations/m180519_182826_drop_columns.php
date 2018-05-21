<?php

use yii\db\Migration;

/**
 * Class m180519_182826_drop_columns
 */
class m180519_182826_drop_columns extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->dropColumn('items', 'title');
        $this->dropColumn('items', 'description');

        $this->dropColumn('item_options', 'title');
        $this->dropColumn('item_options', 'description');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180519_182826_drop_columns cannot be reverted.\n";

        return false;
    }

}
