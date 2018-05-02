<?php

use backend\assets\items\ItemIndexAsset;
use kartik\select2\Select2;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\helpers\Html;
use common\helpers\UserHelper;
use frontend\helpers\ItemHelper;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */

$header = 'Items';
$this->title = $header;
$this->params['breadcrumbs'][] = [
    'label' => 'Items',
];

ItemIndexAsset::register($this);
?>

<?= $this->render('_search_form', [
    'category' => !empty($category) ? $category : null,
    'searchModel' => $searchModel,
    'categoriesList' => $categoriesList,
    'manufacturesList' => $manufacturesList
]); ?>

<?php if (Yii::$app->user->can('addEditItems')) { ?>
    <div>
        <a href="<?= Url::to(['items/create' . (isset($category) ? '/' . $category->id : '')]) ?>" type="button"
           class="btn btn-success ">
            Add new
        </a>
    </div>
<?php } ?>

<?php if (!empty($categoryId) || UserHelper::hasRole('admin')) { ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'title',
            'article',
            'price',
            'description',
            [
                'attribute' => 'Photo',
                'contentOptions' => ['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
                'content' => function ($model) {
                    /** @var \common\models\Measure $model */
                    return !empty($model->logo) ? '<span class="label label-success"><span class="glyphicon glyphicon-ok"></span></span>' : '';
                }
            ],
            [
                'contentOptions' => ['class' => 'text-center', 'style' => 'width:100px;'],
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a(
                            '<span class="fa fa-eye"></span>',
                            ItemHelper::getItemUrl($model->id),
                            [
                                'title' => 'Preview on site',
                                'class' => 'btn btn-default btn-xs'
                            ]);
                    },
                    'update' => function ($url, $model) {
                        return Yii::$app->user->can('addEditItems') ?
                            Html::a(
                                '<span class="glyphicon glyphicon-edit"></span>',
                                $url,
                                [
                                    'title' => 'Edit',
                                    'class' => 'btn btn-primary btn-xs'
                                ]) : '';
                    },
                    'delete' => function ($url, $model, $key) {
                        return Yii::$app->user->can('deleteItems') ?
                            Html::button(
                                '<span class="glyphicon glyphicon-remove"></span>',
                                [
                                    'title' => 'Delete',
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
