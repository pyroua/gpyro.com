<?php

use yii\db\Migration;

/**
 * Class m180416_202641_add_item_column
 */
class m180416_202641_add_item_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('items', 'video_url', $this->string()->null());
    }

}
