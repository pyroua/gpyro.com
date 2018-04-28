<?php

use yii\grid\GridView;
use yii\helpers\Url;
use yii\helpers\Html;
use \common\models\ItemOption;

/* @var $this yii\web\View */

$header = 'Item options';
$this->title = $header;
$this->params['breadcrumbs'][] = [
    'label' => $header,
];

?>

<a href="<?= Url::to(['item-options/create']) ?>" type="button" class="btn btn-success ">
    Add new
</a>


<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'title',
        'description',
        'type' => [
            'attribute' => 'Type',
            'content' => function ($model) {
                return ItemOption::getTypes()[$model->type];
            }
        ],
        'default_value',
        [
            'attribute' => 'Measure',
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
            'content' => function ($model) {
                /** @var \common\models\Measure $model */
                return !empty($model->measure) ? $model->measure->title : '';
            }
        ],
        [
            'attribute' => 'required',
            'contentOptions' => ['class' => 'text-center'],
            'headerOptions' => ['class' => 'text-center'],
            'content' => function ($model) {
                /** @var \common\models\Measure $model */
                return $model->required ? '<span class="label label-success"><span class="glyphicon glyphicon-ok"></span></span>' : '';
            }
        ],
        [
            'contentOptions' => ['class' => 'text-center', 'style' => 'width:80px;'],
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update} {delete}',
            'buttons' => [
                'update' => function ($url, $model) {
                    return Html::a(
                        '<span class="glyphicon glyphicon-edit"></span>',
                        $url,
                        [
                            'title' => 'Edit',
                            'class' => 'btn btn-primary btn-xs'
                        ]);
                },
                'delete' => function ($url, $model, $key) {
                    return Html::button(
                            '<span class="glyphicon glyphicon-remove"></span>',
                            [
                                'title' => 'Delete',
                                'class' => 'btn btn-danger btn-xs',
                                'data-toggle' => 'modal',
                                'data-target' => '#myModal' . $model->id
                            ]) . $this->render('_modal_confirm', ['id' => $model->id]); //add modal
                },
            ],
        ],
    ]
]); ?>

