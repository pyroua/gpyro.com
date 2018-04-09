<?php


use yii\helpers\Html;


$menuItems = [
    ['label' => Yii::t('app', 'Home'), 'url' => ['/main']],
    ['label' => Yii::t('app', 'Users'), 'url' => ['/users']],
    ['label' => Yii::t('app', 'Categories'), 'url' => ['/categories']],
    ['label' => Yii::t('app', 'Items'), 'url' => ['/items']],
    ['label' => Yii::t('app', 'Item options'), 'url' => ['/item-options']],
    ['label' => Yii::t('app', 'Measures'), 'url' => ['/item-measures']],
];
if (Yii::$app->user->isGuest) {
    $menuItems[] = ['label' => 'Login', 'url' => ['/main/login']];
} else {
    $menuItems[] = '<li>'
        . Html::beginForm(['/main/logout'], 'post')
        . Html::submitButton(
            'Logout (' . Yii::$app->user->identity->username . ')',
            ['class' => 'btn btn-link logout']
        )
        . Html::endForm()
        . '</li>';
}

return $menuItems;

?>