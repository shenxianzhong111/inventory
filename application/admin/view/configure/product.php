{extend name="base:base" /} 
{block name="body"} 
<div class="table-common">
    <div class="left">
        <a href="{:url('product_add')}" title="新增产品" class="btn btn-default"><i class="glyphicon glyphicon-plus"></i> 新增产品</a>
    </div>
    <div class="left">
        <form class="form-inline" action="{:url('product')}" method="get">
            <input type="text" placeholder="识别码/产品名称" name="keyword" value="{$Think.get.keyword}" class="form-control">
            <select name="c_id" class="form-control">
                <option value="">所有分类</option>
                <?php echo html_select(model('product_category')->lists_select_tree(), input('get.c_id')) ?>
            </select>
            <select name="type" class="form-control">
                <option value="">类型</option>
                <?php echo html_select(db('product_type')->column('title', 'id'), input('get.type')) ?>
            </select>
            <select name="page_size"  class="form-control">
                <option value="10" {eq name="Think.get.page_size" value="10"} selected{/eq}>10条/页</option>
                <option value="20" {eq name="Think.get.page_size" value="20"} selected{/eq}>20条/页</option>
                <option value="50" {eq name="Think.get.page_size" value="50"} selected{/eq}>50条/页</option>
                <option value="100" {eq name="Think.get.page_size" value="100"} selected{/eq}>100条/页</option>
            </select> 
            
            <button type="submit" class="btn btn-primary" title="搜索"><i class="glyphicon glyphicon-search"></i> 搜索</button>
        </form>
    </div>
</div>
<p>
    <small><i class="iconfont icon-tishi"></i> 查询到了<strong>{$count}</strong>个产品记录</small>
</p>
{$tpl_list}
{$lists->render()}
{/block}
