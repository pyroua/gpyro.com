<?php

use backend\assets\items\ItemIndexAsset;
use kartik\select2\Select2;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\helpers\Html;


/* @var $this yii\web\View */

$header = 'Items';
$this->title = $header;
$this->params['breadcrumbs'][] = [
    'label' => 'Items',
];

ItemIndexAsset::register($this);
?>

<?php if (Yii::$app->user->can('addEditItems')) { ?>
    <div>
        <a href="<?= Url::to(['items/create' . (isset($category) ? '/' . $category->id : '')]) ?>" type="button"
           class="btn btn-primary ">
            Add new
        </a>
    </div>
<?php } ?>

<div class="form-group field-itemform-title required">
    <label class="control-label" for="itemform-title"></label>
    <?= Select2::widget([
        'value' => isset($category) ? $category->id : null,
        'name' => 'category',
        'data' => $categoriesList,
        'language' => 'en',
        'options' => ['placeholder' => 'Select a category...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
        'pluginEvents' => [
            "change" => "document.item_index.onCategoryChange",
        ]
    ]) ?>
</div>

<?php if (!empty($categoryId)) { ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'title',
            'article',
            'price',
            'description',
            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['class' => 'text-right'],
                'template' => '{update} {delete}',
                'buttons' => [
                    'update' => function ($url, $model) {
                        return Yii::$app->user->can('addEditItems') ?
                            Html::a(
                                '<span class="glyphicon glyphicon-edit"></span> Edit',
                                $url, [
                                'class' => 'btn btn-default btn-xs'
                            ]) : '';
                    },
                    'delete' => function ($url, $model, $key) {
                        return Yii::$app->user->can('deleteItems') ?
                            Html::button(
                                '<span class="glyphicon glyphicon-remove"></span> Delete',
                                [
                                    'class' => 'btn btn-danger btn-xs',
                                    'data-toggle' => 'modal',
                                    'data-target' => '#myModal' . $model->id
                                ]) . $this->render('_modal_confirm', ['id' => $model->id]) :
                            '';
                    },
                ],
            ],
        ]
    ]); ?>
<?php } ?>
