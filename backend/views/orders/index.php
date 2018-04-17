<?php

use backend\assets\items\ItemIndexAsset;
use kartik\select2\Select2;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
$header = 'Orders';
$this->params['breadcrumbs'][] = [
    'label' => $header,
];

//ItemIndexAsset::register($this);
?>
<h2><?= $header ?></h2>

<?php if (Yii::$app->user->can('addEditOrders')) { ?>
    <div>
        <a href="<?= Url::to(['orders/create']) ?>" type="button" class="btn btn-primary ">
            Add new
        </a>
    </div>
<?php } ?>
