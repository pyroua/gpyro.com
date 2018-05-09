<?php

use yii\helpers\Url;

?>

<!-- Modal -->
<div class="modal fade" id="myModal<?= $id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="<?= Yii::t('back', 'Close'); ?>">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel"><?= Yii::t('back', 'Delete measure'); ?></h4>
            </div>
            <div class="modal-body">
                <?= Yii::t('back', 'Are you shure?'); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?=Yii::t('back', 'Close'); ?></button>
                <a href="<?= Url::to(['measures/delete/' . $id]) ?>" type="button" class="btn btn-danger">
                    <?= Yii::t('back', 'Yes'); ?>
                </a>
            </div>
        </div>
    </div>
</div>