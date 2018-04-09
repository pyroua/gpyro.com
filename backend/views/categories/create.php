<?php

?>

<h3>
    <?= $action == 'create' ?
        Yii::t('app', 'Create') :
        Yii::t('app', 'Update')
    ?> category
</h3>

<?= $this->render('_form', ['model' => $formModel, 'action' => $action]); ?>
