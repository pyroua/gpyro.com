<?php

use kartik\date\DatePickerAsset;
use yii\helpers\Html;
use yii\web\View;
use backend\helpers\ViewHelper;

DatePickerAsset::register($this);

/** @var \common\models\ItemOption $itemOption */
/** @var View $this */
?>

<?php

foreach ($options as $itemOption) { ?>
    <?= $this->render('_item_options', ['value' => $itemOption]) ?>
<?php } ?>