<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * backend application asset bundle.
 */
class ItemOptionsAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [];
    public $js = [

        '/js/item_options/create_form.js'

    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];

}
