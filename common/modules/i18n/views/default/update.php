<?php
/**
 * @var View $this
 * @var SourceMessage $model
 */

use yii\helpers\Html;
use yii\web\View;
use common\modules\I18n\models\SourceMessage;
use common\modules\I18n\Module;
use yii\widgets\Breadcrumbs;
use yii\widgets\ActiveForm;

/** @var SourceMessage $model */
$this->title = Module::t('Update') . ': ' . $model->message;

echo Breadcrumbs::widget(['links' => [
    ['label' => Module::t('Translations'), 'url' => ['index']],
    ['label' => $this->title]
]]);
?>
<div class="message-update">
    <div class="message-form">
        <h3 class="top attached"><?= Module::t('Source message') ?></h3>
        <h4 class="bottom attached"><?=Html::encode($model->message)?></h4>
        <?php $form = ActiveForm::begin(); ?>
        <div class="field">
            <div class="ui grid">
                <?php foreach ($model->messages as $language => $message) : ?>
                    <div class="four wide column">
                        <?= $form->field($model->messages[$language], '[' . $language . ']translation')->label($language) ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?= Html::submitButton(Module::t('Update'), ['class' => 'ui primary button']) ?>
        <?php $form::end(); ?>
    </div>
</div>
