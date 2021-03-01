{extend name="base:base" /} {block name="body"} 
<div class="table-common">
    <div class="left">
        <a data-toggle="modal" data-target="#modal" class="btn btn-default" href="<?php echo url('bank_add'); ?>"><i class="glyphicon glyphicon-plus"></i> 添加</a>
    </div>
    <div class="left">
        <form class="form-inline" action="{:url('bank')}" method="get">
            <input type="text" placeholder="银行名称或首字母" name="keyword" value="{$Think.get.keyword}" class="form-control">
            <button type="submit" class="btn btn-primary" title="查询银行"><i class="glyphicon glyphicon-search"></i> 搜索</button>
        </form>
    </div>
</div>
<p>
    <small><i class="iconfont icon-tishi"></i> 查询到了<strong>{:count($lists)}</strong>个数据</small>
    <small><i class="fa fa-money"></i> 总额：{$sum} </small>
</p>

{$tpl_list}

{/block}
