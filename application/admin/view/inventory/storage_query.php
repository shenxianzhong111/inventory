{extend name="base:base" /} {block name="body"} 
<div class="table-common">
    <form class="form-inline" action="{:url('storage_query')}" method="get">
        <input type="hidden" id="chartinput" name="chart" value="{$chart}" />
        <div class="search-box">            
            <input size="16" type="text" class="datetime_search form-control" name="timea" value="{$Think.get.timea}" placeholder="创建开始日期">
            <i class="fa fa-arrows-h"></i>
            <input size="16" type="text" class="datetime_search form-control" name="timeb" value="{$Think.get.timeb}" placeholder="创建结束日期">

            <input type="text" placeholder="单号/识别码/产品名称" name="keyword" value="{$Think.get.keyword}" class="form-control">


            <select name="warehouse" class="form-control">
                <option value="">所有仓库</option>
                <?php echo html_select($warehouse, input('get.warehouse')) ?>                
            </select>
            <select name="supplier" class="form-control">
                <option value="">所有供应商</option>
                <?php
                echo html_select(db('product_supplier')->column('id,company'), input('get.supplier'))
                ?>                
            </select>
            <select name="c_id" class="form-control">
                <option value="">所有分类</option>
                <?php echo html_select($category, input('get.c_id')); ?>       
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

            <div class="btn-group" data-toggle="buttons-radio">
                <button type="button" onclick="$('#chartinput').val(0); $('form').submit()" class="btn btn-default{:empty($chart)?' active':''}"><i class="fa fa-list-alt"></i> 入库订单</button>
                <button type="button" onclick="$('#chartinput').val(1); $('form').submit()" class="btn btn-default{$chart==='1'?' active':''}"><i class="fa fa-table"></i> 产品列表</button>
            </div>

            <button type="submit" class="btn btn-primary" title="搜索"><i class="glyphicon glyphicon-search"></i> 搜索</button>
            {if $chart==='1'}
            <button type="button" class="btn btn-default" 
                    id="print"
                    title="打印入库单" 
                    url="<?php echo APP_HOST.url('prints/storage_list', ['session_id' => session_id()]); ?>" 
                    >
                <i class="glyphicon glyphicon-print"></i> 打印</button>
            {else/}
            <button class="btn btn-success export" title="导出"><i class="glyphicon glyphicon-share-alt"></i> 导出</button>
            {/if}
        </div>


    </form>
</div>
<p>
    <small><i class="iconfont icon-tishi"></i> 查询到了<strong>{$count}</strong>个入库记录</small>
    <?php if (isset($count_sum)) { ?>
        <small> 总数量<strong>{$count_sum}</strong></small>
    <?php } ?>
