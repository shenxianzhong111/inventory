{extend name="base:base" /} {block name="body"} 




<div class="table-common">
    <div class="left">
        <a class="btn btn-default" href="javascript:history.back();"><i class="glyphicon glyphicon-menu-left"></i> 返回列表</a>
    </div>
</div>
<div class="container">
    <form class="form-horizontal " method="post">
        <div id="legend" class="text-center">
            <h2>查看会员</h2> 
        </div>
        <table class="table table-hover">
            <tr>
                <!--<th style="width:130px;text-align:right">会员组：</th>-->
                <!--<td>-->
                <!--    {$look.group_name}-->
                <!--</td>-->
                <th style="width:130px;text-align:right">会员姓名：</th>
                <td>{$look.nickname}</td>
                <th style="text-align:right">会员性别：</th>
                <td>{$look.sex}</td>
                <th style="text-align:right">会员卡号：</th>
                <td>{$look.card}</td>
            </tr>
            <tr>
                <th style="text-align:right">联系电话：</th>
                <td>{$look.tel}</td>
                <th style="text-align:right">QQ：</th>
                <td>{$look.qq}</td>
                <th style="text-align:right">Email：</th>
                <td>{$look.email}</td>
                <th style="text-align:right">身份证号：</th>
                <td>{$look.id_card}</td>
            </tr>
            <tr>
                <th style="text-align:right">会员生日：</th>
                <td>{$look.birthday!=='0000-00-00'?$look.birthday:''}</td>
                <th style="text-align:right">会员积分：</th>
                <td>{$look.points} </td>
                <th style="text-align:right">创建人：</th>
                <td>{$look.s_nickname}</td>
                <th style="text-align:right">创建日期：</th>
                <td>{$look.create_time}</td>
            </tr>
            <tr>
                <th style="text-align:right">家庭住址：</th>
                <td colspan="3">{$look.address}</td>
                <th style="text-align:right">更新人：</th>
                <td>{$look.u_nickname}</td>
                <th style="text-align:right">更新时间：</th>
                <td>{$look.update_time}</td>
            </tr>
            <tr>
                <th style="text-align:right">备注：</th>
                <td colspan="7">{$look.remark}</td>
            </tr>
        </table>
    </form>
    <!--<div id="legend" class="text-center">-->
    <!--    <h2>积分日志</h2> -->
    <!--</div>-->
    <!--<p>-->
    <!--    <small><i class="iconfont icon-tishi"></i> 查询到了<strong>{$count}</strong>个积分记录</small>-->
    <!--</p>-->
    <!--<table class="table table-hover table-striped">-->
    <!--    <thead>-->
    <!--        <tr>-->
    <!--            <th>ID</th>-->
    <!--            <th>标题</th>-->
    <!--            <th>积分</th>-->
    <!--            <th>创建时间</th>-->
    <!--            <th>类型</th>-->
    <!--            <th>操作人</th>-->
    <!--            <th style="width:70px;text-align:center">订单</th>-->
    <!--        </tr>-->
    <!--    </thead>-->
    <!--    <tbody>-->
    <!--        {volist name="lists" id="var"}-->
    <!--        <tr>-->
    <!--            <td>{:sprintf("%06d",$var.id)}</td>-->
    <!--            <td>{$var.title}</td>-->
    <!--            <td>{$var.value}</td>-->
    <!--            <td>{$var.create_time}</td>-->
    <!--            <td>-->
    <!--                {eq name="var.type" value="1"}-->
    <!--                <span class="badge badge-success">收入</span>-->
    <!--                {else/}-->
    <!--                <span class="badge badge-important">支出</span>-->
    <!--                {/eq}-->
    <!--            </td>-->
    <!--            <td>{$var.nickname}</td>-->
    <!--            <td style="text-align:center"><a href="<?php echo url('inventory/sales_look', ['id' => $var['m_id']]); ?>" title="查看记录">-->
    <!--                    查看</a></td>-->
    <!--        </tr>-->
    <!--        {/volist}-->
    <!--    </tbody>-->
    <!--</table>-->
    <!--{$lists->render()}-->
</div>
{/block}
