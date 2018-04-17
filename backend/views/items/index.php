<?php

use backend\assets\items\ItemIndexAsset;
use kartik\select2\Select2;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\helpers\Html;


/* @var $this yii\web\View */

$this->params['breadcrumbs'][] = [
    'label' => 'Items',
];

ItemIndexAsset::register($this);
?>
<h2>Items</h2>

<div>
    <a href="<?= Url::to(['items/create' . (isset($category) ? '/' . $category->id : '')]) ?>" type="button"
       class="btn btn-primary ">
        Add new
    </a>
</div>

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

<div>

</div>

<?php if (!empty($categoryId)) { ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'title',
            'article',
            'description',
            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['class' => 'text-right'],
                'template' => '{update} {delete}',
                'buttons' => [
                    'update' => function ($url, $model) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-edit"></span> Edit',
                            $url, [
                            'class' => 'btn btn-default btn-xs'
                        ]);
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::button(
                                '<span class="glyphicon glyphicon-remove"></span> Delete',
                                [
                                    'class' => 'btn btn-danger btn-xs',
                                    'data-toggle' => 'modal',
                                    'data-target' => '#myModal' . $model->id
                                ]) . $this->render('_modal_confirm', ['id' => $model->id]); //add modal
                    },
                ],
            ],
        ]
    ]); ?>
<?php } ?>
