<?php

if(isset($_SERVER['HTTP_HOST']) && substr($_SERVER['HTTP_HOST'], 0, 3) == 'dev') {
    $user = 'dev';
    $pass = 'wJ*$Hu?@f6f5p$ph';

    if (!isset($_SERVER['PHP_AUTH_USER'])) {
        header('WWW-Authenticate: Basic realm="http://test"');
        header('HTTP/1.0 401 Unauthorized');
        echo 'Пользователь нажал кнопку Cancel admin';
        exit();
    } else {
        if (($_SERVER['PHP_AUTH_USER'] != $user) || ($_SERVER['PHP_AUTH_PW'] != $pass)) {
            header('WWW-Authenticate: Basic realm="http://test"');
            header('HTTP/1.0 401 Unauthorized');
            echo 'Пользователь нажал кнопку Cancel';
            exit();
        }
    }
}

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/web.php';

(new yii\web\Application($config))->run();
