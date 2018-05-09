<?php

namespace common\modules\i18n\components;

use yii\base\InvalidConfigException;
use yii\i18n\DbMessageSource;
use common\modules\i18n\i18nTrait;

class i18n extends \yii\i18n\I18N
{

    use i18nTrait;

    /** @var string */
    public $sourceMessageTable = '{{%source_message}}';
    /** @var string */
    public $messageTable = '{{%message}}';
    /** @var array */
    public $languages;
    /** @var array */
    public $missingTranslationHandler = ['common\modules\i18n\Module', 'missingTranslation'];

    public $db = 'db';

    /**
     * @throws InvalidConfigException
     */
    public function init()
    {
        if (!$this->languages) {
            throw new InvalidConfigException('You should configure i18n component [language]');
        }

        if (!isset($this->translations['*'])) {
            $this->translations['*'] = [
                'class' => DbMessageSource::className(),
                'db' => $this->db,
                'sourceMessageTable' => $this->sourceMessageTable,
                'messageTable' => $this->messageTable,
                'on missingTranslation' => $this->missingTranslationHandler
            ];
        }

        if (!isset($this->translations['app']) && !isset($this->translations['app*'])) {
            $this->translations['app'] = [
                'class' => DbMessageSource::className(),
                'db' => $this->db,
                'sourceMessageTable' => $this->sourceMessageTable,
                'messageTable' => $this->messageTable,
                'on missingTranslation' => $this->missingTranslationHandler
            ];
        }
        parent::init();
    }

    /**
     * @param string $category
     * @param string $message
     * @param array $params
     * @param string $language
     * @return string
     * @throws InvalidConfigException
     */
    public function translate($category, $message, $params, $language)
    {
        $messageSource = $this->getMessageSource($category);

        // з бази берем тільки для наших модулів
        if ($category != 'yii' && array_key_exists($category, self::getOverloadCats())) {
            $category = '*';
        }

        $translation = $messageSource->translate($category, $message, $language);
        if ($translation === false) {
            return $this->format($message, $params, $messageSource->sourceLanguage);
        }

        return $this->format($translation, $params, $language);
    }


}
