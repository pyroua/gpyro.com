<?php

$this->params['breadcrumbs'][] = [
    'label' => Yii::t('back', 'Categories'),
    'url' => ['/categories'],
];

$header = Yii::t('back', ucfirst($action) . ' category');
$this->title = $header;
$this->params['breadcrumbs'][] = [
    'label' => $header,
];

?>

<?= $this->render('_form', [
    'category' => !empty($category) ? $category : null,
    'model' => $formModel,
    'action' => $action,
    'categoriesList' => $categoriesList
]); ?>
