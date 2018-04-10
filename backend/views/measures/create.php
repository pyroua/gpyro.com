<h3>
    <?= $action == 'create' ?
        Yii::t('app', 'Create') :
        Yii::t('app', 'Update')
    ?> measure
</h3>

<?= $this->render('_form', [
    'categoriesList' => $categoriesList,
    'model' => $formModel,
    'action' => $action
]); ?>
