<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin([
    'method' => 'post',
    'id' => 'create-form',
    'options' => ['class' => 'form-horizontal'],
]) ?>


    <div class="container">
        <div class="row">
            <div class="col-md-4"><?= $form->field($model, 'title') ?></div>
        </div>
        <div class="row">
            <div class="col-md-4"><?= $form->field($model, 'parent') ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <?= Html::submitButton(
                        $action == 'create' ?
                            Yii::t('app', 'Create') :
                            Yii::t('app', 'Update'),
                        ['class' => 'btn btn-primary'])
                    ?>
                </div>
            </div>
        </div>
    </div>



<?php ActiveForm::end() ?>