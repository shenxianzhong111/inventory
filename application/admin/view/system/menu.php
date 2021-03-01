{extend name="base:base" /}
{block name="body"}  
<form class="menu_form" >
    <div class="table-common"> 
        <div class="left">
            <a data-toggle="modal" data-target="#modal" class="btn btn-default" href="<?php echo url('menu_add'); ?>"><i class="glyphicon glyphicon-plus"></i> 添加</a>
            <a url="<?php echo url('menu_show'); ?>" target-form="menu_form" class="btn btn-success ajax-post"><i class="glyphicon glyphicon-eye-open"></i> 显示</a>
            <a url="<?php echo url('menu_hide'); ?>" target-form="menu_form" class="btn btn-danger ajax-post"><i class="glyphicon glyphicon-eye-close"></i> 隐藏</a>

            <button class="btn btn-primary" id="upload"><i class="glyphicon glyphicon-floppy-open"></i> 导入</button>                    
            <button class="btn btn-primary export" ><i class="glyphicon glyphicon-floppy-save"></i> 导出</button>
            <input id="upload_document" type="file" name="file" style="display: none;" accept="application/json"/>

        </div>
    </div>
    {$tpl_list}
</form>
{/block}
{block name="foot_js"}
<script>
    require(['jquery'], function ($) {
        $("#upload").click(function () {
            $("#upload_document").click();
            return false;
        });
        $('#upload_document').change(function (e) {
            var formdata = new FormData();
            formdata.append("file", e.currentTarget.files[0]);
            $.ajax({
                url: "<?php echo url('admin/system/menu_import'); ?>",
                type: "post",
                data: formdata,
                processData: false, // 不处理数据
                contentType: false, // 不设置内容类型
                success: function (res) {
                    if (res.code === 0) {
                        toastr.info('导入成功');
                        setTimeout(function () {
                            location.reload();
                        }, 2000)
                    } else {
                        toastr.warning('导入失败');
                        setTimeout(function () {
                            location.reload();
                        }, 2000)
                    }
                }
            })
        });

        $('.export').click(function () {
            location.href = '<?php echo url('admin/system/menu_export'); ?>';
            return false;
        });
    });
</script>
{/block}