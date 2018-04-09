<?php

use yii\helpers\Url;
use execut\widget\TreeView;
use yii\web\JsExpression;

/* @var $this yii\web\View */
?>
    <h2>Categories</h2>

    <a href="<?= Url::to(['categories/create']) ?>" type="button" class="btn btn-primary ">
        <span class="glyphicon-plus" aria-hidden="true"></span>
        Create
        </a>

<?php

$onSelect = new JsExpression(<<<JS
function (undefined, item) {
    $('span.action-buttons').addClass('hide')
    $(item['$' + 'el']).find('span.action-buttons').removeClass('hide');
}
JS
);

$onUnSelect = new JsExpression(<<<JS
function (undefined, item) {
    console.log(item);
    $(item['$' + 'el']).find('span.action-buttons').addClass('hide');
}
JS
);

?>

<?= TreeView::widget([
    'data' => $catTree,
    'size' => TreeView::SIZE_SMALL,
    'header' => 'Categories tree',
    'searchOptions' => [
        'inputOptions' => [
            'placeholder' => 'Введите название...'
        ],
    ],
    'clientOptions' => [
        'onNodeSelected' => $onSelect,
        'onNodeUnselected  ' => $onUnSelect,
        //'selectedBackColor' => 'rgb(40, 153, 57)',
        'borderColor' => '#fff',
        'levels' => 15
    ],
]) ?>