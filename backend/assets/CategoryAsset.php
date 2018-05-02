<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * backend application asset bundle.
 */
class CategoryAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [];
    public $js = [
        '/js/categories/search.js',
        '/js/categories/create_form.js'
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];

}
