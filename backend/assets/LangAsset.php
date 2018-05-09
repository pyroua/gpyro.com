<?php

namespace backend\assets;

use Yii;
use yii\base\Exception;
use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class LangAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [];
    public $js = [];
    public $depends = [
        //'backend\assets\TwitterCldrAsset' // не видаляти! це знадобиться у майбутньому
    ];

    public function init()
    {
        parent::init();

        if (empty(Yii::$app->language)) {
            throw new Exception('Language not set');
        }

        $this->js[] = '/js/i18n/' . Yii::$app->language . '.js';
    }
}
