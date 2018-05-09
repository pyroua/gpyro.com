<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use backend\assets\ItemAsset;

/* @var $this yii\web\View */
/* @var $model common\models\Item */
/* @var $form ActiveForm */

ItemAsset::register($this);


?>
<div class="ItemForm">

    <?php $form = ActiveForm::begin([
        'id' => 'createItemForm',
        'options' => ['enctype' => 'multipart/form-data'],
        'enableClientScript' => true,
    ]); ?>

    <?= $form->field($model, 'article') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'price') ?>

    <?= $form->field($model, 'category_id')
        ->widget(Select2::class, [
            'data' => $categoriesList,
            'language' => 'en',
            'disabled' => $action == 'update' ? true : false,
            'options' => [
                    'placeholder' => Yii::t('back', 'Select a category...')
            ],
            'pluginOptions' => [
                'allowClear' => true
            ],
            'pluginEvents' => [
                "change" => "document.item_engine.onCategoryChange",
            ]
        ])->label(Yii::t('back', 'Category')) ?>


    <?php /** @var \common\models\Item $item */
    if (!empty($item->logo)) { ?>
        <div class="row">
            <div class="col-xs-6 col-md-3">
                <a href="#" class="thumbnail">
                    <img src="<?= $item->logoWebPath ?>">
                </a>
            </div>
        </div>
    <?php } ?>

    <?= $form->field($model, 'file')
        ->fileInput()
        ->label(Yii::t('back', 'Photo'))
    ?>

    <?= $form->field($model, 'video_url') ?>

    <?php if ($action == 'update') { ?>
        <?php foreach ($item->itemOptionValues as $itemOptionValue) { ?>
            <?= $this->render('_item_options', ['value' => $itemOptionValue]) ?>
        <?php } ?>
    <?php } ?>

    <div class="default-fields-end"></div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('back', Yii::t('back', 'Submit')), ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- ItemForm -->

