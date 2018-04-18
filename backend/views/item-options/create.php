<?php

$header = ucfirst($action) . ' item option';
$this->title = $header;
$this->params['breadcrumbs'][] = [
    'label' => 'Item options',
    'url' => ['/item-options'],
];

$this->params['breadcrumbs'][] = [
    'label' => $header,
];

?>

<?= $this->render('_form', [
    'model' => $formModel,
    'action' => $action,
    'categoriesList' => $categoriesList,
    'measuresList' => $measuresList
]); ?>
