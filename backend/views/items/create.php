<?php

$this->params['breadcrumbs'][] = [
    'label' => 'Items',
    'url' => ['/items'],
];

$header = ucfirst($action) . ' item';
$this->title = $header;
$this->params['breadcrumbs'][] = [
    'label' => $header,
];

?>

<?= $this->render('_form', [
    'category' => !empty($category) ? $category : null,
    'item' => $action != 'create' ? $item : null,
    'model' => $formModel,
    'action' => $action,
    'categoriesList' => $categoriesList
]); ?>
