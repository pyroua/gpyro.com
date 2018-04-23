<?php

use yii\helpers\Url;
use execut\widget\TreeView;

/* @var $this yii\web\View */

$header = 'Categories';
$this->title = $header;
$this->params['breadcrumbs'][] = [
    'label' => $header,
];

?>

<?php if (Yii::$app->user->can('addEditCategory')) : ?>
    <a href="<?= Url::to(['categories/create']) ?>" type="button" class="btn btn-success ">
        Add new
    </a>
<?php endif; ?>

<?= TreeView::widget([
    'data' => $catTree,
    'size' => TreeView::SIZE_NORMAL,
    'header' => 'Categories tree',
    'searchOptions' => [
        'inputOptions' => [
            'placeholder' => 'Search...'
        ],
    ],
    'clientOptions' => [
         'highlightSelected' => false,
//        'onNodeSelected' => '',
//        'onNodeUnselected  ' => $onUnSelect,
        //'selectedBackColor' => 'rgb(40, 153, 57)',
        'borderColor' => '#fff',
        'levels' => 15
    ],
]) ?>