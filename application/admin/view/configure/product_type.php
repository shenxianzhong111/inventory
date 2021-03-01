{extend name="base:base" /}{block name="body"}  
<form class="form-inline" action="{:url('product_category')}" method="get">
    <a href="{:url('product_type_add')}" field="title" title="新增类型" val="" class="btn btn-default prompt"><i class="glyphicon glyphicon-plus"></i> 新增类型</a>
</form>
<hr>
<p>
    <small><i class="iconfont icon-tishi"></i> 查询到了<strong>{$lists|count}</strong>个类型</small>
</p>
{$tpl_list}
{/block}