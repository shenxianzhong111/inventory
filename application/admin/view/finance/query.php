{extend name="base:base" /} {block name="body"} 

<div class="table-common">


    <form class="form-inline" id="financequery" action="{:url('query')}" method="get">
        <div class="search-box">
            <input size="16" type="text" class="form-control form_datetime" name="timea" value="{$Think.get.timea}" placeholder="创建开始日期">
            <i class="fa fa-arrows-h"></i>
            <input size="16" type="text" class="form-control form_datetime" name="timeb" value="{$Think.get.timeb}" placeholder="创建结束日期">


            <select name="b_id" class="form-control">
                <option value="">银行</option>
                <?php echo html_select(db('finance_bank')->column('name', 'id'), request()->get('b_id')) ?>
            </select>
            <select name="attn_id" class="form-control">
                <option value="">经办人</option>
                <?php echo html_select(db('system_user')->column('nickname', 'id'), request()->get('attn_id')) ?>
            </select>
            <input style="width: 150px;" type="text" class="form-control" name="remark" value="{$Think.get.remark}" placeholder="备注" />
            <select name="page_size"  class="form-control">
                <option value="10" {eq name="Think.get.page_size" value="10"} selected{/eq}>10条/页</option>
                <option value="20" {eq name="Think.get.page_size" value="20"} selected{/eq}>20条/页</option>
                <option value="50" {eq name="Think.get.page_size" value="50"} selected{/eq}>50条/页</option>
                <option value="100" {eq name="Think.get.page_size" value="100"} selected{/eq}>100条/页</option>
            </select> 


            <span id="finance_category"> 
                <select class="form-control finance_type" name="type" data-value="{$Think.get.type}"></select>
                <select class="form-control finance_c_id input-medium" name="c_id" data-value="{$Think.get.c_id}" ></select>
            </span>
            <button type="submit" class="btn btn-primary" title="搜索"><i class="glyphicon glyphicon-search"></i> 搜索</button>
            <button class="btn btn-success export" title="导出"><i class="glyphicon glyphicon-share-alt"></i> 导出</button>    
            <button type="button" class="btn btn-default" 
                    id="print"
                    title="打印入库单" 
                    val="<?php echo url('prints/finance_list'); ?>" 
                    >
                <i class="glyphicon glyphicon-print"></i> 打印</button>
        </div>
    </form>


</div>
<p>
    <small><i class="iconfont icon-tishi"></i> 查询到了<strong>{$count}</strong>个账务记录&nbsp;&nbsp;
        {if !empty($revenue)}收入(+)：<strong>{$revenue}</strong>{/if} &nbsp; 
        {if !empty($expenditure)}支出(-)：<strong>{$expenditure}</strong>{/if}
    </small>
</p>
{$tpl_list}
{$lists->render()}
{/block}
{block name="foot_js"}
<script type="text/javascript">
    require(['jquery', 'cxSelect', 'datetimepicker'], function ($, cxSelect, datetimepicker) {
        
        $('#finance_category').cxSelect({
            selects: ['finance_type', 'finance_c_id'],
            url: "{:url('json/finance_category')}",
            nodata: "none",
            jsonValue: "v",
        });
        post_sisyphus();


        $('.form_datetime').datetimepicker({lang: 'zh', format: 'Y-m-d', timepicker: false, closeOnDateSelect: true});


        $('.export').click(function () {
            var data = $('#financequery').serialize();
            var url = '<?php echo url('query'); ?>?' + data.toString() + '&export=1';
            location.href = url;
            return false;
        });
    });
</script>
{/block}