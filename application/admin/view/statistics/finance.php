{extend name="base:base" /} {block name="body"} 

<div class="container-fluid">


    <form class="form-inline" id="financequery" action="" accept-charset="utf-8" method="get">



        <input size="16" type="text" class="datetime_search form-control" name="timea" value="{$Think.get.timea}" placeholder="创建开始日期">
        <i class="icon-resize-horizontal"></i>
        <input size="16" type="text" class="datetime_search form-control" name="timeb" value="{$Think.get.timeb}" placeholder="创建结束日期">




        <div class="btn-group" data-toggle="buttons-radio">
            <button type="button" onclick="$('#chart').val(0); $('form').submit()" class="btn btn-default {:empty($chart)?' active':''}"><i class="icon-bar-chart"></i> 宏观图</button>
            <button type="button" onclick="$('#chart').val(1); $('form').submit()" class="btn btn-default {$chart?' active':''}"><i class="icon-dashboard"></i> 分布图</button>
        </div>

        <button type="submit" class="btn btn-primary" title="搜索"><i class="glyphicon glyphicon-search"></i> 搜索</button>
        <input type="hidden" id="chart" name="chart" value="{$Think.get.chart}">
    </form>

    <p>
        <small><i class="iconfont icon-wushuju"></i> 收入:<strong>{$revenue?:0}</strong> 支出:<strong>{$expenditure?:0}</strong></small>
    </p>


    <div id="main" style="height:450px;border:0px solid #ccc;padding:10px;"></div>
</div>




{/block}
{block name="foot_js"} 

<script type="text/javascript">
requirejs(['echarts', 'jquery'], function (echarts, $) {
<?php if (!request()->get('chart')) { ?>
                    var option = {
                    title: {
                    text: '账务统计宏观图',
                            subtext: '{$Think.get.timea}至{$Think.get.timeb} 收入:{$revenue?:0} 支出:{$expenditure?:0}'
                    },
                            tooltip: {
                            trigger: 'axis'
                            },
                            legend: {
                            data: ['收入', '支出']
                            },
                            toolbox: {
                            show: true,
                                    feature: {
                                    mark: {show: true},
                                            dataView: {show: true, readOnly: false},
                                            magicType: {show: true, type: ['line', 'bar', 'stack', 'tiled']},
                                            restore: {show: true},
                                            saveAsImage: {show: true}
                                    }
                            },
                            calculable: true,
                            xAxis: [
                            {
                            type: 'category',
                                    boundaryGap: false,
                                    splitLine : {show : false},
                                    data: [{:implode(',', $lists.date)}]
                            }
                            ],
                            yAxis: [
                            {
                            type: 'value'
                            }
                            ],
                            series: [{
                            name: '收入',
                                    type: 'line',
                                    smooth: true,
                                    itemStyle: {normal: {areaStyle: {type: 'default'}}},
                                    data: [{:implode(',', $lists.revenue)}],
                                    markLine : {
                                    data : [
                                    {type : 'average', name: '平均值'}
                                    ]
                                    }

                            },
                            {
                            name: '支出',
                                    type: 'line',
                                    smooth: true,
                                    itemStyle: {normal: {areaStyle: {type: 'default'}}},
                                    data: [{:implode(',', $lists.expenditure)}],
                                    markLine : {
                                    data : [
                                    {type : 'average', name : '平均值'}
                                    ]
                                    }

                            }]
                    };
<?php } else { ?>

                    var option = {
                    title : {
                    text: '收支分部图',
                            subtext: '{$Think.get.timea}至{$Think.get.timeb} 收入:{$revenue?:0} 支出:{$expenditure?:0}',
                            x:'center'
                    },
                            tooltip : {
                            trigger: 'item',
                                    formatter: "{a} <br/>{b} : {c} ({d}%)"
                            },
                            legend: {
                            orient : 'vertical',
                                    x : 'left',
                                    data:['收入', '支出']
                            },
                            toolbox: {
                            show : true,
                                    feature : {
                                    mark : {show: true},
                                            dataView : {show: true, readOnly: false},
                                            restore : {show: true},
                                            saveAsImage : {show: true}
                                    }
                            },
                            calculable : true,
                            series : [
                            {
                            name:'支出分部图',
                                    type:'pie',
                                    radius : '60%',
                                    center: ['50%', '60%'],
                                    data:[
                                    {value:{$revenue?:0}, name:'收入'},
                                    {value:{$expenditure?:0}, name:'支出'}
                                    ]
                            }
                            ]
                    };
<?php } ?>


echarts.init(document.getElementById('main')).setOption(option);
                
      });           
                
</script>
{/block}

