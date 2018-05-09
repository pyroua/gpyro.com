<?php

use kartik\widgets\Select2;
use yii\widgets\ActiveForm;

?>

<div class="panel panel-primary">
    <div class="order-search-body">
        <div class="panel-body">
            <?php $form = ActiveForm::begin(); ?>
            <div class="col-md-6">
                <?= $form->field($searchModel, 'query')->label(Yii::t('back', 'Query (ID/Title/Description)')) ?>
            </div>

            <div class="col-md-6">
                <?= $form->field($searchModel, 'category_id')
                    ->widget(Select2::class, [
                        'name' => 'category',
                        'data' => $categoriesList,
                        'language' => 'en',
                        'options' => ['placeholder' => Yii::t('back', 'Select a category...')],
                        'pluginOptions' => [
                            'allowClear' => true
                        ]
                    ])->label('Category') ?>
            </div>

            <div class="col-md-6">
                <?= $form->field($searchModel, 'user_id')
                    ->widget(Select2::class, [
                        'name' => 'manufactures',
                        'data' => $manufacturerList,
                        'language' => 'en',
                        'options' => ['placeholder' => Yii::t('back', 'Select a manufacturer...')],
                        'pluginOptions' => [
                            'allowClear' => true
                        ]
                    ])->label(Yii::t('back', 'Manufacturer')) ?>
            </div>

            <div class="col-md-2">
                <input class="btn btn-primary" type="submit" value="<?=Yii::t('back', 'Search'); ?>">
                <input class="btn btn-default" type="reset" value="<?=Yii::t('back', 'Reset'); ?>">
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>