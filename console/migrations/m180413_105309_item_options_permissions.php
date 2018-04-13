<?php

use yii\db\Migration;

/**
 * Class m180413_105309_item_options_permissions
 */
class m180413_105309_item_options_permissions extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('auth_item', ['name', 'type', 'description', 'created_at', 'updated_at'], [
            ['itemOptions', '2', 'view item options page', time(), time()],
            ['addEditItemOption', '2', '', time(), time()],
            ['deleteItemOption', '2', '', time(), time()],
        ]);

        $this->batchInsert('auth_item_child', ['parent', 'child'], [
            ['itemOptions', 'addEditItemOption'],
            ['itemOptions', 'deleteItemOption'],
            ['admin', 'itemOptions'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180413_105309_item_options_permissions cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180413_105309_item_options_permissions cannot be reverted.\n";

        return false;
    }
    */
}
