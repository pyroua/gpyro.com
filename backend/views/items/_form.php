<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\Item */
/* @var $form ActiveForm */
?>
<div class="ItemForm">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'article') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'category_id')
        ->widget(Select2::class, [
            'data' => $categoriesList,
            'language' => 'en',
            'options' => ['placeholder' => 'Select a category...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label('Category') ?>

    <?php // $form->field($model, 'logo') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- ItemForm -->
