<?php

use yii\helpers\Url;
use yii\helpers\Html;
use execut\widget\TreeView;
use backend\assets\CategoryAsset;


CategoryAsset::register($this);

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


<div class="form-group">
    <?= Html::label('Search', 'search')?>
    <?= Html::textInput('search', null, ['class'=> 'form-control', 'placeholder' => 'Search...'])?>
</div>

<?= TreeView::widget([
    'template' =>     TreeView::TEMPLATE_SIMPLE,
    'data' => $catTree,
    'size' => TreeView::SIZE_NORMAL,
    'header' => 'Categories tree',
    'clientOptions' => [
         'highlightSelected' => false,
//        'onNodeSelected' => '',
//        'onNodeUnselected  ' => $onUnSelect,
        //'selectedBackColor' => 'rgb(40, 153, 57)',
        'borderColor' => '#fff',
        'levels' => 15
    ],
]) ?>