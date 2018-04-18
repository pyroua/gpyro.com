<?php

$this->params['breadcrumbs'][] = [
    'label' => 'Categories',
    'url' => ['/categories'],
];

$header = ucfirst($action) . ' category';
$this->title = $header;
$this->params['breadcrumbs'][] = [
    'label' => $header,
];

?>

<?= $this->render('_form', [
    'model' => $formModel,
    'action' => $action,
    'categoriesList' => $categoriesList
]); ?>
