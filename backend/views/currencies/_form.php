<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Currency */
/* @var $form ActiveForm */
?>
<div class="CurrencyForm">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'title_full') ?>

    <?= $form->field($model, 'symbol') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('back', 'Submit'), ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- CurrencyForm -->