</p>
<?php if (isset($lists) && count($lists) > 0) { ?>
    <?php if (empty($chart)) { ?>
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th style="width:20px"></th>
                    <th>编号</th>
                    <th>入库数量</th>
                    <th>金额</th>
                    <th>入库日期</th>
                    <th>操作人</th>
                    <th>供应商</th>
                    <th>入库类型</th>
                    <th>备注</th>
                    <th style="text-align:center">打印</th>
                    <th style="text-align:center">撤消</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($lists as $key => $var) {
                    ?>
                    <tr class="product_data_parent" data-id="{$var.id}">
                        <td class="product_dataplus" id="product_dataplus{$var.id}" style="cursor: pointer"><i class="glyphicon glyphicon-menu-right"></i></td>
                        <td>{$var.order_number}</td>
                        <td>{$var.quantity}</td>
                        <td>{$var.amount}</td>
                        <td>{$var.create_time}</td>
                        <td>{$var.nickname}</td>
                        <td>{$var.company}</td>
                        <td>{$var.type}</td>
                        <td title="{$var.remark}">{$var.remark}</td>
                        <td style="text-align:center">
                            <a href="javascript:;" 
                               class="print btn btn-default btn-xs"
                               url="<?php echo APP_HOST.url('prints/storage_view', ['id' => $var['id'], 'session_id' => session_id()]) ?>"
                               num="<?php echo $var['order_number']; ?>"                       
                               title="打印{$var.id}">打印</a></td>
                        <td style="text-align:center">
                            <a class="btn btn-warning btn-xs ajax-get confirm" href="{:url('storage_undo',['id'=>$var.id])}" title="撤消" >撤消</a>
                        </td>
                    </tr>
                    <tr id="product_data{$var.id}" class="product_data" style="display:none">
                        <td colspan="11">
                            <table class="table table-hover table-striped table-bordered" style="margin-bottom:0px">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>仓库</th>
                                        <th>数量</th>
                                        <th>金额</th>
                                        <th>库存</th>
                                        <th>单位</th>
                                        <th>识别码</th>
                                        <th>产品名称</th>
                                        <th>成本价</th>
                                        <th>产品类型</th>
                                        <th>产品分类</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($var['child'])) {
                                        foreach ($var['child'] as $key2 => $var2) {

                                            $var2['product_data'] = unserialize($var2['product_data']);
                                            ?>
                                            <tr>
                                                <td>{:sprintf("%06d",$var2.id)}</td>
                                                <td>{$var2.warehouse}</td>
                                                <td>{$var2.quantity}</td>
                                                <td>{$var2.amount}</td>
                                                <td>{$var2.inventory_quantity}</td>
                                                <td>{$var2.unit_name}</td>
                                                <td>{$var2.code}</td>
                                                <td>{$var2.name}</td>
                                                <td>{$var2.purchase}</td>
                                                <td>{$var2.product_data.product_type}</td>
                                                <td>{$var2.product_data.category}</td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th colspan="7" style="text-align:center" class="warning">仓库信息</th>
                    <th colspan="5" style="text-align:center" class="success">产品信息</th>
                </tr>
                <tr>
                    <th>ID</th>
                    <th>仓库</th>
                    <th>入库</th>
                    <th>库存</th>
                    <th>单位</th>
                    <th>入库日期</th>
                    <th>入库人</th>
                    <th>识别码</th>
                    <th>产品名称</th>
                    <th>产品类型</th>
                    <th>产品分类</th>
                    <th>供应商</th>
                </tr>
            </thead>
            <tbody>
                {volist name="lists" id="var"}
                <tr>
                    <td>{:sprintf("%06d",$var.id)}</td>
                    <td>{$var.warehouse}</td>
                    <td>{$var.quantity}</td>
                    <td>{$var.inventory_quantity}</td>
                    <td>{$var.unit_name}</td>
                    <td>{$var.create_time}</td>
                    <td>{$var.storage_nickname}</td>
                    <td>{$var.code}</td>
                    <td>{$var.name}</td>
                    <td>{$var.type}</td>
                    <td>{$var.category}</td>
                    <td>{$var.company}</td>
                </tr>
                {/volist}
            </tbody>
        </table>
    <?php } ?>    
    {$lists->render()}
<?php } else { ?>
    <p class="bg-warning center-block">   
        <i class="iconfont icon-wushuju"></i> 暂时没有相关数据
    </p>
<?php } ?>
{/block}
{block name="foot_js"} 
<script type="text/javascript">
    require(['jquery', 'cxSelect'], function ($, cxSelect) {

        // 展开列表
        $('.product_data_parent').click(function () {
            var id = $(this).data('id');
            $('.product_data').hide();
            $('.product_dataplus').html('<i class=\'glyphicon glyphicon-menu-right\'></i>');
            $('#product_data' + id).fadeIn();
            $('#product_dataplus' + id).html('<i class=\'glyphicon glyphicon-menu-down\'></i>');
        })

        $('.export').click(function () {
            //收集form表单数据
            var data = $('form').serialize();
            //console.log(data.toString());
            var url = '<?php echo url('storage_query'); ?>?' + data.toString() + '&export=1';
            //console.log(url);
            location.href = url;
            return false;
        });
    });
</script>
{/block}