<?php

use backend\helpers\ViewHelper;

echo dmstr\widgets\Menu::widget(
    [
        'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
        'items' => [
            [
                'label' => Yii::t('app', 'Users'),
                'url' => ['/user/admin/index'],
                'icon' => ' fa-users',
                'visible' => Yii::$app->user->can('manageUsers')
            ],
            [
                'label' => Yii::t('app', 'Categories'),
                'url' => ['/categories'],
                'icon' => ' fa-align-justify',
                'active' => ViewHelper::isActive($this->context, 'categories', ['index', 'create', 'update']),
                'visible' => Yii::$app->user->can('categories') ||
                    Yii::$app->user->can('deleteCategory') ||
                    Yii::$app->user->can('addEditCategory')
            ],
            [
                'label' => Yii::t('app', 'Measures'),
                'url' => ['/measures'],
                'icon' => ' fa-arrows-v',
                'active' => ViewHelper::isActive($this->context, 'measures', ['index', 'create', 'update']),
                'visible' => Yii::$app->user->can('measures') ||
                    Yii::$app->user->can('deleteMeasure') ||
                    Yii::$app->user->can('addEditMeasure')
            ],
            [
                'label' => Yii::t('app', 'Items'),
                'url' => ['/items'],
                'icon' => '  fa-cart-plus',
                'active' => ViewHelper::isActive($this->context, 'items', ['index', 'create', 'update']),
                'visible' => Yii::$app->user->can('items') ||
                    Yii::$app->user->can('deleteItems') ||
                    Yii::$app->user->can('addEditItems')
            ],
            [
                'label' => Yii::t('app', 'Item options'),
                'url' => ['/item-options'],
                'active' => ViewHelper::isActive($this->context, 'item-options', ['index', 'create', 'update']),
                'visible' => Yii::$app->user->can('itemOptions') ||
                    Yii::$app->user->can('deleteItemOption') ||
                    Yii::$app->user->can('addEditItemOption')
            ],
            [
                'label' => 'Gii',
                'icon' => 'file-code-o',
                'url' => ['/gii'],
                'visible' => Yii::$app->user->can('developerTools')
            ],
            [
                'label' => 'Debug',
                'icon' => 'dashboard',
                'url' => ['/debug'],
                'visible' => Yii::$app->user->can('developerTools')
            ],
            [
                'label' => 'Login',
                'url' => ['main/login'],
                'visible' => Yii::$app->user->isGuest
            ],
            [
                'label' => 'Some tools',
                'icon' => 'share',
                'url' => '#',
                'items' => [
                    [
                        'label' => 'Gii',
                        'icon' => 'file-code-o',
                        'url' => ['/gii'],
                        Yii::$app->user->can('developerTools')
                    ],
                    [
                        'label' => 'Debug',
                        'icon' => 'dashboard',
                        'url' => ['/debug'],
                        Yii::$app->user->can('developerTools')
                    ],
                    /*[
                        'label' => 'Level One',
                        'icon' => 'circle-o',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                            [
                                'label' => 'Level Two',
                                'icon' => 'circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                    ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                ],
                            ],
                        ],
                    ],*/
                ],
            ],
        ],
    ]
) ?>