<?php

$this->params['breadcrumbs'][] = [
    'label' => 'Currencies',
    'url' => ['/currencies'],
];

$header = ucfirst($action) . ' currency';
$this->title = $header;
$this->params['breadcrumbs'][] = [
    'label' => $header,
];

?>

<?= $this->render('_form', [
    'model' => $formModel,
    'action' => $action
]); ?>
