<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'db' => require 'db.php',
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],

        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages', // if advanced application, set @frontend/messages
                    'sourceLanguage' => 'ru-RU',
                    'fileMap' => [
                        //'main' => 'main.php',
                    ],
                ],
            ],
        ],

        'authManager'  => [
            'class' => 'dektrium\rbac\components\DbManager',
        ],

        'view' => [
            'theme' => [
                'pathMap' => [
                    '@dektrium/rbac/views' => '@vendor/cinghie/yii2-user-extended/views',
                    '@dektrium/user/views' => '@vendor/cinghie/yii2-user-extended/views',
                ],
            ],
        ],

        /*'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'google' => [
                    'class' => 'yii\authclient\clients\Google',
                    'clientId' => 'google_client_id',
                    'clientSecret' => 'google_client_secret',
                ],
                'facebook' => [
                    'class' => 'yii\authclient\clients\Facebook',
                    'clientId' => 'facebook_client_id',
                    'clientSecret' => 'facebook_client_secret',
                ],
                // etc.
            ],
        ]*/
    ],

    'modules' => [
        'gridview' => ['class' => 'kartik\grid\Module'],

        // Yii2 RBAC
        'rbac' => [
            'class' => 'dektrium\rbac\RbacWebModule',

//            'admins' => ['admin2'],
//
//            // Yii2 User Controllers Overrides
//            'controllerMap' => [
//                'role' => 'dektrium\rbac\controllers\RoleController',
//                'permission' => 'dektrium\rbac\controllers\PermissionController',
//            ],
        ],
        // Yii2 User
        'user' => [
            'class' => 'dektrium\user\Module',

            // Yii2 User Controllers Overrides
            'controllerMap' => [
                'admin' => 'backend\controllers\AdminController',
                'settings' => 'cinghie\userextended\controllers\SettingsController'
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
            'avatarPath' => '@webroot/img/users/', // Path to your avatar files
            'avatarURL' => '@web/img/users/', // Url to your avatar files
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
    ],
];
