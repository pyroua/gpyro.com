<?php

return [
    [
        'pattern' => '/',
        'route' => 'main/index',
    ],
    '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
    '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
];