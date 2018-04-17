<?php

$header = ucfirst($action) . ' item option';

$this->params['breadcrumbs'][] = [
    'label' => 'Item options',
    'url' => ['/item-options'],
];

$this->params['breadcrumbs'][] = [
    'label' => $header,
];

?>

<h3>
    <?= $header?>
</h3>

<?= $this->render('_form', [
    'model' => $formModel,
    'action' => $action,
    'categoriesList' => $categoriesList,
    'measuresList' => $measuresList
]); ?>
