<?php

use yii\db\Migration;

/**
 * Class m180421_163113_add_colum_to_categories
 */
class m180421_163113_add_colum_to_categories extends Migration
{

    const TABLE = 'item_option_categories';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(self::TABLE, 'required', $this->boolean()->null());
    }
}
