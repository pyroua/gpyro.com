<?php

use yii\helpers\Html;

?>

<?php foreach ($options as  $option) { ?>

    <div class="form-group field-itemform-article">
        <label class="control-label" for="itemform-article"><?=Html::label(ucfirst($option->title))?></label>
        <?=Html::textInput('ItemForm[option_id_' . $option->id . ']', null, [
            'id' => 'item-form-option-id-' . $option->id,
            'class' => 'form-control'
        ])?>
    </div>

<?php } ?>