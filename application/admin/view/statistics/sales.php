{extend name="base:base" /} {block name="body"} 
<div class="container-fluid">
    <form id="forminventorysupplier" class="form-inline" action="<?php echo url('statistics/sales'); ?>" accept-charset="utf-8" method="get">

        <input type="text" placeholder="识别码/产品名称" name="keyword" value="{$Think.get.keyword}" class="form-control" id="autoproduct">
        <input type="text" placeholder="会员姓名" name="nickname" value="{$Think.get.nickname}" class="form-control" id="automember">
        <input size="16" type="text" class="datetime_search form-control" name="timea" value="{$Think.get.timea}" placeholder="创建开始日期">
        <i class="icon-resize-horizontal">至</i>
        <input size="16" type="text" class="datetime_search form-control" name="timeb" value="{$Think.get.timeb}" placeholder="创建结束日期">
        <button type="submit" class="btn btn-primary" title="点击查询"><i class="glyphicon glyphicon-search"></i> 搜索</button>

    </form>
    <p>
        <small>
            <i class="iconfont icon-wushuju"></i> 合计<strong>{:array_sum($list.quantity)}</strong>个出库产品，
            合计出库额：<strong>{:array_sum($list.sales)}</strong> 元
        </small>
    </p>
    <div id="main" style="height:450px;border:0px solid #ccc;padding:10px;"></div>
</div>
{/block}
{block name="foot_js"} 

<script type="text/javascript">
    
    requirejs(['echarts', 'jquery','autocomplete'], function (echarts, $) {
        
    $('#autoproduct').AutoComplete({
            'data': "<?php echo url('json/product') ?>",
            'ajaxDataType': 'json',
            'listStyle': 'iconList',
            'maxItems': 10,
            'itemHeight': 55,
            'width': 300,
            'async': true,
            'matchHandler': function (keyword, data) {
                return true
            },
            'afterSelectedHandler': function (data) {
                $('#autoproduct').val(data.label.substr(0,data.label.indexOf('【')));
                // $('#autoproduct').val(data.label);
            },
            'onerror': function (msg) {
                alert(msg);
            }
        });    
        
    $('#automember').AutoComplete({
        'data': "<?php echo url('json/member') ?>",
        'ajaxDataType': 'json',
        'listStyle': 'normal',
        'maxItems': 10,
        'width': 'auto',
        'async': true,
        'matchHandler': function (keyword, data) {
            return true
        },
        'afterSelectedHandler': function (data) {
            $('#automember').val(data.label);
        },
        'onerror': function (msg) {
            alert(msg);
        }
    });
        
    // 基于准备好的dom，初始化echarts实例
    var myChart = echarts.init(document.getElementById('main'));
    // 指定图表的配置项和数据
    var option = {
        title: {
            text: "出库统计观图",
            subtext: '{$Think.request.timea}{$Think.request.timeb}'
        },
        toolbox: {
            show: true,
            feature: {
                mark: {show: true},
                saveAsImage: {show: true}
            }
        },
        tooltip: {},
        legend: {
            data: ['出库金额','出库数量']
        },
        xAxis: {
            type: 'category',
            // splitLine: {show: false},
            data: [<?php echo implode(',', $list['date']); ?>]
        },
        yAxis: {},
        series: [{
                name: '出库金额',
                type: 'bar',
                data: [<?php echo implode(',', $list['sales']); ?>],
                 markLine: {
                        data: [
                            {type: 'average', name: '平均值'}
                        ]
                    }
                },
                {
                name: '出库数量',
                type: 'bar',
                data: [<?php echo implode(',', $list['quantity']); ?>],
                 markLine: {
                        data: [
                            {type: 'average', name: '平均值'}
                        ]
                    }
            }
            ]
    };
    myChart.setOption(option);
    
    });  
</script>
{/block}
