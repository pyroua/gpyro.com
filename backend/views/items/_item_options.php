<?php

use kartik\date\DatePickerAsset;
use yii\helpers\Html;
use yii\web\View;
use backend\helpers\ViewHelper;

DatePickerAsset::register($this);

/** @var \common\models\ItemOption $data */
/** @var View $this */


$inputValue = null;
if (isset($value->itemOption)) { // $value is item record
    /** @var \common\models\ItemOptionValue $value */
    $data = $value->itemOption;

    // сетим категорію, через яку потім пролізем в таблиц item_option_category
    // щоб взяти звідти занчення поля required
    $data->setCategoryId($value->item->category_id);

    $inputValue = $value->value;
} else { // $value is itemOption
    /** @var \common\models\ItemOption $value */
    $data = $value;
}

// if type Date - add datapicker
if ($data->type == 3) {
    $this->registerJs(
        ViewHelper::getDatapickerJsInitiator('ItemForm[option_id_' . $data->id . ']'),
        View::POS_READY
    );
}

// create validators
$this->registerJs(
    ViewHelper::createDinamycJsValidator(
        'createItemForm',
        'item-form-option-id-' . $data->id,
        'ItemForm[option_id_' . $data->id . ']',
        ViewHelper::getValidatorsByOptionType($data->type, $data->isRequired)
    ),
    View::POS_READY
);
?>
<div class="form-group field-<?= 'item-form-option-id-' . $data->id ?> <?= ($data->isRequired) ? ' required ' : '' ?>">
    <label class="control-label" for="itemform-<?= 'item-form-option-id-' . $data->id ?>">
        <?= Html::label(ucfirst($data->title)) ?>
    </label>

    <?= Html::textInput('ItemForm[option_id_' . $data->id . ']',
        $inputValue,
        [
            'id' => 'item-form-option-id-' . $data->id,
            'class' => 'form-control'
        ]) ?>

    <div class="help-block"></div>
</div>
