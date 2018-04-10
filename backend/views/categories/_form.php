<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\Measure */
/* @var $form ActiveForm */

?>

<div class="CategoryForm">
    <?php $form = ActiveForm::begin([
        'method' => 'post',
        'id' => 'create-form',
    ]) ?>
    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'parent')->widget(Select2::class, [
        'data' => $categoriesList,
        'language' => 'en',
        'options' => ['placeholder' => 'Select a parent category...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>


    <div class="form-group">
        <?= Html::submitButton(
            $action == 'create' ?
                Yii::t('app', 'Create') :
                Yii::t('app', 'Update'),
            ['class' => 'btn btn-primary'])
        ?>
    </div>
    <?php ActiveForm::end() ?>
</div>

