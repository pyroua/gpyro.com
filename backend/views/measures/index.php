<?php

use yii\grid\GridView;
use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */

$header = Yii::t('back', 'Measures');
$this->title = $header;
$this->params['breadcrumbs'][] = [
    'label' => $header,
];


?>

<a href="<?= Url::to(['measures/create']) ?>" type="button" class="btn btn-success ">
    <?=Yii::t('back', 'Add new'); ?>
</a>

<div class="row">
    <div class="col-md-6">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                'title',
                'title_full',
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
                                    'title' => Yii::t('back', 'Edit'),
                                    'class' => 'btn btn-primary btn-xs'
                                ]);
                        },
                        'delete' => function ($url, $model, $key) {
                            return Html::button(
                                    '<span class="glyphicon glyphicon-remove"></span>',
                                    [
                                        'title' => Yii::t('back', 'Delete'),
                                        'class' => 'btn btn-danger btn-xs',
                                        'data-toggle' => 'modal',
                                        'data-target' => '#myModal' . $model->id
                                    ]) . $this->render('_modal_confirm', ['id' => $model->id]); //add modal
                        },
                    ],
                ],
            ]
        ]); ?>
    </div>
</div>

