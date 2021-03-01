<?php

namespace app\admin\controller;

use app\admin\controller\Admin;
use utils\Document\ClassReader;
use utils\Document\Document;
use think\Cache;
use think\Db;
use think\Response;

/**
 * @title 系统
 */
class System extends Admin {

    /**
     * @title 信息列表
     *
     */
    public function auth_group() {
        $lists = db('auth_group')->select();
        $this->assign('lists', $lists);
        
        builder('list')
                ->addItem('id', '#')
                ->addItem('title', '名称')
                ->addItem('remark', '描述')
                ->addAction('编辑', 'auth_group_edit', '', 'btn btn-success btn-xs')
                ->addAction('删除', 'auth_group_delete', '', 'btn btn-danger btn-xs ajax-get confirm')
                ->build();
        return view();
    }

    /**
     * @title 添加角色
     */
    public function auth_group_add() {
        if (request()->isPost()) {

            $post = request()->post();

            if (!validate('auth_group')->check($post))
                $this->error(validate('auth_group')->getError());

            $data['title'] = $post['title'];
            $data['remark'] = $post['remark'];
            $data['menus'] = implode(',', $post['menu_ids']);

            if (db('auth_group')->insert($data)) {
                $this->success('', 'auth_group');
            } else {
                $this->error('添加失败');
            }
        } else {

            // 加载菜单多级,用ztree显示出来
            $menu_lists = db('system_menu')->field('id,pid,name,path')->select();
            foreach ($menu_lists as $key => $value) {
                $menu_lists[$key]['inputName'] = 'menu_ids[]';
            }
            $str = json_encode(gen_tree($menu_lists));
            $str = str_replace('"id"', '"value"', $str);
            $this->assign('menu_lists', $str);

            builder('form')
                    ->addItem('title', 'input', '名称<font color="red">*</font>')
                    ->addItem('remark', 'textarea', '描述')
                    ->build();
            return view();
        }
    }

    /**
     * @title 编辑角色
     */
    public function auth_group_edit($id) {
        empty($id) && $this->error('参数不能为空');

        if (request()->isPost()) {

            $post = request()->post();

            if (!validate('auth_group')->check($post))
                $this->error(validate('auth_group')->getError());


            $data['title'] = $post['title'];
            $data['remark'] = $post['remark'];
            $data['menus'] = implode(',', $post['menu_ids']);

            if (db('auth_group')->where('id', $post['id'])->update($data) !== false) {
                $this->success('', 'auth_group');
            } else {
                $this->error('更新失败');
            }
        } else {
            $one = db('auth_group')->where('id', $id)->find();

            $this->assign($one);

            $menus_arr = explode(',', $one['menus']);

            // 加载菜单多级,用ztree显示出来
            $menu_lists = db('system_menu')->field('id,pid,name,path')->where('status',1)->select();
            foreach ($menu_lists as $key => $value) {
                if (in_array($value['id'], $menus_arr)) {
                    $menu_lists[$key]['checked'] = true;
                }
                $menu_lists[$key]['inputName'] = 'menu_ids[]';
            }
            $str = json_encode(gen_tree($menu_lists));
            $str = str_replace('"id"', '"value"', $str);
            $this->assign('menu_lists', $str);



            builder('form')
                    ->addItem('title', 'input', '名称<font color="red">*</font>')
                    ->addItem('remark', 'textarea', '备注')
                    ->build($one);
            return view();
        }
    }

    /**
     * @title 删除资源
     *
     * @param  int  $id
     * @return Response
     */
    public function auth_group_delete($id) {
        empty($id) && $this->error('参数不能为空');
        $affect_rows = db('auth_group')->where('id', $id)->delete();
        if ($affect_rows > 0) {
            $this->success('');
        } else {
            $this->error('删除失败！');
        }
    }

