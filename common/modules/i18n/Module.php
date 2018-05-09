<?php

namespace common\modules\i18n;

use Yii;
use yii\i18n\MissingTranslationEvent;
use common\modules\i18n\models\SourceMessage;
use common\modules\i18n\i18nTrait;

class Module extends \yii\base\Module
{

    use i18nTrait;

    public $pageSize = 50;

    public static function t($message, $params = [], $language = null)
    {
        return Yii::t('back', $message, $params, $language);
    }

    /**
     * @param MissingTranslationEvent $event
     */
    public static function missingTranslation(MissingTranslationEvent $event)
    {
        $category = $event->category;
        if (array_key_exists($event->category, self::getOverloadCats())) {
            $category = '*';
        }

        $driver = Yii::$app->getDb()->getDriverName();
        $caseInsensitivePrefix = $driver === 'mysql' ? 'binary' : '';
        $sourceMessage = SourceMessage::find()
            ->where('category = :category and message = ' . $caseInsensitivePrefix . ' :message', [
                ':category' => $category,
                ':message' => $event->message
            ])
            ->with('messages')
            ->one();

        if (!$sourceMessage) {
            $sourceMessage = new SourceMessage;
            $sourceMessage->setAttributes([
                'category' => $category,
                'message' => $event->message
            ], false);
            $sourceMessage->save(false);
        }
        $sourceMessage->initMessages();
        $sourceMessage->saveMessages();
    }
}
