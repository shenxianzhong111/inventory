<!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>森洽进销存</title>
        <!-- Bootstrap -->
        <link href="__PUBLIC__/libs/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">  
        <link rel="stylesheet" href="__STATIC__/admin/login/login.css" />        
        <style>input:-webkit-autofill {
                -webkit-box-shadow: 0 0 0px 1000px white inset;
                border: 1px solid #CCC!important;
            }
            .login_form{
                background-color: #E9EEF2;
            }
            .login_form2{
                margin:20px 30px 20px 20px; 
            }
            .logo{
                font-style: italic;
            }
            .form { padding-top: 20px; padding-bottom: 0px; overflow: hidden;}

            .login-form{
                padding: 40px;
                background-color: #E9EEF2;
            }
            .logo span{
                font-size: 14px;
            }
        </style>

    </head>
    <body>
        <div id="mainBody">
            <div id="cloud1" class="cloud"></div>
            <div id="cloud2" class="cloud"></div>
        </div>
<!--      <div class="logintop"> <span><i class="fa fa-flag"></i> 欢迎登录管理平台</span></div>-->
        <div class="loginbody"></div>
        <div class="loginbox ">
            <div class="title">
                <div class="logo"><i class="fa fa-soundcloud fa-lg"></i> 森洽进销存 <span>v1.1</span></div>
                <div class="info"></div>
            </div>

            <form id="myForm" action="{:url('admin/everyone/login')}" method="post" class="form-horizontal login-form">                
                <div class="form-group">
                    <div class="col-sm-2 control-label">账号</div>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="username" placeholder="用户名">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-2 control-label">密码</div>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" name="password" placeholder="登录密码">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-2 control-label"></div>
                    <div class="col-sm-10">
                        <button id="submit" type="submit" class="btn btn-sm btn-primary btn-block">登 录</button>
                    </div>
                </div>

            </form>


        </div>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="__PUBLIC__/libs/jquery/1.9.1/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="__PUBLIC__/libs/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    </body>
</html>
<!--动画效果-->
<script src="__STATIC__/admin/login/cloud.js" type="text/javascript"></script>
<!-- 提示组件-->
<script type="text/javascript" src="__PUBLIC__/libs/layer/3.0/layer.js"></script>
<script>
    if (window != top) {
        top.location.href = location.href;
    }
</script>

<script src="__PUBLIC__/libs/bootstrapvalidator/js/bootstrapValidator.js"></script>
<script>
    $(function () {
        $("#myForm").bootstrapValidator({
            excluded: [':disabled', ':hidden', ':not(:visible)'],
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            live: 'enabled',
            submitHandler: null,
            trigger: null,
            threshold: null,
            fields: {

                username: {
                    feedbackIcons: true,
                    validators: {
                        notEmpty: {
                            message: '用户名不能为空'
                        },
                        stringLength: {
                            min: 2,
                            max: 20,
                            message: '2到20个字符之间'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9_\.]+$/,
                            message: '必须是字母、数字、下划线或.'
                        }
                    }
                },
                password: {
                    feedbackIcons: true,
                    validators: {
                        notEmpty: {
                            message: '登录密码不能为空'
                        },
                        stringLength: {
                            min: 6,
                            max: 20,
                            message: '6到20个字符之间'
                        },
                        different: {
                            field: 'username',
                            message: '不能和用户名相同'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9_\.]+$/,
                            message: '必须是字母、数字、下划线或.'
                        }
                    }
                },

            }
        });

        $(document).keypress(function (e) {
            // 回车键事件 
            if (e.which == 13) {
                $("#submit").click();
            }
        });

        function login() {


            $.ajax({
                url: $('#myForm').attr("action"),
                type: 'post',
                data: $('#myForm').find('input,select,textarea').serialize(),
                timeout: 15000,
                beforeSend: function (XMLHttpRequest) {
                    $('#submit').button('loading');
                },
                success: function (result, textStatus) {
                    if (result.code == 1) {
                        if (result.msg) {
                            layer.msg(result.msg, {time: 2000, icon: 1});
                            if (result.url) {
                                setTimeout(function () {
                                    location.href = result.url;
                                }, 1500);
                            }
                        } else {
                            location.href = result.url;
                        }
                    } else {
                        layer.msg(result.msg, {time: 2000, icon: 0});
                    }
                    $('#submit').button('reset');
                },
                complete: function (XMLHttpRequest, textStatus) {
                    $('#submit').button('reset');
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    layer.msg(errorThrown, {time: 2000, icon: 0});
                    $('#submit').button('reset');
                }
            });
        }

        $("#submit").on("click", function () {
            $(".form-horizontal").bootstrapValidator('validate');//提交验证
            if ($(".form-horizontal").data("bootstrapValidator").isValid()) {
                login();
            }
        });
    })
</script>