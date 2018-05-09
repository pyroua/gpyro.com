<?php

namespace common\modules\i18n;

use Yii;
use yii\base\BootstrapInterface;
use yii\data\Pagination;
use common\modules\i18n\console\controllers\I18nController;

class Bootstrap implements BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        if ($app instanceof \yii\web\Application && $i18nModule = Yii::$app->getModule('i18n')) {

            $moduleId = $i18nModule->id;
            $app->getUrlManager()->addRules([
                'translations/<id:\d+>' => $moduleId . '/default/update',
                'translations/page/<page:\d+>' => $moduleId . '/default/index',
                'translations' => $moduleId . '/default/index',
            ], false);

            Yii::$container->set(Pagination::class, [
                'pageSizeLimit' => [1, 100],
                'defaultPageSize' => $i18nModule->pageSize
            ]);
        }
        if ($app instanceof \yii\console\Application) {
            if (!isset($app->controllerMap['i18n'])) {
                $app->controllerMap['i18n'] = I18nController::class;
            }
        }
    }
}
