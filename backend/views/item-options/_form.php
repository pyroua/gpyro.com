<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use \common\models\ItemOption;
use backend\assets\ItemOptionsAsset;
use kartik\date\DatePickerAsset;

/* @var $this yii\web\View */
/* @var $model common\models\ItemOption */
/* @var $form ActiveForm */

DatePickerAsset::register($this);
ItemOptionsAsset::register($this);

?>
<div class="form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'type')->dropDownList(
        array_merge(['none' => ''], ItemOption::getTypes()),
        ['onchange' => 'document.item_options_engine.onChangeDataType(this)']
    ); ?>

    <?= $form->field($model, 'measure_id')->widget(Select2::class, [
        'data' => array_merge(['none' => 'None'], $measuresList),
        'language' => 'en',
        'options' => ['placeholder' => 'Select a measure...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Measure') ?>

    <?= $form->field($model, 'categories')->widget(Select2::class, [
        'data' => $categoriesList,
        'language' => 'en',
        'options' => [
            'placeholder' => 'Select a category...',
            'multiple' => true,
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <?= $form->field($model, 'default_value') ?>

    <?php // $form->field($model, 'required')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- _form -->
