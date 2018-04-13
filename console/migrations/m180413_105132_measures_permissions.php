<?php

use yii\db\Migration;

/**
 * Class m180413_105132_measures_permissions
 */
class m180413_105132_measures_permissions extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('auth_item', ['name', 'type', 'description', 'created_at', 'updated_at'], [
            ['measures', '2', 'view measures page', time(), time()],
            ['addEditMeasure', '2', '', time(), time()],
            ['deleteMeasure', '2', '', time(), time()],
        ]);

        $this->batchInsert('auth_item_child', ['parent', 'child'], [
            ['measures', 'addEditMeasure'],
            ['measures', 'deleteMeasure'],
            ['admin', 'measures'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180413_105132_measures_permissions cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180413_105132_measures_permissions cannot be reverted.\n";

        return false;
    }
    */
}
