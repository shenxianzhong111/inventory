<?php

namespace app\admin\controller;

use app\admin\controller\Admin;

/**
 * @title 会员
 */
class Member extends Admin {

    /**
     * @title 销价管理
     */
    public function group_price() {
        if (request()->isPost()) {
            $post = request()->post();
            $price_arr = $post['g_price'];
            foreach ($price_arr as $key => $val) {
                $where = [];
                $datas = [];
                foreach ($val as $key2 => $val2) {

                    $where = ['p_id' => $key, 'g_id' => $key2];
                    $datas = ['p_id' => $key, 'g_id' => $key2, 'price' => floatval($val2)];

                    //如果存在 - 更新
                    if (db('member_price')->where($where)->count()) {
                        db('member_price')->where($where)->setField('price', floatval($val2));
                    } else {
                        db('member_price')->where($where)->insert($datas);
                    }
                }
            }
            $this->success('保存成功', url('group_price'));
        } else {
            $p_list = model('product')->where('type', 1)->order('id asc')->select(); // 非包材非赠品
            $m_group = model('member_group')->order('pid asc')->select();
            $price = model('member_price')->select();
            $price_2 = [];
            foreach ($price as $key => $value) {
                $price_2[$value['p_id']][$value['g_id']] = $value['price'];
            }
            $this->assign('p_list', $p_list);
            $this->assign('m_group', $m_group);
            $this->assign('price', $price_2);
            return view();
        }
    }

    /**
     * @title 会员管理
     */
    public function index() {

        $this->assign('count', $count = model('member')->model_where()->count('distinct a.id'));
        $this->assign('lists', $lists = model('member')->model_where()->paginate(input('get.page_size', 10), $count, ['query' => request()->get()]));


        builder('list')
                ->addItem('id', '#')
                // ->addItem('group_name', '分组')
                ->addItem('nickname', '会员姓名')
                ->addItem('sex', '性别')
                ->addItem('card', '会员卡号')
                ->addItem('tel', '联系电话')
                ->addItem('qq', 'QQ')
                ->addItem('category', '会员分类')
                ->addItem('points', '会员积分')
                ->addItem('s_nickname', '创建人')
                ->addItem('create_time', '创建日期')
                ->addAction('查看', 'look', '', 'btn btn-primary btn-xs', '')
                ->addAction('编辑', 'edit', '', 'btn btn-success btn-xs', '')
                ->addAction('删除', 'delete', '', 'btn btn-danger btn-xs ajax-get confirm')
                ->build();
        return view();
    }

    /**
     * @title 会员删除
     */
    public function delete($id) {

        empty($id) && $this->error('参数不能为空');


        if (db('member')->where('id', $id)->delete()) {
            model('operate')->success('删除会员信息');
            $this->success('');
        } else {
            model('operate')->failure('删除会员信息');
            $this->error('删除失败');
        }
    }

    /**
     * @title 会员查看
     */
    public function look($id) {

        empty($id) && $this->error('参数不能为空');
      
        $where['m_id'] = $id;
        $count = model('member_points')->where($where)->count('id');
        $this->assign('count', $count);
        $this->assign('look', model('member')->model_where()->where('a.id', $id)->find());
        $lists = model('member_points')
                ->alias('a')
                ->order('a.id desc')
                ->field('a.*,s.nickname')
                ->join('system_user s', 'a.u_id=s.id', 'LEFT')
                ->where($where)
                ->paginate(10, $count, ['query' => request()->get()]);
        $this->assign('lists', $lists);

        return view();
    }

    /**
     * @title 会员修改
     */
    public function edit($id) {

        empty($id) && $this->error('参数不能为空');


        if (request()->isPost()) {
            $post = request()->post();

            if (!validate('member')->check($post))
                $this->error(validate('member')->getError());

            //谁最后一次更新的资料
            $post['update'] = UID;
            $post['update_time'] = time();
            if (db('member')->where('id', $post['id'])->update($post) !== false) {
                model('operate')->success('更新会员');
                $this->success('', 'index');
            } else {
                $this->error('新增失败');
            }
        } else {
            $one = db('member')->where('id', $id)->find();
            builder('form')
                    // ->addItem('g_id', 'select', '会员组', model('member_group')->lists_select_tree(), '')
                    ->addItem('nickname', 'input', '名称<font color="red">*</font>')
                    ->addItem('sex', 'radio', '会员性别', [1 => '男', 2 => '女'])
                    ->addItem('card', 'input', '会员卡号')
                    ->addItem('tel', 'input', '联系电话')
                    ->addItem('qq', 'input', 'QQ')
                    ->addItem('email', 'input', 'Email')
                    ->addItem('address', 'input', '家庭住址')
                    ->addItem('id_card', 'input', '身份证号')
                    ->addItem('birthday', 'datetime', '会员生日')
                    ->addItem('remark', 'input', '备注')
                    ->build($one);
            return view();
        }
    }

