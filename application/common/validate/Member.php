<?php

namespace app\common\validate;

class Member extends Base {

    protected $rule = [
        ['nickname', 'require|max:25', '名称必须|名称最多不能超过25个字符'],
        ['email', 'email', '邮箱格式错误']
    ];

}
