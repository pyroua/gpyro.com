<?php

use yii\helpers\Html;

?>

<?php /** @var common\models\Item $item
 */
foreach ($item->itemOptionValues as $itemOptionValue) { ?>
    <div class="form-group field-itemform-article">
        <label class="control-label" for="itemform-article"><?= Html::label($itemOptionValue->itemOption->title) ?></label>
        <?= Html::textInput('ItemForm[option_id_' . $itemOptionValue->itemOption->id . ']',
            $itemOptionValue->string, //TODO: заутлити сюди номральне отримання значення
            [
                'id' => 'item-form-option-id-' . $itemOptionValue->itemOption->id,
                'class' => 'form-control'
            ]) ?>
    </div>
<?php } ?>