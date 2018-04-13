<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        /*'user' => [
            'class' => 'backend\components\User',
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],*/
        /*'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],*/
        /*'user' => [
            'identityCookie' => [
                'name'     => '_backendIdentity',
                'path'     => '/admin',
                'httpOnly' => true,
            ],
        ],
        'session' => [
            'name' => 'BACKENDSESSID',
            'cookieParams' => [
                'httpOnly' => true,
                'path'     => '/admin',
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
            'errorAction' => 'main/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => require 'routs.php',
        ],

        'urlManagerFrontend'=>[
            'enablePrettyUrl' => true,
            'class' => 'yii\web\UrlManager',
            'showScriptName'=>false,
            'suffix' => '.html',
            'hostInfo' => 'http://gp.loc',
            'baseUrl' => 'http://gp.loc',
        ],

        'view' => [
            'theme' => [
                'pathMap' => [
                    '@app/views' => '@backend/views'
                ],
            ],
        ],
    ],
    'params' => $params,

    'modules' => [
        'user' => [
            'class' => 'dektrium\user\Module',
            'as backend' => 'cinghie\userextended\filters\BackendFilter',
            // Settings
            //'enableRegistration' => true,
            'enableUnconfirmedLogin' => false,
            'modelMap' => [
                'User' => 'backend\models\User',
            ],
        ],
    ],
];
