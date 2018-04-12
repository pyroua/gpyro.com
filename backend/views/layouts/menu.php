<?php

use backend\helpers\ViewHelper;

echo dmstr\widgets\Menu::widget(
    [
        'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
        'items' => [
            [
                'label' => Yii::t('app', 'Users'),
                'url' => ['/user/admin/index'],
                'icon' => ' fa-users'
            ],
            [
                'label' => Yii::t('app', 'Categories'),
                'url' => ['/categories'],
                'icon' => ' fa-align-justify',
                'active' => ViewHelper::isActive($this->context, 'categories', ['index', 'create', 'update']),
                'visible' => Yii::$app->user->can('categories') || Yii::$app->user->can('deleteCategory') || Yii::$app->user->can('addEditCategory')
            ],
            [
                'label' => Yii::t('app', 'Measures'),
                'url' => ['/measures'],
                'icon' => ' fa-arrows-v',
                'active' => ViewHelper::isActive($this->context, 'measures', ['index', 'create', 'update'])
            ],
            [
                'label' => Yii::t('app', 'Item options'),
                'url' => ['/item-options'],
                'active' => ViewHelper::isActive($this->context, 'item-options', ['index', 'create', 'update'])
            ],
            [
                'label' => 'Gii',
                'icon' => 'file-code-o',
                'url' => ['/gii']],
            [
                'label' => 'Debug',
                'icon' => 'dashboard',
                'url' => ['/debug']],
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
                    ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                    ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
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