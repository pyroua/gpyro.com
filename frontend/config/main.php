<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => yii\i18n\DbMessageSource::className(),
                    'messageTable' => 'i18n_messages',
                    'sourceMessageTable' => 'i18n_source_messages',
                    'on missingTranslation' => ['common\modules\I18n\Module', 'missingTranslation']
                ],
                'app' => [
                    'class' => yii\i18n\DbMessageSource::className(),
                    'messageTable' => 'i18n_messages',
                    'sourceMessageTable' => 'i18n_source_messages',
                    'on missingTranslation' => ['common\modules\I18n\Module', 'missingTranslation']
                ],
                'yii' => [
                    'class' => yii\i18n\DbMessageSource::className(),
                    'messageTable' => 'i18n_messages',
                    'sourceMessageTable' => 'i18n_source_messages',
                    'on missingTranslation' => ['common\modules\I18n\Module', 'missingTranslation']
                ],
            ]
        ],
        /*'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],*/
        /*'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],*/
        /*'user' => [
            'identityCookie' => [
                'name'     => '_frontendIdentity',
                'path'     => '/',
                'httpOnly' => true,
            ],
        ],
        'session' => [
            'name' => 'FRONTENDSESSID',
            'cookieParams' => [
                'httpOnly' => true,
                'path'     => '/',
            ],
        ],*/
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/404',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => require 'routes.php',
        ],

        'cart' => [
            'class' => 'dvizh\cart\Cart',
            'currency' => '$', //Валюта
            'currencyPosition' => 'before', //after или before (позиция значка валюты относительно цены)
            'priceFormat' => [2, '.', ''], //Форма цены
        ],
    ],
    'params' => $params,

    'modules' => [
        'user' => [
            // following line will restrict access to admin controller from frontend application
            'as frontend' => 'dektrium\user\filters\FrontendFilter'
        ],

        'cart' => [
            'class' => 'dvizh\cart\Module',
        ],

        'order' => [
            'class' => 'dvizh\order\Module',
            'layoutPath' => 'frontend\views\layouts',
            'successUrl' => '/site/thanks', //Страница, куда попадает пользователь после успешного заказа
            'adminNotificationEmail' => 'order@gpyro.com', //Мыло для отправки заказов
            'as order_filling' => '\common\aspects\OrderFilling',
            'currency' => '$',
            'currencyPosition' => 'before',
            'orderStatuses' => ['new' => 'New', 'approve' => 'Approve', 'cancel' => 'Cancel', 'process' => 'In process', 'done' => 'Done'],
            'cartCustomFields' => ['amount' => 'amount']
        ],
    ],
];
