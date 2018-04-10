<?php

use yii\helpers\Url;

?>

<!-- Modal -->
<div class="modal fade" id="myModal<?= $id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Delete category</h4>
            </div>
            <div class="modal-body">
                Are you shure?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <a href="<?= Url::to(['measures/delete/' . $id]) ?>" type="button" class="btn btn-danger">Yes</a>
            </div>
        </div>
    </div>
</div>