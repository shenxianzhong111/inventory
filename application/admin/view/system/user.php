{extend name="base:base" /}
{block name="body"}  
<div class="table-common">
    <div class="left">
        <a data-toggle="modal" data-target="#modal" class="btn btn-default" href="<?php echo url('user_add'); ?>"><i class="glyphicon glyphicon-plus"></i> 添加</a>
    </div>
</div>
{$tpl_list}
{/block}