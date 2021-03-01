{extend name="base:base" /}
{block name="body"} 



<form class="form-horizontal" action="{:url('demo')}" method="post">
    {$tpl_form}
</form>


{/block}


{block name="foot_js"}
<!--加载时间框--> 
<script>
    $(function () {
        $('#birthday').datetimepicker(
                {lang: 'zh', format: 'Y-m-d', timepicker: false, closeOnDateSelect: true});
    });
</script> 
<!--加载时间框END-->
{/block}