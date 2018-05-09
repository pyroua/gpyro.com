<?php

namespace console\helpers;

use common\modules\i18n\console\controllers\I18nController;

class MigrationHelper{

    /**
     * @param $path
     * @param $language
     * @throws \yii\base\Exception
     * @throws \yii\console\Exception
     */
    public function importTranslations($path, $language)
    {
        $c = new I18nController('i18console', 'console');
        $c->actionImportM($path, $language);
    }
}