<span class="action-buttons hide">
   <a href="<?= $editUrl ?>" type="button" class="btn btn-default btn-xs">
       <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit
   </a>

   <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal<?= $id ?>">
       <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Delete
   </button>

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
                    <a href="<?= $deleteUrl ?>" type="button" class="btn btn-danger">Yes</a>
                </div>
            </div>
        </div>
    </div>
</span>
