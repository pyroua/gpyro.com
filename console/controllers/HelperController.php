<?php

namespace console\controllers;

use yii\rbac\DbManager;
use common\modules\i18n\models\SourceMessage;
use common\modules\i18n\models\Message;

class HelperController extends \yii\console\Controller
{

    /**
     * @param int $userId
     * @throws \Exception
     */
    public function actionMakeAdmin(int $userId)
    {
        try {
            $auth = new DbManager;
            $auth->init();
            $role = $auth->getRole('admin');
            $auth->assign($role, $userId);

            $this->stdout($this->ansiFormat("OK \n", \yii\helpers\Console::FG_GREEN));
        } catch (\Exception $e) {
            $this->stderr($this->ansiFormat('ERROR: ', \yii\helpers\Console::FG_RED));
            $this->stderr($e->getMessage() . "\n");
            $this->stderr($e->getTraceAsString());
        }
    }

    public function actionTranslateGenerator()
    {
        foreach (\Yii::$app->getI18n()->languages as $lang) {

            $source = SourceMessage::find()->all();

            $result = [];
            foreach ($source as $sourceMessage) {
                $translation = $sourceMessage->messages;
                if (empty($translation[$lang]) || $translation[$lang]->translation == null) {
                    continue;
                }
                $result[$sourceMessage->message] = $translation[$lang]->translation;
            }

            $file = \Yii::getAlias('@backend/web/js/i18n/' . $lang . '.js');
            @unlink(\Yii::getAlias($file));
            file_put_contents($file, 'window.ttData = ' . json_encode($result) . ';');
        }
    }

}