{extend name="base:base" /} {block name="body"} 
<div class="text-left">
    <a href="javascript:history.go(-1);" title="返回" class="btn btn-default"><i class="glyphicon glyphicon-menu-left"></i> 返回</a>
</div>
<hr>

<div class="container">

<div id="legend" class="text-center">
    <h2>产品信息</h2> 
</div>
<table class="table table-hover">
    <tr>
<!--        <td rowspan="5" align="center">-->
<!--            <img src="{:img_resize($var.image, 200, 0)}" />-->
<!--        </td>-->
        <th style="width:90px;text-align:right">产品货号</th>
        <td>{$var.code}</td>
        <th style="width:90px;text-align:right">产品名称</th>
        <td>{$var.name}</td>
        <th style="width:90px;text-align:right">产品分类</th>
        <td>{$var.category} </td>
        <th style="width:120px;text-align:right">最低库存报警</th>
        <td>{$var.lowest}</td>
    </tr>
    <tr>
        <th style="text-align:right">产品单位</th>
        <td>{$var.unit}</td>
        <th style="text-align:right">出库价</th>
        <td>{$var.sales}</td>
        <th style="text-align:right">进货价</th>
        <td>{$var.purchase}</td>
        <th style="text-align:right"></th>
        <td></td>
    </tr>
    <tr>
        <th style="text-align:right">产品类型</th>
        <td>{$var.type}</td>
        <th style="text-align:right">产品规格</th>
        <td>{$var.format}</td>
        <th style="text-align:right"></th>
        <td></td>
        <th style="text-align:right"></th>
        <td></td>
    </tr>
    <tr>
        <th style="text-align:right">创建人</th>
        <td>
            {$var.nickname} </td>
        <th style="text-align:right">创建日期</th>
        <td>{$var.create_time} </td>
        <th style="text-align:right">最后更新</th>
        <td>
            {$var.replace_nickname}</td>
        <th style="text-align:right">更新日期</th>
        <td>
            {$var.update_time} </td>
    </tr>
    <tr>
        <th style="text-align:right">产品备注</th>
        <td colspan="7">{$var.remark}</td>
    </tr>
</table>
    
    
    
    <div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab">库存信息</a></li>
    <li role="presentation"><a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab">入库记录</a></li>
    <li role="presentation"><a href="#tab3" aria-controls="tab3" role="tab" data-toggle="tab">出库记录</a></li>
    <li role="presentation"><a href="#tab4" aria-controls="tab4" role="tab" data-toggle="tab">调拨记录</a></li>
    <li role="presentation"><a href="#tab6" aria-controls="tab6" role="tab" data-toggle="tab">报废记录</a></li>
    <li role="presentation"><a href="#tab5" aria-controls="tab5" role="tab" data-toggle="tab">生产消耗记录</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
      <div role="tabpanel" class="tab-pane active" id="tab1">
          
          {if !empty($count1)}

<p class="bg-warning"> <i class="iconfont icon-tishi"></i>  查询到了<strong>{$count1}</strong>个库存记录，库存合计：<?php echo $quantity_sum1; ?> </p>
<div id="tablelist1">
</div>
<div class=" text-center">
    <ul class="pagination" id='pagination1'>
    </ul>
</div>
{else}<p class="bg-warning"> <i class="glyphicon glyphicon-info-sign"></i>  无记录 </p>
{/if}
          
      </div>
      <div role="tabpanel" class="tab-pane" id="tab2">
          
          
{if !empty($count2)}

<p class="bg-warning"> <i class="iconfont icon-tishi"></i>  查询到了<strong>{$count2}</strong>个入库记录，入库合计：<?php echo $quantity_sum2; ?> </p>
<div id="tablelist2">
</div>
<div class=" text-center">
    <ul class="pagination" id='pagination2'>
    </ul>
</div>
{else}<p class="bg-warning"> <i class="glyphicon glyphicon-info-sign"></i>  无记录 </p>
{/if}
          
      </div>
      <div role="tabpanel" class="tab-pane" id="tab3">
          
          {if !empty($count4)}
           
            <p class="bg-warning"> <i class="iconfont icon-tishi"></i>  查询到了<strong>{$count4}</strong>个出库记录，出库合计：<?php echo $quantity_sum4; ?>，退货合计：<?php echo $quantity_sum42; ?> </p>
            <div id="tablelist4">
            </div>
            <div class=" text-center">
                <ul class="pagination" id='pagination4'>
                </ul>
            </div>
            {else}<p class="bg-warning"> <i class="glyphicon glyphicon-info-sign"></i>  无记录 </p>
            {/if}
          
      </div>
      <div role="tabpanel" class="tab-pane" id="tab4">
          
          {if !empty($count3)}

