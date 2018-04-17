<h3>
    <?= $action == 'create' ?
        Yii::t('app', 'Create') :
        Yii::t('app', 'Update')
    ?> item
</h3>


<?= $this->render('_form', [
    'category' => !empty($category) ? $category : null,
    'item' => $action != 'create' ? $item : null,
    'model' => $formModel,
    'action' => $action,
    'categoriesList' => $categoriesList
]); ?>
