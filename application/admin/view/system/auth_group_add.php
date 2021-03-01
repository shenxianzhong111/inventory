{extend name="base:base" /} {block name="body"} 
<div class="table-common">
    <div class="left">
        <a class="btn btn-default" href="javascript:history.back();"><i class="glyphicon glyphicon-menu-left"></i> 返回</a>
        <button type="submit" class="btn btn-primary ajax-post" target-form="form-horizontal"><i class="glyphicon glyphicon-floppy-disk"></i> 保存</button>
    </div>
</div>
<form class="form-horizontal" action="<?php echo url('system/auth_group_add'); ?>" method="post">
    {$tpl_form}
    <div class="form-group">
        <label class="col-sm-2 control-label" for="input01">绑定菜单</label>
        <div class="col-sm-10">
            <div id="tree" class="fl tree"></div>
        </div>
    </div>
 
</form>
{/block}
{block name="foot_js"}



<script type="text/javascript">
    requirejs(['yntree'], function (yntree) {


        var options = {
            // 复选框change事件
            onchange: function (input, yntree) {
                console.log(this);
                getValue()
                
            },
            checkStrictly: true,
            data:<?php echo $menu_lists; ?>
        };
        var yntree = new YnTree(document.getElementById("tree"), options);

        for (var i = 0; i < yntree.data.length; i++) {
            yntree.data[i].spread(true);
            if (typeof (yntree.data[i].children) !== 'undefined') {
                for (var j = 0; j < yntree.data[i].children.length; j++) {
                    yntree.data[i].children[j].spread(true);
                }
            }
        }
        
        //
        var getValue = function(){
            var xx = yntree.getValues()
            console.log(xx)
        }
        

        // yntree.data[0].spread(true);




    });

//为隐藏域赋值(权限id拼接字符串)
    //       $("input[name=menu_ids]").val(array.join(","));
</script>



{/block}