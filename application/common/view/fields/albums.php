
<div class="form-group">
    <label class="col-sm-2 control-label"><?php echo $field['title'] ?></label>
    <div class="col-sm-6">




        <table id="images" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th class="text-left">商品图片</th>
                    <th class="text-left">图片描述</th>
                    <th class="text-right">选项排序</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>


                <?php
                foreach ($field['options'] as $key2 => $value2) {
                    ?>


                    <tr id="gallery-image-row<?php echo $key2; ?>"> 
                        <td>                                    
                            <img class="openbox_big" 
                                 href="<?php echo url('admin/res/index') ?>?hidden=image_hidden<?php echo $key2; ?>&thumb=image_thumb<?php echo $key2; ?>"     
                                 data-hidden="image_hidden<?php echo $key2; ?>" 
                                 id="image_thumb<?php echo $key2; ?>" 
                                 style='cursor:pointer;max-width: 100px;'
                                 src="<?php echo img_resize($value2['image'], 100, 0); ?>" 
                                  />
                            <input type="hidden" name="image_ids[<?php echo $key2; ?>][image]" value="<?php echo $value2['image']; ?>" id="image_hidden<?php echo $key2; ?>"> 
                        </td> 
                        <td class="text-right"><input type="text" name="image_ids[<?php echo $key2; ?>][description]" value="<?php echo $value2['description']; ?>" class="form-control"></td> 
                        <td class="text-right"><input type="text" name="image_ids[<?php echo $key2; ?>][listorder]" value="<?php echo $value2['listorder']; ?>" class="form-control"></td> 
                        <td class="text-left"><button type="button" onclick="$('#gallery-image-row<?php echo $key2; ?>').remove();" data-toggle="tooltip" class="btn btn-danger">
                                <i class="glyphicon glyphicon-trash"></i></button>
                        </td>
                    </tr>    

                <?php } ?>

            </tbody>		                  
        </table>


        <a  onclick="addImage();" class="add_image btn btn-primary ">添加图片</a> 

    </div>

</div>

<script>
    var image_row = <?php echo count($field['options']); ?>;
    function addImage() {
        html = '<tr id="gallery-image-row' + image_row + '">';
        html += '  <td class="text-left"><img class="openbox_big" style="cursor:pointer;max-width: 100px;" src="__PUBLIC__/static/admin/images/image_select.png" data-hidden="image_hidden' + image_row + '" href="<?php echo url('admin/res/index') ?>?hidden=image_thumb' + image_row + '_hidden&thumb=image_thumb' + image_row + '" id="image_thumb' + image_row + '" /><input type="hidden" name="image_ids[' + image_row + '][image]" value="" id="image_thumb' + image_row + '_hidden" /></td>';
        html += '  <td class="text-right"><input type="text" name="image_ids[' + image_row + '][description]" value="" class="form-control" /></td>';
        html += '  <td class="text-right"><input type="text" name="image_ids[' + image_row + '][listorder]" value="' + image_row + '" class="form-control" /></td>';
        html += '  <td class="text-left"><button type="button" onclick="$(\'#gallery-image-row' + image_row + '\').remove();" data-toggle="tooltip" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button></td>';
        html += '</tr>';
        $('#images tbody').append(html);
        image_row++;
    }
</script>   
