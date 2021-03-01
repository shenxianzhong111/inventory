{extend name="base:base" /} {block name="body"} 
<div class="table-common">
    <div class="left">
        <a href="{:url('add')}" title="新增会员" class="btn btn-default"><i class="glyphicon glyphicon-plus"></i> 新增会员</a>
    </div>
    <div class="left">
        <form class="form-inline" action="{:url('index', ['pinyin'=>$pinyin])}" method="get">
            <select name="g_id" class="form-control">
                <option value="">会员分组</option>
                <?php echo html_select(model('member_group')->lists_select_tree(), request()->get('g_id')) ?>
            </select>
            <input style="width: 150px;" type="text" class="form-control" name="keyword" value="{$Think.get.keyword}" placeholder="姓名搜索" />
            <select name="page_size"  class="form-control">
                <option value="10" {eq name="Think.get.page_size" value="10"} selected{/eq}>10条/页</option>
                <option value="20" {eq name="Think.get.page_size" value="20"} selected{/eq}>20条/页</option>
                <option value="50" {eq name="Think.get.page_size" value="50"} selected{/eq}>50条/页</option>
                <option value="100" {eq name="Think.get.page_size" value="100"} selected{/eq}>100条/页</option>
            </select> 
            <button type="submit" class="btn btn-primary" title="查询会员"><i class="glyphicon glyphicon-search"></i> 搜索</button>
    </div>
</div>
<p>
    <small><i class="iconfont icon-tishi"></i> 查询到了<strong>{$count}</strong>个会员</small>
</p>
{$tpl_list}
{$lists->render()}
{/block}