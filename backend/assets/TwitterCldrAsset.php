<?php
/**
 * Created by PhpStorm.
 * Author: Stepan Seliuk <stepan@selyuk.com>
 * Date: 31/08/14
 * Time: 19:45
 */

namespace backend\assets;

use Yii;
use yii\web\AssetBundle;

/**
 * Class TwitterCldrAsset
 * @package app\assets
 */
class TwitterCldrAsset extends AssetBundle
{
    // $baseUrl = 'https://raw.githubusercontent.com/twitter/twitter-cldr-js/master/lib/assets/javascripts/twitter_cldr';

    public $sourcePath = '@backend/web/js';

    public $css = [];
    public $js = [
        '/js/twitter_cldr/core.js'
    ];
    public $depends = [];

    public function init()
    {
        parent::init();

        if (empty(Yii::$app->language)) {
            throw new Exception('Language not set');
        }

        $this->js[] = '/js/twitter_cldr/' . Yii::$app->language . '.js';
    }
}