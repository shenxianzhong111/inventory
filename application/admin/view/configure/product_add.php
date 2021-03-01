{extend name="base:base" /} {block name="body"} 

<div class="table-common">
    <div class="left">
        <a class="btn btn-default" href="<?php echo url('product') ?>"><i class="glyphicon glyphicon-menu-left"></i> 返回列表</a>
        <button type="submit" class="btn btn-primary ajax-post" target-form="form-horizontal"><i class="glyphicon glyphicon-floppy-disk"></i> 保存</button>
    </div>
</div>
<form class="form-horizontal" action="{:url('product_add')}" method="post">
    {$tpl_form}
</form>
{/block}
