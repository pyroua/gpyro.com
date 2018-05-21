<?php

use yii\db\Migration;

/**
 * Class m180519_201418_drop_columns
 */
class m180519_201418_drop_columns extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('categories', 'title');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180519_201418_drop_columns cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180519_201418_drop_columns cannot be reverted.\n";

        return false;
    }
    */
}
