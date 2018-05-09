<?php

$this->params['breadcrumbs'][] = [
    'label' => Yii::t('back', 'Currencies'),
    'url' => ['/currencies'],
];

$header = Yii::t('back', ucfirst($action) . ' currency');
$this->title = $header;
$this->params['breadcrumbs'][] = [
    'label' => $header,
];

?>

<?= $this->render('_form', [
    'model' => $formModel,
    'action' => $action
]); ?>
