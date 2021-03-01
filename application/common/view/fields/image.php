<div class="form-group">
    <label class="col-sm-2 control-label"><?php echo $field['title']; ?></label>
    <div class="col-sm-6">
        <img class="open_res img-thumb" 
             id="<?php echo $field['name']; ?>" 
             data-hidden="<?php echo $field['name']; ?>_hidden" 
             href="<?php echo url('admin/res/index') ?>?hidden=<?php echo $field['name']; ?>_hidden&thumb=<?php echo $field['name']; ?>"
             src="<?php 
             if($field['result'])
                echo img_resize($field['result'], 240, 0); 
             else
                echo '__PUBLIC__/static/admin/images/upload.png'
             ?>" 
             style='cursor:pointer;' <?php echo $field['extra_attr'] ?>  />
        <input type="hidden" id="<?php echo $field['name']; ?>_hidden" name="<?php echo $field['name']; ?>" value="<?php echo $field['result']; ?>" />
    </div>
</div>
<style>
.img-thumb{
    padding: 4px;
    line-height: 1.42857143;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 0;     
    display: inline-block;
    max-width: 100%;
    height: auto;
}
</style>