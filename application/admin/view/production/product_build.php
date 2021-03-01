{extend name="base:base" /}{block name="body"}  
<style>
    .table>tbody>tr>td,.table>tbody>tr>th{line-height: 30px;}
</style>
<form class="form-inline" action="" method="POST">
    <table class="table table-hover">
        <tr>
            <th style="width:150px;text-align:right"></th>
            <td>
                <div id="legend" class="text-ceter">
                    <h3>加工单</h3> 
                </div>
            </td>
        </tr>
        <tr>
            <th style="text-align:right">加工产品</th>
            <td>
                <input type="text" name="code" placeholder="产品识别码或搜索" class="form-control" id="autoproduct">
                <input type="hidden" name="product_id" id="product_id" value="{$Think.post.product_id}" />
                <span class="check-tips"><strong>{$Think.post.code}</strong></span>
            </td>
        </tr>
        <?php
        if (!empty($products)) {
            ?>
            <tr>
                <td colspan="2">
                    <table class="table table-hover table-striped" style="margin-bottom:0px">
                        <tbody>

                            <?php foreach ($products as $key => $val) { ?>
                                <tr id="tabletbody{$key}">
                                    <td>识别码
                                        <?php echo $val['code']; ?>
                                    </td>
                                    <td>产品
                                        <input type="hidden" name="product_ids[{$key}]" value="<?php echo $val['id']; ?>" />
                                        <?php echo $val['name']; ?>
                                    </td>
                                    <td>倍数
                                        <?php echo $val['multiple']; ?>
                                    </td>
                                    <td>出货仓库
                                        <select name="product_warehouse[{$key}]" class="form-control" required>
                                            <option value="">请选择</option>
                                            <?php
                                            $pw = isset($_POST['product_warehouse'][$key]) ? $_POST['product_warehouse'][$key] : 0;
                                            foreach ($val['warehouse'] as $vars) {
                                                if ($pw == $vars['id'] || $vars['default'] == 1) {
                                                    echo '<option value="' . $vars['id'] . '"  selected >' . $vars['name'] . '   [' . $vars['quantity'] . ']</option>';
                                                } else {
                                                    echo '<option value="' . $vars['id'] . '"   >' . $vars['name'] . '   [' . $vars['quantity'] . ']</option>';
                                                }
                                            }
                                            ?>
                                        </select><button type="button" class="btn btn-default" onclick="$('#tabletbody{$key}').empty()"><i class="glyphicon glyphicon-trash"></i></button>
                                    </td>
                                </tr>
                            <?php } ?>   
                        </tbody>
                    </table>
                </td>
            </tr>

        <?php } ?>
        <tr>
            <th style="text-align:right">加工日期</th>
            <td><input type="text" class="form-control" id="build_time" name="build_time" value="{$Think.post.build_time?:date('Y-m-d H:i')}" placeholder="生产日期"></td>
        </tr>
        <tr>
            <th style="text-align:right">加工数量</th>
            <td><input name="quantity" type="number" class="form-control"  value="{$Think.post.quantity}" /></td>
        </tr>
        <tr>
            <th style="text-align:right">加入仓库</th>
            <td>
                <select name="warehouse_id" class="form-control">
                    <?php echo html_select($product_warehouse, input('post.warehouse_id')); ?>
                </select>
            </td>
        </tr>
        <tr>
            <th style="text-align:right">备注</th>
            <td><textarea name="remark"  class="form-control" style="height:80px;width:400px;">{$Think.post.remark}</textarea></td>
        </tr>
        <tr>
            <td style="text-align:right"></td>
            <td>
                <button type="submit" class="btn btn-primary ajax-post" target-form="form-inline" onclick="$('form').attr('action', '<?php echo url('product_build_submit'); ?>');"><i class="glyphicon glyphicon-floppy-disk"></i> 生产</button> 
            </td>
        </tr>
    </table>
</form>
{/block}
{block name="foot_js"} 


<script>

    require(['jquery', 'autocomplete', 'datetimepicker'], function ($, AutoComplete, datetimepicker) {

        $(function () {
            $('#autoproduct').AutoComplete({
                'data': "{:url('json/product')}",
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
                    $('#product_id').val(data.id);
                    $('form').attr('action', "{:url('product_build')}");
                    $('form').submit();
                },
                'onerror': function (msg) {
                    alert(msg);
                }
            });


            $('#build_time').datetimepicker({lang: 'zh', format: 'Y-m-d H:i', timepicker: true, step: 5, closeOnDateSelect: true});
        });

    })

</script> 
<!--加载时间框END-->

{/block}
