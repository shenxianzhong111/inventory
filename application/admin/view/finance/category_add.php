<div class="panel panel-default">
    <div class="panel-heading">
        <?php
        echo request()->get('type') == 1 ? '添加收入' : '添加支出';
        ?>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
    <div class="panel-body">
        <form method="post" class="form-horizontal" action="{:url('category_add')}">
            <input type="hidden" name="type" value="{$Think.get.type}" />
            {$tpl_form}
            <div class="form-group form-actions">
                <div class="col-sm-offset-2 col-sm-5">
                    <button type="submit" class="btn btn-primary btn_submit ajax-post" target-form="form-horizontal"><i class="glyphicon glyphicon-floppy-disk"></i>  保存</button>
                </div>        
            </div>
        </form>
    </div>
</div>