    /**
     * @title 菜单绑定规则
     */
    public function menu_rule_bind($id, $dir = 'admin') {

        empty($id) && $this->error('参数缺失');

        if (request()->isPost()) {


            $id = input('post.id', 0);
            $rules = input('post.rules/a', []);



            $affect_rows = db('system_menu')->where('id', $id)->setField('rules', implode(',', $rules));

            if (is_numeric($affect_rows)) {
                $this->success();
            } else {
                $this->error('更新失败');
            }
        } else {


            $one = db('system_menu')->where('id', $id)->find();

            $this->assign($one);

            $dir_all = APP_PATH . $dir . DIRECTORY_SEPARATOR . 'controller';
            $service_annotation = $this->_get_service_annotation($dir_all);
            //print_r($service_annotation);
            $this->assign('service_annotation', $service_annotation);
            $this->assign('dir', $dir);
            // 
            //把application目录下的各个目录名加载出来。
            $folder = glob(APP_PATH . '*', GLOB_ONLYDIR);
            foreach ($folder as $key => $value) {
                $folder[$key] = str_replace(APP_PATH, '', $value);
            }
            $this->assign('folder', array_diff($folder, ['extra', 'runtime']));
            //$this->assign('folder', $folder);
            return view();
        }
    }

    /**
     * @title 获取各个类的各个方法的注释字段，返回二维+数组
     */
    private function _get_service_annotation($dir) {
        $module_list = [];
        //类名&方法名解析类
        $class_reader = new ClassReader($dir);
        $class_tree = $class_reader->get_service_tree();
        //print_r($class_tree);exit;
        foreach ($class_tree as $classes => $methods) {
            $class_file = $dir . '/' . $classes . '.php';
            $class_name = $classes;
            //注释解析类
            $my_doc = new Document($class_file);
            $class_annotation = $my_doc->getAnnotation($class_name);
            $module_list[$classes] = $class_annotation;
            //依次循环输出方法名 
            foreach ($methods as $k2 => $method_name) {
                $method_annotation = $my_doc->getAnnotation($class_name, $method_name);
                if ($method_annotation) {
                    $module_list[$classes]['child'][$method_name] = $method_annotation;
                }
            }
        }
        return $module_list;
    }

    /**
     * @title 显示菜单
     */
    public function menu_show() {

        $ids = input('post.ids/a');

        $affect_rows = db('system_menu')->where('id', 'in', $ids)->setField('status', 1);

        if ($affect_rows) {
            $this->success('', 'menu');
        } else {
            $this->error('没有任何更新');
        }
    }

    /**
     * @title 隐藏菜单
     */
    public function menu_hide() {

        $ids = input('post.ids/a');

        $affect_rows = db('system_menu')->where('id', 'in', $ids)->setField('status', 0);

        if ($affect_rows) {
            $this->success('', 'menu');
        } else {
            $this->error('没有任何更新');
        }
    }

    /**
     * @title 列表
     */
    public function user() {
        $lists = model('system_user')->where('id', '<>', 1)->select();
        foreach ($lists as $key => $value) {
            $lists[$key]['group_name'] = db('auth_group_access')
                    ->alias('a')
                    ->join('auth_group b', 'b.id=a.group_id', 'LEFT')
                    ->where('a.uid', $value['id'])
                    ->value('b.title');
        }
        //  print_r($list_obj);exit;
        $this->assign('lists', $lists);
        
        builder('list')
                ->addItem('id', '#')
                ->addItem('group_name', '分组')
                ->addItem('username', '账号')
                ->addItem('nickname', '姓名')
                ->addItem('create_time', '创建日期')
                ->addAction('重置密码', 'user_password_reset', '', 'btn btn-warning btn-xs ajax-get confirm')
                ->addAction('编辑', 'user_edit', '', 'btn btn-success btn-xs', 'data-toggle="modal" data-target="#modal"')
                ->addAction('删除', 'user_delete', '', 'btn btn-danger btn-xs ajax-get confirm')
                ->build();
        return view();
    }

