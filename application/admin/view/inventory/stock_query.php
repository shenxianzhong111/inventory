{extend name="base:base" /} {block name="body"} 
<div class="table-common">
    <form class="form-inline" action="{:url('stock_query')}" method="get">
        <div class="search-box">
            <input type="text" placeholder="ID/识别码/产品名称" name="keyword" value="{$Think.get.keyword}" class="form-control">
            <input type="text" class="form-control" style="width: 70px" name="lowesta" value="{$Think.get.lowesta}" placeholder="库存">
            <i class="fa fa-arrows-h"></i>
            <input type="text" class="form-control" style="width: 70px" name="lowestb" value="{$Think.get.lowestb}" placeholder="库存">
            <select name="warehouse" class="form-control">
                <option value="">所有仓库</option>
                <?php echo html_select($warehouse, input('get.warehouse')) ?>
            </select>
            <select name="c_id" class="form-control">
                <option value="">所有分类</option>
                <?php echo html_select(model('product_category')->lists_select_tree(), input('get.c_id')); ?>       
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
            <button class="btn btn-success export" title="导出"><i class="glyphicon glyphicon-share-alt"></i> 导出</button>
        </div>

        <div class="btn-group search-box" data-toggle="buttons-radio">
            <?php
            foreach ($warehouse as $key => $value) {
                ?>
                <button type="button" onclick="location.href = '<?php echo url('stock_query', ['warehouse' => $key]) ?>'" class="btn  btn-default <?php
                if (request()->get('warehouse') == $key) {
                    echo ' active ';
                }
                ?>"><i class="fa fa-list-alt"></i> <?php echo $value ?></button>
                    <?php } ?>
        </div>

    </form>
</div>
<p>
    <small><i class="iconfont icon-tishi"></i> 查询到了<strong>{$count}</strong>个库存记录</small>
</p>
<?php if (isset($lists) && count($lists) > 0) { ?>
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th colspan="3" style="text-align:center" class="warning">仓库信息</th>
                <th colspan="7" style="text-align:center" class="success">产品信息</th>
            </tr>
            <tr>
                <th>ID</th>
                <th>仓库</th>
                <th><a href="<?php echo url('stock_query'); ?>?<?php echo http_build_query(array_merge(input('get.'), ['orderby' => input('get.orderby') == 'quantity.asc' ? 'quantity.desc' : 'quantity.asc'])); ?>">库存<?php
                        if (input('get.orderby') == 'quantity.asc') {
                            echo '↑';
                        } elseif (input('get.orderby') == 'quantity.desc') {
                            echo '↓';
                        }
                        ?></th>
                <th><a href="<?php echo url('stock_query'); ?>?<?php echo http_build_query(array_merge(input('get.'), ['orderby' => input('get.orderby') == 'code.asc' ? 'code.desc' : 'code.asc'])); ?>">识别码<?php
                        if (input('get.orderby') == 'code.asc') {
                            echo '↑';
                        } elseif (input('get.orderby') == 'code.desc') {
                            echo '↓';
                        }
                        ?></a></th>
                <th>产品名称</th>
<!--                <th>图片</th>-->
                <th>产品分类</th>
                <th>产品类型</th>
                <th>管理操作</th>
            </tr>
        </thead>
        <tbody>
            {volist name="lists" id="var"}
            <tr>
                <td>{:sprintf("%06d",$var.inventory_id)}</td>
                <td>{$var.warehouse}</td>
                <td>
                    {elt name="var.quantity" value="$var.lowest"}
                    <span class="badge badge-important">{$var.quantity}</span>
                    {else/}
                    {$var.quantity}
                    {/elt}
                    {$var.unit_name}
                </td>
                <td>{$var.code}</td>
                <td>{$var.name}</td>
<!--                <td><img src="--><?php //echo img_resize($var['image'], 400, 400) ?><!--" style="max-width: 100px; max-height: 100px;" class="img-thumbnail" /></td>-->
                <td>{$var.category}</td>
                <td>{$var.type}</td>

                <td>
                    <a class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal" href="{:url('transfer_add',['id'=>$var.inventory_id])}" data-title="产品调出"  title="调出">调出</a>
                    <a class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modal" href="{:url('scrapped_add',['id'=>$var.inventory_id])}" data-title="产品报废" title="报废">报废</a>
                    <a class="btn btn-primary btn-xs" href="{:url('admin/configure/product_look',['id'=>$var.p_id, 'w_id'=>$var.w_id])}" data-title="产品查看" title="查看">查看</a>
    <?php if ($var['quantity'] == 0) { ?>
                        <a href="{:url('stock_delete',['id'=>$var.inventory_id])}" class="btn btn-danger btn-xs ajax-get confirm" title="删除">删除</a>
    <?php } ?>
                </td>
            </tr>
            {/volist}
        </tbody>
    </table>
    {$lists->render()}
<?php } else { ?>
    <p class="bg-warning center-block">   
        <i class="iconfont icon-wushuju"></i> 暂时没有相关数据
    </p>
<?php } ?>
{/block}

{block name="foot_js"}
<script>
    require(['jquery', 'cxSelect'], function ($, cxSelect) {
        $('.export').click(function () {
            //收集form表单数据
            var data = $('form').serialize();
            var url = '<?php echo url('stock_query'); ?>?' + data.toString() + '&export=1';
            location.href = url;
            return false;
        });
    });
</script>
{/block}
