<?php

use kartik\widgets\Select2;
use yii\widgets\ActiveForm;

?>

<div class="panel panel-primary">
    <div class="order-search-body">
        <div class="panel-body">
            <?php $form = ActiveForm::begin(); ?>
            <div class="col-md-6">
                <?= $form->field($searchModel, 'query')->label('Query (ID/Title/Description)') ?>
            </div>

            <div class="col-md-6">
                <?= $form->field($searchModel, 'category_id')
                    ->widget(Select2::class, [
                        'name' => 'category',
                        'data' => $categoriesList,
                        'language' => 'en',
                        'options' => ['placeholder' => 'Select a category...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ]
                    ])->label('Category') ?>
            </div>

            <div class="col-md-2">
                <input class="btn btn-primary" type="submit" value="Search">
                <input class="btn btn-default" type="reset" value="Reset">
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>