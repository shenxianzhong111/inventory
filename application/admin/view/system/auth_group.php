{extend name="base:base" /} {block name="body"} 
<div class="table-common">
    <div class="left">
        <a class="btn btn-default" href="<?php echo url('auth_group_add'); ?>"><i class="glyphicon glyphicon-plus"></i> 添加</a>
    </div>
</div>
{$tpl_list}
{/block}