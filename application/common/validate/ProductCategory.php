<?php

namespace app\common\validate;

class ProductCategory extends Base {

    protected $rule = [
        ['name', 'require|max:25', '名称必须|名称最多不能超过25个字符'],
        ['code', 'require|alphaNum|max:6|unique:product_category', '分类编码必须|分类编码只能是数字和英文字母|分类编码最多不能超过6个字符|分类编码已经存在了'],
    ];

}
