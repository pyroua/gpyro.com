<?php

namespace backend\components;

use yii\base\BootstrapInterface;

class LanguageSelector implements BootstrapInterface
{

    /**
     * @param \yii\base\Application $app
     */
    public function bootstrap($app)
    {
        $session = \Yii::$app->session;

        // проверяем что сессия уже открыта
        if (!$session->isActive) {
            $session->open();
        }

        \Yii::$app->language = isset($_SESSION['language']) ? $_SESSION['language'] : \Yii::$app->language;
    }
}