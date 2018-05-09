<?php

use kartik\date\DatePickerAsset;
use yii\web\View;

DatePickerAsset::register($this);

/** @var \common\models\ItemOption $itemOption */
/** @var View $this */
?>

<?php

foreach ($options as $itemOption) { ?>
    <?= $this->render('_item_options', ['value' => $itemOption]) ?>
<?php } ?>