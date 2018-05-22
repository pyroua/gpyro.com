<?php

use yii\db\Migration;

/**
 * Class m180522_093025_alter_i18n_content_table
 */
class m180522_093025_alter_i18n_content_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('i18n_content_values', 'value', $this->text());
    }


}
