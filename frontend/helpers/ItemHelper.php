<?php

namespace frontend\helpers;

use Yii;
use yii\helpers\Url;

class ItemHelper
{


    public static function getItemUrl(int $itemId)
    {
        return Url::to(Yii::$app->params['frontendUrl']. '/item/view/' . $itemId);
    }
}