<?php

$this->params['breadcrumbs'][] = [
    'label' => 'Categories',
    'url' => ['/categories'],
];

$header = ucfirst($action) . ' category';

$this->params['breadcrumbs'][] = [
    'label' => $header,
];

?>

<h3>
    <?= $header ?>
</h3>

<?= $this->render('_form', [
    'model' => $formModel,
    'action' => $action,
    'categoriesList' => $categoriesList
]); ?>
