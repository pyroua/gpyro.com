<?php

$this->params['breadcrumbs'][] = [
    'label' => 'Items',
    'url' => ['/items'],
];

$header = ucfirst($action) . ' item';

$this->params['breadcrumbs'][] = [
    'label' => $header,
];

?>

<h3>
    <?= $header ?>
</h3>


<?= $this->render('_form', [
    'category' => !empty($category) ? $category : null,
    'item' => $action != 'create' ? $item : null,
    'model' => $formModel,
    'action' => $action,
    'categoriesList' => $categoriesList
]); ?>
