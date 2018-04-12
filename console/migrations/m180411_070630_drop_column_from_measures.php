<?php

use yii\db\Migration;

/**
 * Class m180411_070630_drop_column_from_measures
 */
class m180411_070630_drop_column_from_measures extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('measures', 'category_id');
    }
}
