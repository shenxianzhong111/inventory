{extend name="base:base" /} {block name="body"} 
<div class="table-common">
    <div class="left">
        <a data-toggle="modal" data-target="#modal" data-title="新增供应商" href="{:url('supplier_add')}" title="新增供应商" class="btn btn-default"><i class="glyphicon glyphicon-plus"></i> 新增供应商</a>
    </div>
    <div class="left">
        <form class="form-inline" action="{:url('supplier')}" method="get">
            <input type="text" placeholder="供应商名称/联系人姓名" name="keyword" value="{$Think.get.keyword}" class="form-control">
            <button type="submit" class="btn btn-primary" title="搜索"><i class="glyphicon glyphicon-search"></i> 搜索</button>
        </form>
    </div>
</div>
<p>
    <small> <i class="iconfont icon-tishi"></i> 查询到了<strong>{:count($lists)}</strong>个供应商</small>
</p>
{$tpl_list}
{/block}
