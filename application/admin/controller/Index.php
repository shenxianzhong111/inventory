<?php

namespace app\admin\controller;

use app\admin\controller\Admin;
use think\Db;
use think\Session;
use utils\Date\Date;
use think\Config;

/**
 * @title 控制台
 */
class Index extends Admin {

    /**
     * @title 一个builder调用的示例
     */
    public function _demo() {

        builder('form')
                ->addItem('category', 'select', '分类<font color="red">*</font>', model('product_category')->lists_select_tree())
                ->addItem('image', 'image', '图片', '', 'data-src="holder.js/140x140?text=选择图片" ')
                ->addItem('name', 'input', '名称<font color="red">*</font>')
                ->addItem('albums', 'albums', '图集', [
                    ['image' => 'image/5fd1e2d791c7c.png', 'description' => '描述', 'listorder' => '1'],
                    ['image' => 'image/5fd1e2d791c7c.png', 'description' => '描述2', 'listorder' => '2'],
                ])
                ->addItem('hr', 'hr', '分隔线')
                ->addItem('lowest', 'input', '最低库存报警')
                ->addItem('type', 'radio', '单选', db('product_type')->column('title', 'id'))
                ->addItem('checkbox', 'checkbox', '多选', db('product_unit')->column('name', 'id'))
                ->addItem('unit', 'select', '下拉', db('product_unit')->column('name', 'id'))
                ->addItem('remark', 'textarea', '备注')
                ->addItem('birthday', 'datetime', '生日')
                ->addItem('hidden', 'hidden', '隐藏域', 100)
                ->addItem('p', 'p', '一段文字', '一段文字')
                
                ->build();

        return view();
    }

    /**
     * @title 日志删除
     */
    public function log_clear() {


        if ($affect_rows = model('operate')->clear()) {

            $this->success('清理了' . $affect_rows . '条数据 ', 'log');
        } else {
            $this->error('没有清理任何数据');
        }
    }

    /**
     * @title 修改自己的密码
     */
    public function password() {

        if (request()->isPost()) {

            $password = input('post.password');

            if (trim($password) == '') {
                $this->error('密码不能为空');
            } else {

                if (db('system_user')->where('id', UID)->update(['password' => my_md5($password)]) !== false) {
                    $this->success('更新成功');
                } else {
                    $this->error('密码没有更新');
                }
            }
        } else {

            return view();
        }
    }

    /**
     * @title 框架页面
     */
    public function index() {

        //菜单列表
        $menu_list = model('system_menu')->getMenuList(UID);
        $this->assign('menu_list', json_encode($menu_list[1]));


        //菜单分组
        $menu_list_group = model('system_menu')->where('id', 'in', $menu_list[0])->order('sort asc')->select();
        $this->assign('menu_list_group', $menu_list_group);


        //用户的基本信息
        $this->assign('user_auth', Session::get('user_auth'));

        return view();
    }

    /**
     * @title 首页
     */
    public function main() {


        if (empty($_GET['timea']))
            $_GET['timea'] = date('Y-m-d', time() - 86400 * 30);
        if (empty($_GET['timeb']))
            $_GET['timeb'] = date('Y-m-d');


        // 出库
        $lists = model('product_sales_order')->model_where()->chart((Date::date_diff('d', $_GET['timea'], $_GET['timeb']) + 1));
        $this->assign('lists', $lists);

        // 入库
        $lists2 = model('product_storage_order')->model_where()->chart((Date::date_diff('d', $_GET['timea'], $_GET['timeb']) + 1));
        $this->assign('lists2', $lists2);

        // 磁盘使用率
        $df = @disk_free_space(".") / (1024 * 1024 * 1024);
        $dt = @disk_total_space(".") / (1024 * 1024 * 1024);

        $disk_per = round((1 - $df / $dt) * 100, 0);

        $this->assign('disk_per', $disk_per);

        return view();
    }

    /**
     * @title 我的日志
     */
    public function log() {

        if (!isset($_GET['timea']))
            $_GET['timea'] = date('Y-m-d', strtotime("-30 day"));
        if (!isset($_GET['timeb']))
            $_GET['timeb'] = date('Y-m-d');



        $count = model('operate')->model_where(UID)->count();
        $lists = model('operate')->model_where(UID)->paginate(input('get.page_size', 10), $count, ['query' => request()->get()]);

        $this->assign('count', $count);
        $this->assign('lists', $lists);
        



        return view();
    }

}