<p class="bg-warning"> <i class="iconfont icon-tishi"></i>  查询到了<strong>{$count3}</strong>个调拨记录{if $Think.get.w_id}，拨入合计：{$quantity_sum31} 拨出合计：{$quantity_sum32}{/if}</p>
<div id="tablelist3">
</div>
<div class=" text-center">
    <ul class="pagination" id='pagination3'>
    </ul>
</div>
{else}<p class="bg-warning"> <i class="glyphicon glyphicon-info-sign"></i>  无记录 </p>
{/if}
          
      </div>
      
      <div role="tabpanel" class="tab-pane" id="tab6">
          
          {if !empty($count6)}

<p class="bg-warning"> <i class="iconfont icon-tishi"></i>  查询到了<strong>{$count6}</strong>个报废记录，报废合计：{$quantity_sum6}</p>
<div id="tablelist6">
</div>
<div class=" text-center">
    <ul class="pagination" id='pagination5'>
    </ul>
</div>
{else}<p class="bg-warning"> <i class="glyphicon glyphicon-info-sign"></i>  无记录 </p>
{/if}
          
      </div>
      
      
      <div role="tabpanel" class="tab-pane" id="tab5">
          
 {if !empty($count5)}

<p class="bg-warning"> <i class="iconfont icon-tishi"></i>  查询到了<strong>{$count5}</strong>个生产记录，消耗合计：{$quantity_sum5}</p>
<div id="tablelist5">
</div>
<div class=" text-center">
    <ul class="pagination" id='pagination5'>
    </ul>
</div>
{else}<p class="bg-warning"> <i class="glyphicon glyphicon-info-sign"></i>  无记录 </p>
{/if}

      </div>
      
      
  </div>
  
  
  
  

</div>

















</div>
{/block}
{block name="foot_js"} 
<script type="text/javascript">
    require(['jquery', 'autocomplete', 'jqPaginator'], function ($, AutoComplete, jqPaginator) {
    {if !empty($count1)}
    $('#pagination1').jqPaginator({
    totalCounts: {$count1},
            pageSize:<?php echo config('base.page_size'); ?>,
            currentPage:1,
            onPageChange: function(num, type) {
            // alert(num);
            $.post("{:url('product_look',['id'=>$var.id, 'w_id'=>$Think.get.w_id])}", {looktype:1, count:{$count1}, page:num}, function(data) {
            $('#tablelist1').html(data);
            });
            }
    });
    {/if}
    {if !empty($count2)}
    $('#pagination2').jqPaginator({
    totalCounts:{$count2},
            pageSize:<?php echo config('base.page_size'); ?>,
            currentPage:1,
            onPageChange:function(num, type) {
            $.post("{:url('product_look',['id'=>$var.id, 'w_id'=>$Think.get.w_id])}", {looktype:2, count:{$count2}, page:num}, function(data) {
            $('#tablelist2').html(data);
            });
            }
    });
    {/if}
    {if !empty($count3)}
    $('#pagination3').jqPaginator({
    totalCounts:{$count3},
            pageSize:<?php echo config('base.page_size'); ?>,
            currentPage: 1,
            onPageChange:function(num, type) {
            $.post("{:url('product_look',['id'=>$var.id, 'w_id'=>$Think.get.w_id])}", {looktype:3, count:{$count3}, page:num}, function(data) {
            $('#tablelist3').html(data);
            });
            }
    });
    {/if}
    {if !empty($count4)}
    $('#pagination4').jqPaginator({
    totalCounts:{$count4},
            pageSize:<?php echo config('base.page_size'); ?>,
            currentPage: 1,
            onPageChange:function(num, type) {
            $.post("{:url('product_look',['id'=>$var.id, 'w_id'=>$Think.get.w_id])}", {looktype:4, count:{$count4}, page:num}, function(data) {
            $('#tablelist4').html(data);
            });
            }
    });
    {/if}
    {if !empty($count5)}
    $('#pagination5').jqPaginator({
    totalCounts:{$count5},
            pageSize:<?php echo config('base.page_size'); ?>,
            currentPage: 1,
            onPageChange:function(num, type) {
            $.post("{:url('product_look',['id'=>$var.id, 'w_id'=>$Think.get.w_id])}", {looktype:5, count:{$count5}, page:num}, function(data) {
            $('#tablelist5').html(data);
            });
            }
    });
    {/if}
    {if !empty($count6)}
    $('#pagination6').jqPaginator({
    totalCounts:{$count6},
            pageSize:<?php echo config('base.page_size'); ?>,
            currentPage: 1,
            onPageChange:function(num, type) {
            $.post("{:url('product_look',['id'=>$var.id, 'w_id'=>$Think.get.w_id])}", {looktype:6, count:{$count6}, page:num}, function(data) {
            $('#tablelist6').html(data);
            });
            }
    });
    {/if}
        
        
    });
</script>
{/block}
