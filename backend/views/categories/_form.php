<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use common\models\ItemOption;
use backend\assets\CategoryAsset;

/* @var $this yii\web\View */
/* @var $model common\models\Measure */
/* @var $form ActiveForm */

CategoryAsset::register($this);

?>

<div class="CategoryForm">
    <?php $form = ActiveForm::begin([
        'method' => 'post',
        'id' => 'create-form',
    ]) ?>
    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'parent')->widget(Select2::class, [
        'data' => $categoriesList,
        'language' => 'en',
        'options' => ['placeholder' => 'Select a parent category...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <div class="form-group field-categoryform-item-options">
        <label class="control-label" for="categoryform-item-options">ItemOptions</label>

        <?= /** @var \common\models\Category $category */
        Select2::widget([
            'value' => !empty($category) ? array_keys($category->itemOptionsArrayList) : [],
            'name' => 'CategoryForm[item_options]',
            'data' => ItemOption::getArrayList(),
            'language' => 'en',
            'options' => [
                'placeholder' => 'Select a option...',
                'multiple' => true,
            ],
            'pluginOptions' => [
                'allowClear' => true
            ],
            'pluginEvents' => [
                "change.select2" => "document.category_engine.onAllOptionSelect",
                "select2:select" => "document.category_engine.onOptionSelect",
                "select2:unselect" => "document.category_engine.onOptionUnselect",
            ],
            'showToggleAll' => false
        ]) ?>
    </div>


    <?php if ($action == 'update') { ?>
        <?php foreach ($category->itemOptions as $itemOption) { ?>
            <?= $this->render('_item_option_block', [
                'itemOption' => $itemOption,
                'category' => !empty($category) ? $category : null
            ]) ?>
        <?php } ?>
    <?php } ?>

    <div class="form-group">
        <?= Html::submitButton(
            $action == 'create' ?
                Yii::t('app', 'Create') :
                Yii::t('app', 'Update'),
            ['class' => 'btn btn-primary'])
        ?>
    </div>
    <?php ActiveForm::end() ?>
</div>

