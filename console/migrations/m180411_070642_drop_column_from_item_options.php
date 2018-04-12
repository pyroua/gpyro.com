<?php

use yii\db\Migration;

/**
 * Class m180411_070642_drop_column_from_item_options
 */
class m180411_070642_drop_column_from_item_options extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('item_options', 'category_id');
    }

}