    /**
     * @title 添加用户
     */
    function user_add() {
        if (request()->isPost()) {
            $post = request()->post();
            
            $data['username'] = request()->post('username') ?: '';
            $data['nickname'] = request()->post('nickname') ?: '';
            $data['password'] = my_md5($post['password']);
            
            $data['create_time'] = time();
            $data['update_time'] = time();
            $data['status'] = 1;
            if (!validate('system_user')->check($post))
                $this->error(validate('system_user')->getError());
            $message = model('system_user')->user_add($data);
            if ($message) {
                $this->error($message);
            } else {
                $this->success('', 'user');
            }
        } else {
            builder('form')
                    ->addItem('username', 'input', '账号<font color="red">*</font>')
                    ->addItem('nickname', 'input', '姓名<font color="red">*</font>')
                    ->addItem('auth_group_id', 'select', '分组', db('auth_group')->column('title', 'id'))
                    ->addItem('password', 'input', '密码<font color="red">*</font>', '', '', '', '')
                    ->build();
            return view();
        }
    }

    /**
     * @title 编辑用户
     */
    function user_edit($id) {
        empty($id) && $this->error('参数不能为空');
        if ($id == 1)
            $this->error('超级管理员暂不支持修改');
        if (request()->isPost()) {
            $post = request()->post();
            $data['username'] = request()->post('username') ?: '';
            $data['nickname'] = request()->post('nickname') ?: '';
            $data['update_time'] = time();
            if (!validate('system_user')->check($post))
                $this->error(validate('system_user')->getError());
            $message = model('system_user')->user_edit($data, $post['id']);
            if ($message) {
                $this->error($message);
            } else {
                $this->success('', 'user');
            }
        } else {
            //获取基本信息
            $one = db('system_user')->where('id', '=', $id)->find();
            $one['auth_group_id'] = db('auth_group_access')->where('uid', $id)->value('group_id');
            $this->assign($one);
            builder('form')
                    ->addItem('username', 'input', '账号<font color="red">*</font>', '', 'readonly')
                    ->addItem('nickname', 'input', '姓名<font color="red">*</font>')
                    ->addItem('auth_group_id', 'radio', '分组', db('auth_group')->column('title', 'id'))
                    ->build($one);
            return view();
        }
    }

    /**
     * @title 员工密码重置
     * 重置后的密码为 123456
     */
    public function user_password_reset($id) {

        empty($id) && $this->error('参数不能为空');

        $affect_rows = db('system_user')->where('id', $id)->setField('password', my_md5('123456'));

        if (false !== $affect_rows) {
            $this->success('重置完成');
        } else {
            $this->error('没有任何更新');
        }
    }

    /**
     * @title 用户删除
     */
    public function user_delete($id) {
        empty($id) && $this->error('参数不能为空');
        if ($id == 1)
            $this->error('超级管理员都想删，不合适吧？');
        $message = model('system_user')->user_delete($id);
        if ($message) {
            $this->error($message);
        } else {
            $this->success('', 'user');
        }
    }

    /**
     * @title 菜单列表
     */
    public function menu() {
        $lists = model('system_menu')->lists_tree();
        foreach ($lists as $key => $value) {
            $lists[$key]['name'] = '<i class=" ' . $value['icon'] . '"></i>' . $value['name'];
            $lists[$key]['status'] = $value['status'] == 0 ? '隐藏' : '';
        }
        $this->assign('lists', $lists);
        builder('list')
                ->addItem('id', '#')
                ->addItem('name', '名称')
                ->addItem('url', 'URL')
                ->addSortItem('sort', '排序', 'system_menu')
                ->addItem('rule_count', '规则数量')
                ->addItem('status', '状态')
                ->addAction('子菜单', 'menu_add', '', 'btn btn-warning btn-xs', 'data-toggle="modal" data-target="#modal"')
                ->addAction('规则', 'menu_rule_bind', '', 'btn btn-primary btn-xs', 'data-toggle="modal" data-target="#modal_big"')
                ->addAction('编辑', 'menu_edit', '', 'btn btn-success btn-xs', 'data-toggle="modal" data-target="#modal"')
                ->addAction('删除', 'menu_delete', '', 'btn btn-danger btn-xs ajax-get confirm')
                ->build();
        return view();
    }