    /**
     * @title 会员新增
     */
    public function add() {
        if (request()->isPost()) {
            $post = request()->post();

            if (!validate('member')->check($post))
                $this->error(validate('member')->getError());

            $post['u_id'] = UID;
            $post['create_time'] = time();
            $post['update_time'] = time();
            if (!empty($post['card']) && model('member')->where('card', $post['card'])->find())
                $this->error('会员卡号已存在');
            if (model('member')->allowField(true)->save($post)) {
                model('operate')->success('新增会员');
                $this->success('', 'index');
            } else {
                model('operate')->failure('新增会员');
                $this->error('新增失败');
            }
        } else {
            builder('form')
                    // ->addItem('g_id', 'select', '会员组', model('member_group')->lists_select_tree(), '')
                    ->addItem('nickname', 'input', '名称<font color="red">*</font>')
                    ->addItem('sex', 'radio', '会员性别', [1 => '男', 2 => '女'])
                    ->addItem('card', 'input', '会员卡号')
                    ->addItem('tel', 'input', '联系电话')
                    ->addItem('qq', 'input', 'QQ')
                    ->addItem('email', 'input', 'Email')
                    ->addItem('address', 'input', '家庭住址')
                    ->addItem('id_card', 'input', '身份证号')
                    ->addItem('birthday', 'datetime', '会员生日')
                    ->addItem('remark', 'input', '备注')
                    ->build(['sex' => 1]);
            return view();
        }
    }

    /**
     * @title 会员分组
     */
    public function group() {
        $lists = model('member_group')->model_where()->lists_tree(NULL, 'a.sort,a.id desc');
        $this->assign('lists', $lists);
        builder('list')
                ->addItem('id', '#')
                ->addSortItem('sort', '排序', 'member_group')
                ->addItem('name', '分类名称')
                ->addItem('member_count', '会员数')
                ->addAction('编辑', 'group_edit', '', 'btn btn-success btn-xs', 'data-toggle="modal" data-target="#modal"')
                ->addAction('删除', 'group_delete', '', 'btn btn-danger btn-xs ajax-get confirm')
                ->build();
        return view();
    }

    /**
     * @title 会员分组新增
     */
    public function group_add() {

        if (request()->isPost()) {
            $post = request()->post();

            if (!validate('member_group')->check($post))
                $this->error(validate('member_group')->getError());

            if (db('member_group')->insert(['name' => $post['name'], 'pid' => $post['pid']])) {
                $this->success('');
            } else {
                $this->error('添加失败');
            }
        } else {
            builder('form')
                    ->addItem('pid', 'select', '上级', model('member_group')->lists_select_tree(), '')
                    ->addItem('name', 'input', '分组名称<font color="red">*</font>', '', '')
                    ->build();
            return view();
        }
    }

    /**
     * @title 会员分组修改
     */
    public function group_edit($id) {

        empty($id) && $this->error('参数不能为空');

        if (request()->isPost()) {
            $post = request()->post();

            if (!validate('member_group')->check($post))
                $this->error(validate('member_group')->getError());


            if (db('member_group')->where('id', $post['id'])->update(['name' => $post['name'], 'pid' => $post['pid']])) {
                $this->success('');
            } else {
                $this->error('更新失败');
            }
        } else {



            $one = db('member_group')->where('id', $id)->find();

            builder('form')
                    ->addItem('pid', 'select', '上级', model('member_group')->lists_select_tree(['id' => ['neq', $id]]), '')
                    ->addItem('name', 'input', '分组名称<font color="red">*</font>', '', '')
                    ->build($one);

            return view();
        }
    }

    /**
     * @title 会员分组删除
     */
    public function group_delete($id) {

        empty($id) && $this->error('参数不能为空');


        if (db('member')->where('g_id', $id)->count())
            $this->error('会员组存在会员，无法删除');

        if (db('member_group')->where('id', $id)->delete()) {
            $this->success('');
        } else {
            $this->error('删除失败');
        }
    }

}
