<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-urlA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
        <title></title>
        <!-- Set render engine for 360 browser -->
        <meta name="renderer" content="webkit">
        <link rel="stylesheet" href="__STATIC__/admin/css/style.css" />
        <style>
            img.img-thumbnail:hover{
                transform: scale(3);
            }
        </style>
        <script> var APP_URL = '<?php echo APP_URL; ?>';</script>  
        <script type="text/javascript" src="__PUBLIC__/libs/require.min.js"></script>
        <script type="text/javascript" src="__PUBLIC__/libs/require.config.js"></script>    
        <script type="text/javascript">
            requirejs(['bootstrap', 'scrollUp', 'jquery'], function (bootstrap, scrollUp, $) {
                $(function () {
                    $.scrollUp({scrollText: '回顶部'});
                });
            });
        </script>
        <!--[if lt IE 9]>
        <script src="__PUBLIC__/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="__PUBLIC__/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="container-fluid body">
            {block name="body"} {/block}
        </div>
        <div class="modal fade" tabindex="-1" role="dialog" id="modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <div class="modal fade  bs-example-modal-lg" tabindex="-1" role="dialog" id="modal_big">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

    </body>
</html>

<!--自定义的一些JS函数--> 
<script src="__STATIC__/admin/js/init.js"></script>

<!--以下代码专门用于实现进销系统打印-->
<object  id="LODOP_OB" classid="clsid:2105C259-1E0C-4534-8141-A753534CB4CA" width=0 height=0> 
    <embed id="LODOP_EM" type="application/x-print-lodop" width=0 height=0></embed>
</object>
<script type="text/javascript" src="__PUBLIC__/libs/lodop/LodopFuncs.js"></script>
<script type="text/javascript">
            function post_sisyphus() {
//        $("form").sisyphus({
//            customKeySuffix: "{:md5($Request.path)}",
//            onRestore: function () {
//                toastr.info('已恢复历史数据');
//            }
//        });
            }
            var LODOP; //声明为全局变量      
            function PrintOneURL(url, title) {
                LODOP = getLodop();
                LODOP.PRINT_INIT(title);
                LODOP.ADD_PRINT_URL(30, 20, 746, "95%", url);
                LODOP.SET_PRINT_STYLEA(0, "HOrient", 3);
                LODOP.SET_PRINT_STYLEA(0, "VOrient", 3);
                //LODOP.SET_SHOW_MODE("MESSAGE_GETING_URL",""); //该语句隐藏进度条或修改提示信息
                //LODOP.SET_SHOW_MODE("MESSAGE_PARSING_URL","");//该语句隐藏进度条或修改提示信息
                LODOP.PREVIEW();
            }
            function PrintNoBorderTable(url, title) {
                LODOP = getLodop();
                LODOP.PRINT_INIT(title);
                LODOP.ADD_PRINT_URL(20, 5, "100%", "100%", url);
                LODOP.SET_PRINT_STYLEA(0, "LinkedItem", -1);
                LODOP.SET_PREVIEW_WINDOW(2, 2, 0, 760, 540, "");
                LODOP.PREVIEW();
            }
            function PrintBarCodeNoBorderTable(url, title, BarCodeType, Top, Left, Width, Height, BarCodeValue) {
                LODOP = getLodop();
                LODOP.PRINT_INIT(title);
                LODOP.ADD_PRINT_URL(20, 5, "100%", "100%", url);
                LODOP.SET_PRINT_STYLEA(0, "LinkedItem", -1);
                // LODOP.SET_PRINT_PAGESIZE (1, 0, 0,"A5");
                LODOP.ADD_PRINT_BARCODE(Top, Left, Width, Height, BarCodeType, BarCodeValue);
                LODOP.SET_PREVIEW_WINDOW(2, 2, 0, 760, 540, "");
                LODOP.PREVIEW();
            }
</script>  
{block name="foot_js"}{/block}