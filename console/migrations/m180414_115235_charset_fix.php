<?php

use yii\db\Migration;

/**
 * Class m180414_115235_charset_fix
 */
class m180414_115235_charset_fix extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("ALTER DATABASE CHARACTER SET utf8 COLLATE utf8_unicode_ci");
        $this->execute("ALTER TABLE categories CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci");
        $this->execute("ALTER TABLE measures CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci");
        $this->execute("ALTER TABLE item_options CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci");
        $this->execute("ALTER TABLE item_option_categories CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci");
        $this->execute("ALTER TABLE item_option_values CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci");
        $this->execute("ALTER TABLE items CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci");
        $this->execute("ALTER TABLE migration CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;");
    }


}
