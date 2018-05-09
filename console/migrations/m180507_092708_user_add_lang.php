<?php

use yii\db\Migration;

/**
 * Class m180507_092708_user_add_lang
 */
class m180507_092708_user_add_lang extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'lang', $this->string(5)->defaultValue('en-US'));
    }

}
