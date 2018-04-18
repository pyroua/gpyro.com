<?php

return [
    [
        'pattern' => '/',
        'route' => 'site/index',
    ],
    '<controller:[\w-]+>/<action:[\w-]+>/<id:\d+>' => '<controller>/<action>',
    '<controller:[\w-]+>/<action:[\w-]+>' => '<controller>/<action>',
];