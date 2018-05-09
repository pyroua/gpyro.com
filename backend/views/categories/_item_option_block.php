<?php

use yii\helpers\Html;

/** @var common\models\Category $category */
?>

<div class="form-group field-categoryform-item-option" id="item-form-option-id-<?= $itemOption->id ?>">
    <label class="control-label" for="categoryform-article">
        <?= Html::label(ucfirst($itemOption->title)) ?>
    </label>

    <?= Html::checkbox(
        'CategoryForm[required][]',
        !empty($category) ? $category->isItemOptionRequired($itemOption->id) : false,
        ['value' => $itemOption->id]
    ) ?>
    <?=Yii::t('back', 'Required')?>
</div>
