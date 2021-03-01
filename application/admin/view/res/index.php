{extend name="base:base" /}
{block name="body"}  
<style>

    a.directory:hover{
        text-decoration: none;   
    }
    .directory i{
        font-size: 6em;            
    }
    .directory{
        vertical-align: middle; color: #F1CE6B;
    }   
    a.directory:hover{
        text-decoration: none;   
    }

    .img_box{
        margin:10px;
        display: flex;
        height: 160px;
        flex-direction: column;
        justify-content: center;
        text-align: center;
    }

    .img_box .img_item{
        border: 1px solid #BBB5B5;
        display: flex;
        position: relative;
        height: 160px;
        padding: 5px;
        flex-direction: column;
        justify-content: center;
        text-decoration: none;   
    }
    .img_box .img_item img{
        max-width: 100%;
        max-height: 100%;
    }
    .img_box .label{
        word-break:break-all;
        color: black;
    }
    .img_box .img_item:hover > .img_title{
        display: block;
    }
    .img_box .img_item img{
        margin: 0 auto;
    }   
    .img_box .img_item .img_title{
        height: 30px;
        line-height: 30px;
        margin-top: -30px;
        background-color:#000;
        opacity:0.5; 
        color: white;
        text-align: center;
        display: none;
    }

    #button-search{
        cursor: pointer;
    }
    @media(max-width: 768px){
        .lightbox .img_title{
            display: block;
        }
    }
</style>

<div  class="table-common fix-top fixed">
    <div class="right">
        <form class="form-inline" method="get" action="">
            <div class="input-group">
                <input type="text" name="search" placeholder="请输入关键字" autocomplete="off" value="{$Think.get.filter_name}" class="form-control">
                <div class="input-group-addon"><i class="glyphicon glyphicon-search" id="button-search"></i></div>
            </div>            
        </form>
    </div>
    <div class="left">
        <a href="<?php echo $data['parent']; ?>" id="button-parent" class="btn btn-primary"><i class="glyphicon glyphicon-menu-up"></i> 上级</a>         
        <button id="button-refresh" class="btn btn-primary"><i class="glyphicon glyphicon-refresh"></i> 刷新</button>
        <button type="button" id="button-folder" class="btn btn-primary"><i class="glyphicon glyphicon-list-alt"></i> 目录</button>
        <button type="button" id="button-upload" class="btn btn-success"><i class="glyphicon glyphicon-upload"></i> 上传</button>
        <input type="checkbox" name="autoname" value="1" checked="on" /> 自动命名
        <span class="text-success">
            <strong>目录：</strong>
            <?php
            $dir = input('get.directory', '');
            echo $dir ? '/' . $dir . '/' : '/';
            ?></span>

    </div>
</div>