    /**
     * @title 菜单导入
     */
    public function menu_import() {

        $file = request()->file('file');
        $fileurl = $file->getInfo()['tmp_name'];
        $json = file_get_contents($fileurl);

        Db::startTrans();
        try {

            $menu_arr = json_decode($json, true);

            // 清空menu表
            db('system_menu')->delete(true);

            // 导入        
            foreach ($menu_arr as $key => $value) {
                db('system_menu')->insert([
                    'id' => $value['id'],
                    'pid' => $value['pid'],
                    'name' => $value['name'],
                    'sort' => $value['sort'],
                    'status' => $value['status'],
                    'path' => $value['path'],
                    'icon' => $value['icon'],
                    'url' => $value['url'],
                    'home' => $value['home'],
                    'is_dev' => $value['is_dev'],
                    'rules' => $value['rules'],
                ]);
            }

            // 提交事务
            Db::commit();
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
            return ['code' => 1, 'msg' => $e->getMessage(), 'data' => 0];
        }



        return ['code' => 0, 'msg' => 'success', 'data' => 1];
    }

    /**
     * @title 菜单导出
     */
    public function menu_export() {

        header("Content-type: application/json; charset=utf-8");
        header("Accept-Ranges: bytes");
        header("Content-Disposition: attachment; filename = menu.json"); //文件命名
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Pragma: public");

        $lists = db('system_menu')->select();

        echo json_encode($lists);
    }

    /**
     * @title 获取菜单深度
     * @param $id
     * @param $array
     * @param $i
     */
    protected function _get_level($id, $array = [], $i = 0) {
        if ($array[$id]['pid'] == 0 || empty($array[$array[$id]['pid']]) || $array[$id]['pid'] == $id) {
            return $i;
        } else {
            $i++;
            return $this->_get_level($array[$id]['pid'], $array, $i);
        }
    }

    /**
     * @title 添加
     */
    public function menu_add($id = 0) {
        if (request()->isPost()) {
            $post = request()->post();
            if (empty($post['name'])) {
                $this->error('标题不能为空');
            }

            $insert_id = db('system_menu')->insertGetId($post);

            if (false !== $insert_id) {

                db('system_menu')->where('id', $insert_id)->setField('sort', $insert_id);


                //添加PATH信息
                if (isset($post['pid']) && $post['pid']) {
                    $parent = db('system_menu')->where("id", $post['pid'])->find();
                    $path = $parent['path'] . "-$insert_id";
                } else {
                    $path = "0-$insert_id";
                }
                db('system_menu')->where('id', $insert_id)->setField('path', $path);
                //添加PATH信息结束

                $this->success("", url('menu'));
            } else {
                $this->error(model('system_menu')->getError());
            }
        } else {



            builder('form')
                    ->addItem('pid', 'select', '上级', model('system_menu')->lists_select_tree())
                    ->addItem('name', 'input', '名称<font color="red">*</font>', '', '')
                    ->addItem('url', 'input', 'URL')
                    ->addItem('icon', 'input', '图标', '', '', '', '<a href="' . APP_URL . '/static/admin/font/demo_index.html" target="_blank">参照</a>')
                    ->addItem('status', 'radio', '状态', [0 => '隐藏', 1 => '显示'])
                    ->build(['pid' => $id]);
            return view();
        }
    }

