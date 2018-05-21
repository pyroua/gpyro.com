<?php

return [
    'name' => 'dev.gpyro.com',
    'language' => 'en-US',
    'sourceLanguage' => 'en-US',
    'bootstrap' => [
        'dvizh\order\Bootstrap',
        'common\modules\i18n\Bootstrap',
    ],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'db' => require 'db.php',

        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],

        'i18n' => [
            'class' => common\modules\i18n\components\i18n::class,
            'languages' => ['ru-RU'],
            'messageTable' => 'i18n_messages',
            'sourceMessageTable' => 'i18n_source_messages',
        ],

        'authManager' => [
            'class' => 'dektrium\rbac\components\DbManager',
        ],

        'view' => [
            'theme' => [
                'pathMap' => [
                    '@dektrium/rbac/views' => '@vendor/cinghie/yii2-user-extended/views',
                    '@dektrium/user/views' => '@vendor/cinghie/yii2-user-extended/views',
                    '@vendor/dvizh/yii2-cart/src/views/default' => '@frontend/views/cart/',
                    '@dektrium/user/admin/views/_profile' => '@backend/views/users/_profile'
                ],
            ],
        ],

    ],

    'modules' => [

        'i18n' => common\modules\i18n\Module::class,

        'gridview' => ['class' => 'kartik\grid\Module'],

        // Yii2 RBAC
        'rbac' => [
            'class' => 'dektrium\rbac\RbacWebModule',
        ],
        // Yii2 User
        'user' => [
            'class' => 'dektrium\user\Module',
            'enableFlashMessages' => false,

            // Yii2 User Controllers Overrides
            'controllerMap' => [
                'admin' => 'backend\controllers\AdminController',
                //'settings' => 'cinghie\userextended\controllers\SettingsController'
                'settings' => 'common\controllers\User\SettingsController'
            ],
            // Yii2 User Models Overrides
            'modelMap' => [
                'RegistrationForm' => 'cinghie\userextended\models\RegistrationForm',
                'Profile' => 'cinghie\userextended\models\Profile',
                'SettingsForm' => 'cinghie\userextended\models\SettingsForm',
                'User' => 'cinghie\userextended\models\User',
            ],
        ],
        // Yii2 User Extended
        'userextended' => [
            'class' => 'cinghie\userextended\Module',
            'avatarPath' => '@storage/img/users/', // Path to your avatar files
            'avatarURL' => '/storage/img/users/', // Url to your avatar files
            'defaultRole' => '',
            'avatar' => true,
            'bio' => false,
            'captcha' => true,
            'birthday' => true,
            'firstname' => true,
            'gravatarEmail' => false,
            'lastname' => true,
            'location' => false,
            'onlyEmail' => false,
            'publicEmail' => false,
            'website' => false,
            'templateRegister' => '_two_column',
            'signature' => true,
            'terms' => true,
            'showTitles' => true, // Set false in adminLTE
        ],

        'order' => [
            'class' => 'dvizh\order\Module',
        ],

    ],

];
