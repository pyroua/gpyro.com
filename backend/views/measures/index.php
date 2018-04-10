<?php

use yii\grid\GridView;
use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
?>
<h2>Measures</h2>

<a href="<?= Url::to(['measures/create']) ?>" type="button" class="btn btn-primary ">
    Add new
</a>

<div class="row">
    <div class="col-md-8">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                'title',
                'title_full',
                [
                    'class' => 'yii\grid\ActionColumn',
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
    </div>
</div>