    /**
     * @title 编辑菜单
     */
    public function menu_edit($id) {
        empty($id) && $this->error('参数不能为空');
        if (request()->isPost()) {
            $post = request()->post();
            if (empty($post['name'])) {
                $this->error('标题不能为空');
            }


            //更新PATH信息
            if (isset($post['pid']) && $post['pid']) {
                $parent = db('system_menu')->where("id", $post['pid'])->find();
                $post['path'] = $parent['path'] . "-" . $post['id'];
            } else {
                $post['path'] = "0-" . $post['id'];
            }
            //更新PATH信息

            $affect_rows = db('system_menu')->where('id', $post['id'])->update($post);
            if (false !== $affect_rows) {
                $this->success("", url('menu'));
            } else {
                $this->error(model('system_menu')->getError());
            }
        } else {
            $one = db('system_menu')->where('id', $id)->find();
            builder('form')
                    ->addItem('pid', 'select', '上级', model('system_menu')->lists_select_tree())
                    ->addItem('name', 'input', '名称<font color="red">*</font>', '', '')
                    ->addItem('url', 'input', 'URL')
                    ->addItem('icon', 'input', '图标', '', '', '', '<a href="' . APP_URL . '/static/admin/font/demo_index.html" target="_blank">参照</a>')
                    ->addItem('status', 'radio', '状态', [0 => '隐藏', 1 => '显示'])
                    ->build($one);
            return view();
        }
    }

    /**
     * @title 删除菜单
     */
    public function menu_delete($id) {
        empty($id) && $this->error('参数不能为空');
        $count = db('system_menu')->where('pid', '=', $id)->count();
        if ($count > 0) {
            $this->error("该菜单下还有子菜单，无法删除！");
        }
        if (db('system_menu')->delete($id) !== false) {
            $this->success("");
        } else {
            $this->error("删除失败！");
        }
    }

    /**
     * @title 配置列表
     */
    public function config() {

        $base_dir = APP_DIR . '/../application/extra/';

        if (request()->isPost()) {


            $category = input('post.category');
            $category_root = $base_dir . $category;
            if (is_file($category_root)) {

                $post = input('post.');
                $configs = $post['configs'];

                $title = $post['title'];

                if (empty($title)) {
                    $this->error('配置名称不能为空');
                }

                $array_str = '<?php ' . chr(10) . chr(10) . '/**' . chr(10) . ' * @title ' . $title . '' . chr(10) . ' */' . chr(10) . 'return [' . chr(10);

                foreach ($configs as $key => $value) {

                    $remark = $value['remark'] ?? '';

                    $key = is_numeric($value['key']) ? $value['key'] : "'" . $value['key'] . "'";
                    $value = is_numeric($value['value']) ? $value['value'] : "'" . $value['value'] . "'";

                    $array_str .= chr(9) . $key . " => " . $value . ", //" . $remark . "" . chr(10);
                }

                $array_str = $array_str . '];';

                /*  【直接保存到文件】  */
                $check = file_put_contents($category_root, $array_str);
                if ($check > 0) {
                    $this->success("保存成功", url('config', ['category' => $category]));
                } else {
                    $this->error("内容为空");
                }
            } else {
                $this->error("请选择一个有效模板文件");
            }
        } else {

            /*  【当前的配置文件名称】  */
            $category = input('get.category', 'base.php');
            $this->assign('category', $category);
            /*  【通过当前name获取配置文件的内容】  */
            $config_content = file_get_contents($base_dir . $category);

            // 解析配置
            preg_match_all("/\s*[\'\"]?(.*?)[\'\"]?\s*=>\s*[\'\"]?(.*?)[\'\"]?,(\s*\/\/)?([^\r\n]*)/", $config_content, $matches);
            // dd($matches);
            $this->assign('lists', $matches);

            preg_match('/\@title\s*([^\r\n]*)?/i', $config_content, $matches2);
            $title = isset($matches2[1]) ? $matches2[1] : $category;
            $this->assign('title', $title);

            $file_list = my_scan_dir($base_dir . "*.php");
            $navs = [];
            /*  【通过文件名，依次解析title】  */
            foreach ($file_list as $key => $value) {
                $content = file_get_contents($base_dir . $value);
                $array = parse_config_tit($content);
                if ($array) {
                    $navs[$value] = $array;
                } else {
                    //$navs[$value] = str_replace('.php', '', $value);
                }
            }
            $this->assign('navs', $navs);

            return view();
        }
    }

}
