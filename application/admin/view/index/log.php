{extend name="base:base" /}
{block name="body"} 
<div class="table-common">
    <form class="form-inline" action="{:url('log')}" method="get">
        <input type="text" placeholder="动作/IP/地址" name="keyword" value="{$Think.get.keyword}" class="form-control input-medium" />
        <input style="width:110px" type="text" class="datetime_search form-control" name="timea" value="{$Think.get.timea}" placeholder="开始日期" />
        <i class="fa fa-arrows-h"></i>
        <input style="width:110px" type="text" class="datetime_search form-control" name="timeb" value="{$Think.get.timeb}" placeholder="结束日期" />
        <div class="btn-group" data-toggle="buttons-radio">
            <button type="button" onclick="$('#statusinput').val(1)" class="btn btn-default  {eq name='Think.get.status' value='1'}active{/eq} ">成功</button>
            <button type="button" onclick="$('#statusinput').val(0)" class="btn btn-default  {eq name='Think.get.status' value='0'}active{/eq} ">失败</button>
            <button type="button" onclick="$('#statusinput').val('')" class="btn btn-default  {eq name='Think.get.status' value=''}active{/eq} ">全部</button>
        </div>
        <select name="page_size"  class="form-control">
            <option value="10" {eq name="Think.get.page_size" value="10"} selected{/eq}>10条/页</option>
            <option value="20" {eq name="Think.get.page_size" value="20"} selected{/eq}>20条/页</option>
            <option value="50" {eq name="Think.get.page_size" value="50"} selected{/eq}>50条/页</option>
            <option value="100" {eq name="Think.get.page_size" value="100"} selected{/eq}>100条/页</option>
        </select> 
        <button type="submit" class="btn btn-primary input-small" title="查询银行"><i class="glyphicon glyphicon-search"></i> 搜索</button>
        <a href="<?php echo url('log_clear') ?>" class='btn btn-danger ajax-get confirm'><i class='glyphicon glyphicon-trash'></i> 日志清理</a> 　
    </form>
</div>
<p>
    <small><i class="iconfont icon-tishi"></i> 查询到了<strong>{$count}</strong>个日志</small>
</p>
<?php if (count($lists) == 0) { ?>
    <p class="bg-warning center-block">   
        <i class="iconfont icon-wushuju"></i> 暂时没有相关数据
    </p>
<?php } else { ?>
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>动作</th>
                <th>操作人</th>
                <th>状态</th>
                <th>客户端</th>
                <th>时间</th>
                <th>IP</th>
                <th>URL</th>
            </tr>
        </thead>
        <tbody>
            {volist name="lists" id="var"}
            <tr>
                <td>{$var.title}</td>
                <td>{$var.nickname}</td>
                <td>{$var.status?'<span class="label label-success">成功</span>':'<span class="label label-important">失败</span>'}</td>
                <td>{$var.client}</td>
                <td>{$var.create_time}</td>
                <td>{$var.ip}</td>
                <td style="width:200px">{$var.url}</td>
            </tr>
            {/volist}
        </tbody>
    </table>
    {$lists->render()}
<?php } ?>    
{/block}