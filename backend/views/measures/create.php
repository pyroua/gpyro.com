<?php

$this->params['breadcrumbs'][] = [
    'label' => 'Measures',
    'url' => ['/measures'],
];

$header = ucfirst($action) . ' measure';
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
