<div class="panel panel-default">
    <div class="panel-heading">菜单绑定规则 
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
    <div class="panel-body">


        <?php
        $rules_arr = explode(',', $rules);
        $rules_arr = array_filter($rules_arr);
        ?>

        <style>
            td.title {background:#f9f9f9; font-weight:bold;}
            .table-common{margin-bottom: 10px;}
        </style>

        <form action="<?php echo url('menu_rule_bind') ?>" method="post" class="update_rule">
            <input type="hidden" name="id" value="{$Think.get.id}" />

            <div class="table-common">     

                <button type="submit" class="btn btn-primary ajax-post" target-form="update_rule">更新规则</button>
                <span>已绑定<?php echo count($rules_arr); ?>条</span>
            </div>
            
            


            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">

                <?php
                foreach ($service_annotation as $k => $v) {
                    ?>
                    <li role="presentation" <?php
                    if ($k == 'Admin') {
                        echo 'class="active"';
                    }
                    ?>><a href="#<?php echo $k; ?>" aria-controls="<?php echo $k; ?>" role="tab" data-toggle="tab"><?php echo $k; ?></a></li>
<?php } ?>

            </ul>

            <!-- Tab panes -->
            <div class="tab-content">



                <?php
                foreach ($service_annotation as $k => $v) {
                    ?>
                    <div role="tabpanel" class="tab-pane <?php
                if ($k == 'Admin') {
                    echo 'active';
                }
                ?>" id="<?php echo $k; ?>">
                        <table class="table table-hover">
                            <tr>
                                <td class='title'></td>
                                <td class='title'><?php echo $k; ?></td>
                                <td class='title'><?php echo $v['title']; ?></td>
                                <td class='title'>Rule</td>
                            </tr>
                            <?php
                            if (isset($v['child'])) {
                                foreach ($v['child'] as $k2 => $v2) {
                                    $rule = $dir . '/' . $k . '/' . $k2;
                                    $rule = hump_to_underline($rule);
                                    ?>
                                    <tr <?php
                        if (in_array($rule, $rules_arr)) {
                            echo 'class="active"';
                        }
                                    ?>>
                                        <td><input type="checkbox" name="rules[]" <?php
                                if (in_array($rule, explode(',', $rules))) {
                                    echo 'checked';
                                }
                                ?> value="<?php echo $rule; ?>"></td>
                                        <td><?php echo $k2; ?></td>
                                        <td><?php echo isset($v2['title']) ? $v2['title'] : '<span style="color:red">未设置title标签</span>'; ?></td>
                                        <td><?php echo $rule; ?></td>
                                    </tr>
                            <?php
                        }
                    }
                    ?>
                        </table></div>
    <?php
}
?>
            </div>
        </form>
    </div>
</div>
<script>
    $(function () {
        $(".table tr").click(function () {
            var hasSelected = $(this).hasClass("active");
            $(this)[hasSelected ? "removeClass" : "addClass"]("active").find(":checkbox").prop("checked", !hasSelected);
        })
    });
</script>