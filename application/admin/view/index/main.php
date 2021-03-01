{extend name="base:base" /}
{block name="body"}  
<style>
    legend{
        padding-bottom: 15px;
    }
    .bg-info{
        padding: 1em;
        line-height: 2;
    }

    .panel{
        padding: 0px 10px;
        margin-bottom: 20px;
        background-color: #fff;
        border: 1px solid #E6E8EB;
        cursor: pointer;
    }
    .panel:hover{
        background-color: #f1f1f1;
    }
    .panel-body{
        text-align: center;
    }
    .panel-body .quick-common{
        font-size: 1.2em;
        padding: 10px 0;
    }
    .panel-body i.glyphicon{
        font-size: 2.5em;
    }
</style>
<div class="col-sm-9">
    <fieldset>
        <legend>最近30天趋势</legend>

        <div>


            <div id="chuku" style="height: 300px;"></div>     

            <div id="ruku" style="height: 300px;"></div>



        </div>




    </fieldset>
</div>


<div class="col-sm-3">
    <fieldset>
    <?php
    $auth = new \utils\Auth\Auth();
    ?>
    <legend>快捷访问</legend>
    <?php if (IS_SUPER_ADMIN || in_array('admin/inventory/storage', $auth->getAuthList(UID))) { ?>
        <div class="col-md-6">
            <div class="panel panel-white">
                <div class="panel-body" data-module="inventory" data-action="storage">
                    <i class="glyphicon glyphicon-log-in"></i>
                    <div class="quick-common">入库</div>
                </div>
            </div>
        </div>
    <?php } ?>
    <?php if (IS_SUPER_ADMIN || in_array('admin/inventory/sales', $auth->getAuthList(UID))) { ?>
        <div class="col-md-6">
            <div class="panel panel-white">
                <div class="panel-body" data-module="inventory" data-action="sales">
                    <i class="glyphicon glyphicon-log-out"></i>
                    <div class="quick-common">出库</div>

                </div>
            </div>
        </div>
    <?php } ?>
    <?php if (IS_SUPER_ADMIN || in_array('admin/inventory/stock_query', $auth->getAuthList(UID))) { ?>
        <div class="col-md-6">
            <div class="panel panel-white">
                <div class="panel-body" data-module="inventory" data-action="stock_query">
                    <i class="glyphicon glyphicon-equalizer"></i>
                    <div class="quick-common">库存</div>
                </div>
            </div>
        </div>
    <?php } ?>
<!--    --><?php //if (IS_SUPER_ADMIN || in_array('admin/production/product_build', $auth->getAuthList(UID))) { ?>
<!--        <div class="col-md-6">-->
<!--            <div class="panel panel-white">-->
<!--                <div class="panel-body" data-module="production" data-action="product_build">-->
<!--                    <i class="glyphicon glyphicon-scissors"></i>-->
<!--                    <div class="quick-common">生产</div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    --><?php //} ?>
</fieldset>
    <fieldset>
        <legend>磁盘占用</legend>
        <div id="disk" style="height: 300px;"></div>

    </fieldset>
</div>  
{/block}
{block name="foot_js"}



<script type="text/javascript">
    
    requirejs(['echarts', 'jquery', 'bootstrap'], function (echarts, $, undefined) {
        
        $('.panel-body').click(function () {
            if (top.topManager) {
                //打开左侧菜单中配置过的页面
                top.topManager.openPage({
                    moduleId: $(this).data('module'),
                    id: $(this).data('action')
                });
            }
        });
        
    // 基于准备好的dom，初始化echarts实例
    var myChart = echarts.init(document.getElementById('disk'));
    // 指定图表的配置项和数据
    var option = {
        tooltip: {
            formatter: "{a} <br/>{b} : {c}%"
        },
        series: [
            {
                name: '硬盘使用量',
                type: 'gauge',
                detail: {formatter: '{value}%'},
                data: [{value: <?php echo $disk_per ?? 0; ?>, name: '已使用'}]
            }
        ]
    };
    // 使用刚指定的配置项和数据显示图表。
    myChart.setOption(option);



    var option1 = {
        title: {
            text: '出库趋势'
        },
        tooltip: {
            trigger: 'axis'
        },
        legend: {
            data: ['出库金额', '出库数量']
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        toolbox: {
            feature: {
                saveAsImage: {}
            }
        },
        xAxis: {
            type: 'category',
            boundaryGap: false,
            data: [<?php echo implode(',', $lists['date']); ?>]
        },
        yAxis: {
            type: 'value'
        },
        series: [
            {
                name: '出库金额',
                type: 'line',
                smooth: true,
                stack: '总量',
                data: [<?php echo implode(',', $lists['sales']); ?>]
            },
            {
                name: '出库数量',
                type: 'line',
                smooth: true,
                stack: '总量',
                data: [<?php echo implode(',', $lists['quantity']); ?>]
            }

        ]
    };
    echarts.init(document.getElementById('chuku')).setOption(option1);

    var option2 = {
        title: {
            text: '入库趋势'
        },
        tooltip: {
            trigger: 'axis'
        },
        legend: {
            data: ['入库金额', '入库数量']
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        toolbox: {
            feature: {
                saveAsImage: {}
            }
        },
        xAxis: {
            type: 'category',
            boundaryGap: false,
            data: [<?php echo implode(',', $lists2['date']); ?>]
        },
        yAxis: {
            type: 'value'
        },
        series: [
            {
                name: '入库金额',
                type: 'line',
                smooth: true,
                stack: '总量',
                data: [<?php echo implode(',', $lists2['sales']); ?>]
            },
            {
                name: '入库数量',
                type: 'line',
                smooth: true,
                stack: '总量',
                data: [<?php echo implode(',', $lists2['quantity']); ?>]
            }

        ]
    };
    echarts.init(document.getElementById('ruku')).setOption(option2);
 });
</script>

{/block}