{extend name="base:base" /} {block name="body"} 
<div class="table-common">
    <div class="search-box">
        <form class="form-inline" action="{:url('sales_returns_query')}" method="get">
            
            <input size="16" type="text" class="datetime_search form-control" name="timea" value="{$Think.get.timea}" placeholder="创建开始日期">
            <i class="fa fa-arrows-h"></i>
            <input size="16" type="text" class="datetime_search form-control" name="timeb" value="{$Think.get.timeb}" placeholder="创建结束日期">
            
            <input type="text" placeholder="订单号" name="order_number" value="{$Think.get.order_number}" class="form-control">
            <input type="text" placeholder="识别码/产品名称" name="keyword" value="{$Think.get.keyword}" class="form-control">
            
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
    <small><i class="iconfont icon-tishi"></i> 查询到了<strong>{$count}</strong>个退货记录</small>
</p>
<?php if (count($lists) == 0) { ?>
    <p class="bg-warning center-block">   
        <i class="iconfont icon-wushuju"></i> 暂时没有相关数据
    </p>
<?php } else { ?>
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>ID</th>                
                <th>会员</th>
                <th>退货数量</th>
                <th>入库</th>
                <th>出库</th>
                <th>退货日期</th>
                <th>操作人</th>
                <th>产品识别码</th>
                <th>产品名称</th>
                <th>产品分类</th>
                <th>产品备注</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($lists as $key => $var) {
                $var['product_data'] = unserialize($var['product_data']);
                ?>
                <tr>
                    <td>{:sprintf("%06d",$var.id)}</td>                    
                    <td>{$var.member_nickname}</td>                    
                    <td>{$var.quantity}</td>
                    <td>{$var.name}</td>
                    <td>{$var.name2}</td>
                    <td>{$var.create_time}</td>
                    <td>{$var.nickname}</td>
                    <td>{$var.product_data.code}</td>
                    <td>{$var.product_data.name}</td>
                    <td>{$var.product_data.category}</td>
                    <td title="{$var.remark}">{$var.remark}</td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
    {$lists->render()}
<?php } ?>
{/block}