<div class="form-box">


    <?php
    if ($folder == 'image') {
        ?>

        <?php
        if (empty($data['images'])) {
            ?>
            <div class="row text-warning" style="margin: 50px; text-align: center; ">
                <i class="fa fa-frown-o fa-2x"></i> <span style=" font-size: 24px;">没有任何文件</span> 
            </div>  

        <?php } ?>

        <?php
        foreach (array_chunk($data['images'], 6) as $image_lists) {
            ?>
            <div class="row" style="margin-bottom: 20px;">
                <?php foreach ($image_lists as $image) { ?>
                    <div class="col-md-2 text-center" style="padding-top:20px;padding-bottom:20px;">
                        <?php if ($image['category'] == 'directory') { ?>
                            <div class="img_box">
                                <a href="<?php echo $image['href']; ?>" class="directory">
                                    <i class="glyphicon glyphicon-book"></i>   
                                </a>
                                <div class="label">
                                    <input  class="ids" type="checkbox" name="path[]" value="<?php echo $image['path']; ?>" />
                                    <?php echo $image['name']; ?>
                                </div>
                            </div>

                        <?php } ?>
                        <?php if ($image['category'] == 'image') { ?>
                            <div class="img_box">
                                <a href="<?php echo $image['href']; ?>" class="img_item lightbox" > 
                                    <img src="<?php echo $image['thumb']; ?>" 
                                         alt="<?php echo $image['name']; ?>"  
                                         class=''
                                         title="<?php echo $image['name']; ?>" />
                                    <div class="img_title"><?php echo $image['name']; ?></div>
                                </a>
                                <div class="label">
                                    <input  class="ids" type="checkbox" name="path[]" value="<?php echo $image['path']; ?>" />                                
                                    <button class="btn btn-primary btn-xs" data-clipboard-text="<?php echo res_http($image['path']); ?>">复制路径</button>
                                </div>
                            </div>

                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
            <?php
        }
    } else {
        ?>
        <table  class="table">
            <thead>
                <tr  class="active">
                    <td>名称</td>
                    <td>日期</td>
                    <td>大小</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['images'] as $image) { ?>
                    <?php if ($image['category'] == 'directory') { ?>
                        <tr>
                            <td><input class="ids" type="checkbox"   name="path[]" value="<?php echo $image['path']; ?>" />
                                <a style="vertical-align: middle;" href="<?php echo $image['href']; ?>"  ><i class="glyphicon glyphicon-book" style="color: #F1CE6B;font-weight: bold;"></i> <?php echo $image['name']; ?></a></td>
                            <td><?php echo $image['time']; ?></td>
                            <td>文件夹</td>
                        </tr>
                    <?php } ?>
                    <?php if ($image['category'] == 'image') { ?>
                        <tr >
                            <td>
                                <input class="ids" type="checkbox"   name="path[]" value="<?php echo $image['path']; ?>" />
                                <a href="<?php echo $image['href']; ?>" ><?php echo $image['name']; ?></a>
                                <button class="btn btn-primary btn-xs" data-clipboard-text="<?php echo res_http($image['path']); ?>">复制路径</button>
                            </td>
                            <td><?php echo $image['time']; ?></td>
                            <td><?php echo $image['size']; ?></td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>
    <?php } ?>
</div>


<div class="table-common fix-bottom fixed">
    <div class="left">        
        <input class="all-file" type="checkbox"/> 全选  
        <button id="button-delete" class="btn btn-danger">删除</button>
        <button class="btn btn-primary ajax-get" href="<?php echo url('admin/res/clear') ?>">清缓存</button>
        <span class="text-danger">
            <strong> 限制格式：</strong><?php
            if (isset($ext_arr[$category])) {
                echo implode('/', $ext_arr[$category]);
            }
            ?>

            <strong> 限制大小：</strong><?php echo format_bytes($file_size); ?>/<?php echo ini_get('upload_max_filesize'); ?>/<?php echo ini_get('post_max_size'); ?>(取最小值)
        </span>

    </div>  
    <div class="right">
        {$pagination}
    </div>
</div>

{/block}
{block name="foot_js"}


<script type="text/javascript">
    require(['jquery', 'layer', 'clipboard', 'lightbox'], function ($, layer, ClipboardJS, lightbox) {
        $(function () {
            $('a.lightbox').simpleLightbox();
        });


        $(function () {



            function parent_img_select(thumb, hidden) {
                //注意：parent 是 JS 自带的全局对象，可用于操作父页面
                var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
<?php if ($data['thumb']) { ?>
                    parent.$('#<?php echo $data['thumb']; ?>').attr('src', thumb);
<?php } ?>
<?php if ($data['hidden']) { ?>
                    parent.$('#<?php echo $data['hidden']; ?>').attr('value', hidden);
<?php } ?>
                parent.layer.close(index);
            }


            //给父页面传值
            $('a.lightbox').on('click', function () {
                parent_img_select($(this).find('img').attr('src'), $(this).parent().find('input').attr('value'));
            });


            var clipboard = new ClipboardJS('.btn');
            clipboard.on('success', function (e) {
                alert("复制成功！")
            });
            clipboard.on('error', function (e) {
                alert("复制失败！请手动复制")
            });


            $('input[name=\'search\']').on('keydown', function (e) {
                if (e.which == 13) {
                    $('#button-search').trigger('click');
                }
            });
            $('#button-refresh').on('click', function (e) {
                location.href = location.href;
            });
            var urls = {
                search: '{:url("index")}?category={$category}&directory={$data["directory"]}',
                upload: '{:url("res/index_upload")}?category={$category}&directory={$data["directory"]}',
                folder: '{:url("res/index_folder")}?category={$category}&directory={$data["directory"]}',
                delete: '{:url("res/index_delete")}'
            };
            $('#button-search').on('click', function (e) {
                var url = urls.search;
                var filter_name = $('input[name=\'search\']').val();
                if (filter_name) {
                    url += '&filter_name=' + encodeURIComponent(filter_name);
                }
                url += '&thumb=' + '<?php echo $data['thumb']; ?>';
                url += '&hidden=' + '<?php echo $data['hidden']; ?>';
                console.log(url);
                location.href = url;
                return false;
                // location.href = url;
                //$('#myModal').load(url);
            });



            $('#button-upload').on('click', function () {
                //alert($('input[name=autoname]:checked').length);
                //return false;
                $('#form-upload').remove();
                $('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;"><input type="file" name="files[]" multiple value="" /></form>');
                $('#form-upload input[name=\'files[]\']').trigger('click');

                if (typeof timer != 'undefined') {
                    clearInterval(timer);
                }
                timer = setInterval(function () {
                    if ($('#form-upload input[name=\'files[]\']').val() != '') {
                        clearInterval(timer);
                        $.ajax({
                            url: urls.upload + '&autoname=' + $('input[name=autoname]:checked').length,
                            type: 'post',
                            dataType: 'json',
                            data: new FormData($('#form-upload')[0]),
                            cache: false,
                            contentType: false,
                            processData: false,
                            beforeSend: function () {
                                $('#button-upload i').replaceWith('<i class="fa fa-spinner fa-spin"></i>');
                                $('#button-upload').prop('disabled', true);
                            },
                            complete: function () {
                                $('#button-upload i').replaceWith('<i class="fa fa-upload"></i>');
                                $('#button-upload').prop('disabled', false);
                            },
                            success: function (result) {
                                if (result.code == 0) {

                                    if (result.msg) {
                                        layer.msg(result.msg);
                                    }

                                } else {

                                    if (result.msg) {
                                        layer.msg(result.msg);
                                        setTimeout(function () {
                                            location.href = location.href;
                                        }, 1500);
                                    } else {
                                        location.href = location.href;
                                    }



                                }
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                $('#button-upload i').replaceWith('<i class="fa fa-upload"></i>');
                                $('#button-upload').prop('disabled', false);
                                layer.msg(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                            }
                        });
                    }
                }, 500);
            });



            //新建文件夹
            $('#button-folder').click(function () {
                // layer.prompt({title: '输入任何口令，并确认', formType: 1}, function (text, index) {
                layer.prompt({title: '文件夹名称', value: '{:date("Y-m-d")}'}, function (val, index) {


                    if (escape(val).indexOf("%u") != -1) {
                        layer.msg('文件夹名称不能含有中文');
                        return false;
                    }

                    // layer.close(index);
                    $.ajax({
                        url: urls.folder,
                        type: 'post',
                        dataType: 'json',
                        data: 'folder=' + encodeURIComponent(val),
                        beforeSend: function () {
                            $('#button-folder').prop('disabled', true);
                        },
                        complete: function () {
                            $('#button-folder').prop('disabled', false);
                        },
                        success: function (result) {
                            if (result.code == 0) {
                                layer.msg(result.msg);
                            } else {
                                location.href = location.href;
                            }
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            layer.msg(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                        }
                    });
                });
            });
            $('#button-delete').on('click', function (e) {
                if (confirm('确认删除吗')) {
                    $.ajax({
                        url: urls.delete,
                        type: 'post',
                        dataType: 'json',
                        data: $('input[name^=\'path\']:checked'),
                        beforeSend: function () {
                            $('#button-delete').prop('disabled', true);
                        },
                        complete: function () {
                            $('#button-delete').prop('disabled', false);
                        },
                        success: function (result) {
                            if (result.code == 0) {
                                layer.msg(result.msg);

                            } else {
                                location.href = location.href;
                            }
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            layer.msg(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                        }
                    });
                }
            });
            $(".all-file").click(function () {
                $(".ids").prop("checked", this.checked);
            });
        });

    });
</script> 
<style>
    .uploader-list{ overflow: hidden; }
    .file-item{ float: left; width: 10%; margin: 5px;}
    .file-item{ word-break: break-all;}
</style>
{/block}