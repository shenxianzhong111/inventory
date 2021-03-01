<div class="panel panel-default">
    <div class="panel-heading">单位添加
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
    <div class="panel-body">
        <form class="form-horizontal" action="{:url('unit_add')}"  method="POST" >
            <div class="form-group">
                <label class="col-sm-2 control-label">单位<font color="red">*</font></label>
                <div class="col-sm-10 form-inline">
                    <input name="name" class="form-control" type="input" required />
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary ajax-post"  target-form="form-horizontal"><i class="glyphicon glyphicon-floppy-disk"></i> 保存</button>                 
                </div>
            </div>
        </form>
    </div>
</div>
