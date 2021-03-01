require(['jquery', 'layer', 'bootbox'], function ($, layer, bootbox) {

    layer.config({
        path: APP_URL + '/libs/layer/3.0/' //layer.js所在的目录，可以是绝对目录，也可以是相对目录
    });

    $('#print').click(function () {
        event.stopPropagation();
        var title = $(this).attr('title');
        var url = $(this).attr('url') + '&r=' + Math.random() + '&' + $('form').serialize();
        console.log(url);
        PrintNoBorderTable(url, title);
    });
    $('.print').click(function () {
        event.stopPropagation();
        var num = $(this).attr('num');
        var title = $(this).attr('title');
        var url = $(this).attr('url') + '&r=' + Math.random();
        //val = val;
        console.log(url);
        PrintBarCodeNoBorderTable(url, title, '128Auto', 10, 500, 240, 40, num);
    });

    $("#modal").on("hidden.bs.modal", function () {
        $(this).removeData("bs.modal");
    });
    $("#modal_big").on("hidden.bs.modal", function () {
        $(this).removeData("bs.modal");
    });

    $(document).on("click", ".open_res", function () {
        var hidden = $(this).data('hidden');
        var thumb = $(this).attr('id');
        var href = $(this).attr('href');
        layer.open({
            type: 2,
            title: '图片选择',
            shadeClose: true,
            shade: 0.8,
            area: ['90%', '90%'],
            content: href //iframe的url
        });
    });

    $(document).on('click', '.openbox_big', function () {
        var index = layer.open({
            type: 2,
            title: $(this).attr('title'),
            shadeClose: true,
            area: ['90%', '90%'],
            maxmin: true,
            content: $(this).attr('href') //iframe的url
        });
        return false;
    });


    $(document).on("click", '.prompt', function () {


        var title = $(this).attr('title');

        var href = $(this).attr('href');
        var field = $(this).attr('field');
        var default_val = $(this).attr('val');


        bootbox.prompt({
            size: "small",
            title: title,
            value: default_val,
            callback: function (val) {

                if (val) {

                    $.post(href, {field: field, val: val, }, function (res) {
                        location.reload();
                    }).error(function () {
                        alert("error");
                    });
                }


            }
        })

        return false;

    })


    //统一全选的实现
    $(".check-all").click(function () {
        $(".ids,.check-all").prop("checked", this.checked);
        // $(".check-all").prop("checked", this.checked);
    });
    $(".ids").click(function () {
        var option = $(".ids");
        option.each(function (i) {
            if (!this.checked) {
                $(".check-all").prop("checked", false);
                return false;
            } else {
                $(".check-all").prop("checked", true);
            }
        });
    });
    //统一全选的实现end


    var data_result = function (data) {


    }
    //
    //ajax get请求
    $(document).on("click", '.ajax-get', function () {
        event.stopPropagation();
        var target;
        var that = this;
        if ($(this).hasClass('confirm')) {
            if (!confirm('确认要执行该操作吗?')) {
                return false;
            }
        }
        if ((target = $(this).attr('href')) || (target = $(this).attr('url'))) {



            $.ajax({
                url: target,
                type: 'get',
                timeout: 5000,
                beforeSend: function (XMLHttpRequest) {
                    $(that).button('loading');
                },
                success: function (result, textStatus) {

                    if (result.code == 1) {
                        if (result.msg) {
                            layer.msg(result.msg, {time: 2000, icon: 1});
                            if (result.url) {
                                setTimeout(function () {
                                    if (result.url) {                                    
                                        switch(result.url){
                                            case 'back' :location.href = document.referrer;break;
                                            case 'reload' :location.reload();break;
                                            default :location.href = result.url;break;                                        
                                        }                                    
                                    } 
                                }, 1500);
                            }
                        } else {
                            if (result.url) {                                    
                                switch(result.url){
                                    case 'back' :location.href = document.referrer;break;
                                    case 'reload' :location.reload();break;
                                    default :location.href = result.url;break;                                        
                                }                                    
                            } 
                        }
                    } else {
                        layer.msg(result.msg, {time: 2000, icon: 0});
                    }

                    $(that).button('reset');
                },
                complete: function (XMLHttpRequest, textStatus) {
                    $(that).button('reset');
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    layer.msg(textStatus, {time: 2000, icon: 0});
                    $(that).button('reset');
                }
            });





        }
        return false;
    });
    //ajax post submit请求
    $(document).on("click", '.ajax-post', function () {

        event.stopPropagation();



        var target, query, form;
        var target_form = $(this).attr('target-form');
        var that = this;
        var nead_confirm = false;

        if (($(this).attr('type') == 'submit') || (target = $(this).attr('href')) || (target = $(this).attr('url'))) {
            form = $('.' + target_form);
            if ($(this).attr('hide-data') === 'true') {//无数据时也可以使用的功能
                form = $('.hide-data');
                query = form.serialize();
            } else if (form.get(0) == undefined) {
                return false;
            } else if (form.get(0).nodeName == 'FORM') {
                if ($(this).hasClass('confirm')) {
                    if (!confirm('确认要执行该操作吗?')) {
                        return false;
                    }
                }
                if ($(this).attr('url') !== undefined) {
                    target = $(this).attr('url');
                } else {
                    target = form.attr("action");
                }
                query = form.serialize();
            } else if (form.get(0).nodeName == 'INPUT' || form.get(0).nodeName == 'SELECT' || form.get(0).nodeName == 'TEXTAREA') {
                form.each(function (k, v) {
                    if (v.type == 'checkbox' && v.checked == true) {
                        nead_confirm = true;
                    }
                })
                if (nead_confirm && $(this).hasClass('confirm')) {
                    if (!confirm('确认要执行该操作吗?')) {
                        return false;
                    }
                }
                //增加以下代码用于兼容IE8
                if ($(this).attr('url') !== undefined) {
                    target = $(this).attr('url');
                } else {
                    target = form.attr("action");
                }
                //增加以上代码用于兼容IE8                
                query = form.serialize();
            } else {
                if ($(this).hasClass('confirm')) {
                    if (!confirm('确认要执行该操作吗?')) {
                        return false;
                    }
                }
                query = form.find('input,select,textarea').serialize();
            }
            //$(that).addClass('disabled').attr('autocomplete','off').prop('disabled',true);        



            $.ajax({
                url: target,
                type: 'post',
                data: query,
                timeout: 15000,
                beforeSend: function (XMLHttpRequest) {
                    $(that).button('loading');
                },
                success: function (result, textStatus) {
                    if (result.code == 1) {
                        if (result.msg) {
                            layer.msg(result.msg, {time: 2000, icon: 1});
                            if (result.url) {
                                setTimeout(function () {
                                    if (result.url) {                                    
                                        switch(result.url){
                                            case 'back' :location.href = document.referrer;break;
                                            case 'reload' :location.reload();break;
                                            default :location.href = result.url;break;                                        
                                        }                                    
                                    } 
                                }, 1500);
                            }
                        } else {
                            if (result.url) {                                    
                                switch(result.url){
                                    case 'back' :location.href = document.referrer;break;
                                    case 'reload' :location.reload();break;
                                    default :location.href = result.url;break;                                        
                                }                                    
                            } 
                        }
                    } else {
                        layer.msg(result.msg, {time: 2000, icon: 0});
                    }
                    $(that).button('reset');
                },
                complete: function (XMLHttpRequest, textStatus) {
                    $(that).button('reset');
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    layer.msg(textStatus, {time: 2000, icon: 0});
                    $(that).button('reset');
                }
            });



        }
        return false;
    });

    function getCookie(c_name) {
        if (document.cookie.length > 0) {  //先查询cookie是否为空，为空就return ""
            c_start = document.cookie.indexOf(c_name + "=")
            //通过String对象的indexOf()来检查这个cookie是否存在，不存在就为 -1  
            if (c_start != -1) {
                c_start = c_start + c_name.length + 1
                //最后这个+1其实就是表示"="号啦，这样就获取到了cookie值的开始位置
                c_end = document.cookie.indexOf(";", c_start)
                //其实我刚看见indexOf()第二个参数的时候猛然有点晕，后来想起来表示指定的开始索引的位置...这句是为了得到值的结束位置。因为需要考虑是否是最后一项，所以通过";"号是否存在来判断
                if (c_end == -1)
                    c_end = document.cookie.length
                return unescape(document.cookie.substring(c_start, c_end))
                //通过substring()得到了值。想了解unescape()得先知道escape()是做什么的，都是很重要的基础，想了解的可以搜索下，在文章结尾处也会进行讲解cookie编码细节
            }
        }
        return ""
    }
    function setCookie(c_name, value, expiredays) {
        var exdate = new Date();
        exdate.setDate(exdate.getDate() + expiredays);
        document.cookie = c_name + "=" + escape(value) + ";path=/;" + ((expiredays == null) ? "" : ";expires=" + exdate.toGMTString());
    }
    function  show_time() {
        var show_day = new Array('星期日', '星期一', '星期二', '星期三', '星期四', '星期五', '星期六');
        var today, hour, second, minute, year, month, date, time;
        today = new Date();
        year = today.getFullYear();
        //year = (year<1900?(1900+year):year);//兼容ie9,ie8,ff的写法
        month = today.getMonth() + 1;
        date = today.getDate();
        hour = (today.getHours() < 10) ? "0" + today.getHours() : today.getHours();
        minute = (today.getMinutes() < 10) ? "0" + today.getMinutes() : today.getMinutes();
        second = (today.getSeconds() < 10) ? "0" + today.getSeconds() : today.getSeconds();
        time = ' ' + year + "年" + month + "月" + date + "日 " + hour + ":" + minute + ":" + second + ' ' + show_day[new Date().getDay()];
        document.getElementById("timer").innerHTML = time;
    }
});