<?php

$this->params['breadcrumbs'][] = [
    'label' => Yii::t('back', 'Measures'),
    'url' => ['/measures'],
];

$header = Yii::t('back', ucfirst($action) . ' measure');
$this->title = $header;
$this->params['breadcrumbs'][] = [
    'label' => $header,
];

?>

<?= $this->render('_form', [
    'categoriesList' => $categoriesList,
    'model' => $formModel,
    'action' => $action
]); ?>
