<h3>
    <?= $action == 'create' ?
        Yii::t('app', 'Create') :
        Yii::t('app', 'Update')
    ?> item option
</h3>

<?= $this->render('_form', [
    'model' => $formModel,
    'action' => $action,
    'categoriesList' => $categoriesList,
    'measuresList' => $measuresList
]); ?>
