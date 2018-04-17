<?php

$this->params['breadcrumbs'][] = [
    'label' => 'Measures',
    'url' => ['/measures'],
];

$header = ucfirst($action) . ' measure';

$this->params['breadcrumbs'][] = [
    'label' => $header,
];

?>

<h3>
    <?= $header ?> measure
</h3>

<?= $this->render('_form', [
    'categoriesList' => $categoriesList,
    'model' => $formModel,
    'action' => $action
]); ?>
