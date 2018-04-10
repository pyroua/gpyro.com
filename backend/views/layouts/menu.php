<?= dmstr\widgets\Menu::widget(
    [
        'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
        'items' => [
            ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
            ['label' => Yii::t('app', 'Users'), 'url' => ['/users']],
            ['label' => Yii::t('app', 'Categories'), 'url' => ['/categories']],
            ['label' => Yii::t('app', 'Items'), 'url' => ['/items']],
            ['label' => Yii::t('app', 'Item options'), 'url' => ['/item-options']],
            ['label' => Yii::t('app', 'Measures'), 'url' => ['/item-measures']],
            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
            ['label' => 'Login', 'url' => ['main/login'], 'visible' => Yii::$app->user->isGuest],
            [
                'label' => 'Some tools',
                'icon' => 'share',
                'url' => '#',
                'items' => [
                    ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                    ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                    [
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
                    ],
                ],
            ],
        ],
    ]
) ?>