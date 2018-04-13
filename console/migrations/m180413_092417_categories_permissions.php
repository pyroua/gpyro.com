<?php

use yii\db\Migration;

/**
 * Class m180413_092417_categories_permissions
 */
class m180413_092417_categories_permissions extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('auth_item', ['name', 'type', 'description', 'created_at', 'updated_at'], [
                ['categories', '2', 'view categories page', time(), time()],
                ['addEditCategory', '2', '', time(), time()],
                ['deleteCategory', '2', '', time(), time()],
        ]);

        $this->batchInsert('auth_item_child', ['parent', 'child'], [
            ['categories', 'addEditCategory'],
            ['categories', 'deleteCategory'],
            ['admin', 'categories'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180413_092417_categories_permissions cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180413_092417_categories_permissions cannot be reverted.\n";

        return false;
    }
    */
}
