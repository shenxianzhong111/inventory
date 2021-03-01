<?php

namespace app\admin\controller;

use app\admin\controller\Admin;

/**
 * @title 库存配置
 */
class Configure extends Admin {

    /**
     * @title 产品查看
     */
    public function product_look($id, $w_id = 0) {

        empty($id) && $this->error('ID参数不能为空');

        if (request()->post('looktype')) {

            $count = input('post.count');

            if (request()->post('looktype') === '1') {

                $where1['a.p_id'] = $id;
                if ($w_id) {
                    $where1['a.w_id'] = $w_id;
                }
                $this->assign('inventory', model('product_inventory')->model_where()->where($where1)->paginate(input('get.page_size', 10), $count, ['query' => request()->get()]));
            } elseif (request()->post('looktype') === '2') {

                $where2['a.p_id'] = $id;
                if ($w_id) {
                    $where2['a.w_id'] = $w_id;
                }
                $this->assign('warehouse', model('product_storage_order_data')->model_where()->where($where2)->paginate(input('get.page_size', 10), $count, ['query' => request()->get()]));
            } elseif (request()->post('looktype') === '3') {

                $where3['a.p_id'] = $id;
                if ($w_id) {
                    $where3['a.out_id|a.jin_id'] = $w_id;
                }
                $this->assign('warehouse_allocate', model('product_warehouse_transfer')->model_where()->where($where3)->group('a.id')->paginate(input('get.page_size', 10), $count, ['query' => request()->get()]));
            } elseif (request()->post('looktype') === '4') {


                $where4['a.p_id'] = $id;
                if ($w_id) {
                    $where4['a.w_id'] = $w_id;
                }
                $this->assign('lists', $lists = model('product_sales_order_data')->model_where()->where($where4)->paginate(input('get.page_size', 10), $count, ['query' => request()->get()]));
            } elseif (request()->post('looktype') === '5') {


                $where5['a.p_id_bc'] = $id;
                if ($w_id) {
                    $where5['a.w_id'] = $w_id;
                }
                $this->assign('lists', $lists = model('product_build_order_data')->model_where()->where($where5)->paginate(input('get.page_size', 10), $count, ['query' => request()->get()]));
            } elseif (request()->post('looktype') === '6') {


                $where6['a.p_id'] = $id;
                if ($w_id) {
                    $where6['a.w_id'] = $w_id;
                }
                $this->assign('lists', $lists = model('product_scrapped')->model_where()->where($where6)->paginate(input('get.page_size', 10), $count, ['query' => request()->get()]));
            }

            $this->assign('looktype', request()->post('looktype'));
            return view('product_look_table');
        } else {


            $this->assign('var', $var = model('product')->model_where()->group('a.id')->where('a.id', $id)->find());


            // 库存记录 1
            $where1['a.p_id'] = $id;
            if ($w_id) {
                $where1['a.w_id'] = $w_id;
            }
            $count1 = model('product_inventory')->model_where()->where($where1)->count();
            $this->assign('count1', $count1);
            $quantity_sum1 = model('product_inventory')->model_where()->where($where1)->sum('a.quantity');
            $this->assign('quantity_sum1', $quantity_sum1);

            // 入库记录 2
            $where2['a.p_id'] = $id;
            if ($w_id) {
                $where2['a.w_id'] = $w_id;
            }
            $count2 = model('product_storage_order_data')->model_where()->where($where2)->count();
            $this->assign('count2', $count2);
            $quantity_sum2 = model('product_storage_order_data')->model_where()->where($where2)->sum('a.quantity');
            $this->assign('quantity_sum2', $quantity_sum2);

            // 调拨记录
            $where3['a.p_id'] = $id;
            if ($w_id) {
                $where3['a.out_id|a.jin_id'] = $w_id;
            }
            $count3 = model('product_warehouse_transfer')->model_where()->where($where3)->group('a.id')->count();
            $this->assign('count3', $count3);

            // 合计
            $where31['a.p_id'] = $id;
            if ($w_id) {
                $where31['a.jin_id'] = $w_id;
            }
            $quantity_sum31 = model('product_warehouse_transfer')->alias('a')->where($where31)->sum('a.number');

            $where32['a.p_id'] = $id;
            if ($w_id) {
                $where32['a.out_id'] = $w_id;
            }
            $quantity_sum32 = model('product_warehouse_transfer')->alias('a')->where($where32)->sum('a.number');

            $this->assign('quantity_sum31', $quantity_sum31);
            $this->assign('quantity_sum32', $quantity_sum32);

            //出库记录          
            $where4['a.p_id'] = $id;
            if ($w_id) {
                $where4['a.w_id'] = $w_id;
            }
            $count4 = model('product_sales_order_data')->model_where()->where($where4)->count();
            $this->assign('count4', $count4);
            // 合计
            $quantity_sum4 = model('product_sales_order_data')->model_where()->where($where4)->sum('a.quantity');
            $this->assign('quantity_sum4', $quantity_sum4);
            $quantity_sum42 = model('product_sales_order_data')->model_where()->where($where4)->sum('a.returns');
            $this->assign('quantity_sum42', $quantity_sum42);

            // 报废记录          
            $where6['a.p_id'] = $id;
            if ($w_id) {
                $where6['a.w_id'] = $w_id;
            }
            $count6 = model('product_scrapped')->model_where()->where($where6)->count();
            $this->assign('count6', $count6);
            // 合计
            $quantity_sum6 = model('product_scrapped')->model_where()->where($where6)->sum('a.quantity');
            $this->assign('quantity_sum6', $quantity_sum6);

            // 生产记录          
            $where5['a.p_id_bc'] = $id;
            if ($w_id) {
                $where5['a.w_id'] = $w_id;
            }
            $count5 = model('product_build_order_data')->model_where()->where($where5)->count();
            $this->assign('count5', $count5);
            // 合计
            $quantity_sum5 = model('product_build_order_data')->model_where()->where($where5)->sum('a.quantity');
            $this->assign('quantity_sum5', $quantity_sum5);


            return view();
        }
    }

    /**
     * @title 产品类型
     */
    public function product_type() {


        $lists = db('product_type')->select();

        $this->assign('lists', $lists);

        builder('list')
                ->addItem('id', '#')
                ->addItem('title', '类型名称', ['common' => 'prompt', 'url' => 'product_type_field'])
                ->addAction('删除', 'product_type_del', '', 'btn btn-danger btn-xs ajax-get confirm')
                ->build();

        return view();
    }

    /**
     * @title 产品类型添加
     */
    public function product_type_add() {

        if (request()->isPost()) {

            if (request()->post('field') && request()->post('val')) {
                $insert_id = db('product_type')->insertGetId(['title' => request()->post('val')]);

                if ($insert_id) {
                    $this->success("");
                } else {
                    $this->error($insert_id);
                }
            } else {
                $this->error("字段不能为空");
            }
        }
    }

    /**
     * @title 产品类型字段编辑
     */
    public function product_type_field($id) {

        empty($id) && $this->error('ID不能为空');

        if (request()->post('field') && request()->post('val')) {

            $affect_rows = db('product_type')->where('id', $id)->setField(request()->post('field'), request()->post('val'));

            if ($affect_rows) {
                $this->success('');
            } else {
                $this->error($result);
            }
        }
    }

    /**
     * @title 产品类型删除
     * @param type $id
     */
    public function product_type_del($id) {

        empty($id) && $this->error('ID不能为空');

        if ($result = db('product_type')->where('id', $id)->delete()) {
            $this->success('');
        } else {
            $this->error($result);
        }
    }

    /**
     * @title 产品管理
     */
    public function product() {



        $count = model('product')->model_where()->count('distinct a.id');
        $lists = model('product')->model_where()->group('a.id')->paginate(input('get.page_size', 10), $count, ['query' => request()->get()]);


        $this->assign('count', $count);
        $this->assign('lists', $lists);
        

        builder('list')
                ->addItem('category', '分类')
                ->addItem('code', '识别码')
//                ->addItem('image', '图片', 'image')
                ->addItem('name', '名称')
                ->addItem('sales', '销售价')
                ->addItem('purchase', '进货价')
                ->addItem('format', '规格')
                // ->addItem('bar_code', '条形码')
                ->addItem('quantity:unit', '库存')
                ->addItem('warehouse', '仓库分布')
                // ->addItem('type', '类型')
                // ->addItem('update_time', '更新')
                ->addAction('查看', 'product_look', '', 'btn btn-primary btn-xs')
                ->addAction('编辑', 'product_edit', '', 'btn btn-success btn-xs')
                ->addAction('删除', 'product_del', '', 'btn btn-danger btn-xs ajax-get confirm')
                ->build();
        return view();
    }

    /**
     * @title 产品添加
     */
    public function product_add() {

        if (request()->isPost()) {
            $post = request()->post();

            $code = $this->product_code($post);
            $post['code'] = $code;
            $post['image'] = '/';
            if (!validate('product')->check($post))
                $this->error(validate('product')->getError());

            $post['u_id'] = UID;
            $post['update_uid'] = UID;
            $post['create_time'] = time();
            $post['update_time'] = time();


            if (db('product')->strict(true)->insertGetId($post) !== FALSE) {
                model('operate')->success('新增产品');
                $this->success('', 'product');
            } else {
                model('operate')->failure('新增产品');
                $this->error('新增失败');
            }
        } else {
            builder('form')
                    ->addItem('c_id', 'select', '产品分类<font color="red">*</font>', model('product_category')->lists_select_tree())
//                    ->addItem('image', 'image', '产品图片', '', 'data-src="holder.js/140x140?text=选择图片" ')
                    ->addItem('name', 'input', '产品名称<font color="red">*</font>')
//                    ->addItem('code', 'input', '产品货号<font color="red">*</font>')
                    ->addItem('format', 'input', '产品规格')
                    // ->addItem('bar_code', 'input', '条形码')
                    ->addItem('lowest', 'input', '最低库存报警')
                    ->addItem('unit', 'select', '产品单位', db('product_unit')->column('name', 'id'))
                    ->addItem('sales', 'input', '销售价<font color="red">*</font>')
                    ->addItem('purchase', 'input', '进货价<font color="red">*</font>')
                    // ->addItem('type', 'radio', '产品类型', db('product_type')->column('title', 'id'))
                    ->addItem('remark', 'textarea', '产品备注')
                    ->addItem('format', 'input', '产品规格')
                    ->build();
            return view();
        }
    }

    /**
     * @title 产品修改
     */
    public function product_edit($id) {

        empty($id) && $this->error('参数不能为空');

        if (request()->isPost()) {
            $post = request()->post();
            $pro=db('product')->where('id', $post['id'])->find();
            if($pro['c_id'] != $post['c_id']){
               $code = $this->product_code($post); 
            }else{
                $code=$pro['code'];
            }
            $post['code'] = $code;
            if (!validate('product')->check($post))
                $this->error(validate('product')->getError());

            $post['update_uid'] = UID;
            $post['update_time'] = time();
            if (db('product')->strict(true)->where('id', $post['id'])->update($post) !== FALSE) {
                model('operate')->success('更新产品');
                //$this->success('', 'back');
                return ['code' => 1, 'msg' => '', 'data' => 1, 'url' => 'back'];
            } else {
                model('operate')->failure('更新产品');
                $this->error('更新失败');
            }
        } else {



            $one = db('product')->where('id', $id)->find();

            builder('form')
                    ->addItem('c_id', 'select', '产品分类<font color="red">*</font>', model('product_category')->lists_select_tree())
//                    ->addItem('image', 'image', '产品图片', '', 'data-src="holder.js/140x140?text=选择图片" ')
                    ->addItem('name', 'input', '产品名称<font color="red">*</font>')
//                    ->addItem('code', 'input', '产品货号<font color="red">*</font>')
                    ->addItem('format', 'input', '产品规格')
                    // ->addItem('bar_code', 'input', '条形码')
                    ->addItem('lowest', 'input', '最低库存报警')
                    ->addItem('unit', 'select', '产品单位', db('product_unit')->column('name', 'id'))
                    ->addItem('sales', 'input', '销售价<font color="red">*</font>')
                    ->addItem('purchase', 'input', '进货价<font color="red">*</font>')
                    // ->addItem('type', 'radio', '产品类型', db('product_type')->column('title', 'id'))
                    ->addItem('remark', 'textarea', '产品备注')
                    ->addItem('format', 'input', '产品规格')
                    ->build($one);
            return view();
        }
    }

    /**
     * @title 产品删除
     */
    public function product_del($id) {

        empty($id) && $this->error('ID不能为空');


        $check = model('product_inventory')->where('p_id', $id)->count();
        if ($check > 0) {
            $this->error('已产生库存，暂无法删除');
        } elseif (db('product')->where('id', $id)->delete()) {
            $this->success('删除成功');
        }
    }

    /**
     * @title 快递管理
     */
    public function express() {
        $this->assign('lists', db('express')->order('sort desc')->select());
        builder('list')
                ->addItem('id', '#')
                ->addItem('name', '名称')
                ->addAction('编辑', 'express_edit', '', 'btn btn-success btn-xs', 'data-toggle="modal" data-target="#modal"')
                ->addAction('删除', 'express_delete', '', 'btn btn-danger btn-xs ajax-get confirm')
                ->build();
        return view();
    }

    /**
     * @title 快递添加
     */
    public function express_add() {
        if (request()->isPost()) {
            $post = request()->post();

            if (!validate('express')->check($post)) {
                $this->error(validate('express')->getError());
            }

            if (db('express')->insert(['name' => $post['name']])) {
                $this->success('', 'express');
            } else {
                $this->error('添加失败');
            }
        } else {
            return view();
        }
    }

    /**
     * @title 快递编辑
     */
    public function express_edit($id) {

        empty($id) && $this->error('ID不能为空');


        if (request()->isPost()) {
            $post = request()->post();

            if (!validate('express')->check($post)) {
                $this->error(validate('express')->getError());
            }

            if (db('express')->where('id', $post['id'])->setField('name', $post['name']) !== FALSE) {
                $this->success('', 'express');
            } else {
                $this->error('更新失败');
            }
        } else {

            $this->assign('var', $var = db('express')->where('id', $id)->find());
            return view();
        }
    }

    /**
     * @title 快递删除
     */
    public function express_delete($id) {

        empty($id) && $this->error('ID不能为空');

        if (db('express')->where('id', $id)->delete()) {
            $this->success('', 'express');
        } else {
            $this->error('删除失败');
        }
    }

    /**
     * @title 单位管理
     */
    public function unit() {
        $this->assign('lists', db('product_unit')->order('sort desc')->select());
        builder('list')
                ->addItem('id', '#')
                ->addItem('name', '名称')
                ->addAction('编辑', 'unit_edit', '', 'btn btn-success btn-xs', 'data-toggle="modal" data-target="#modal"')
                ->addAction('删除', 'unit_delete', '', 'btn btn-danger btn-xs ajax-get confirm')
                ->build();
        return view();
    }

    /**
     * @title 单位添加
     */
    public function unit_add() {

        if (request()->isPost()) {
            $post = request()->post();

            if (!validate('product_unit')->check($post))
                $this->error(validate('product_unit')->getError());

            if (db('product_unit')->insert(['name' => $post['name']])) {
                $this->success('', 'unit');
            } else {
                $this->error('添加失败');
            }
        } else {
            return view();
        }
    }

    /**
     * @title 单位编辑
     */
    public function unit_edit($id) {

        empty($id) && $this->error('ID不能为空');

        if (request()->isPost()) {
            $post = request()->post();

            if (!validate('product_unit')->check($post))
                $this->error(validate('product_unit')->getError());

            if (db('product_unit')->where('id', $post['id'])->setField('name', $post['name']) !== FALSE) {
                $this->success('', 'unit');
            } else {
                $this->error('更新失败');
            }
        } else {

            $this->assign('var', db('product_unit')->where('id', $id)->find());
            return view();
        }
    }

    /**
     * @title 单位删除
     */
    public function unit_delete($id) {

        empty($id) && $this->error('ID不能为空');

        if (db('product_unit')->where('id', $id)->delete()) {
            $this->success('', 'unit');
        } else {
            $this->error('删除失败');
        }
    }

    /**
     * @title 产品分类
     */
    public function product_category() {
        $this->assign('lists', model('product_category')->lists_tree());
        builder('list')
                ->addItem('id', '#')
                ->addItem('name', '名称')
                ->addItem('code', '编号')
                ->addSortItem('sort', '排序', 'product_category')
                ->addAction('编辑', 'product_category_edit', '', 'btn btn-success btn-xs', 'data-toggle="modal" data-target="#modal"')
                ->addAction('删除', 'product_category_delete', '', 'btn btn-danger btn-xs ajax-get confirm')
                ->build();
        return view();
    }

    /**
     * @title 产品分类新增
     */
    public function product_category_add() {

        if (request()->isPost()) {
            $post = request()->post();

            if (!validate('product_category')->check($post))
                $this->error(validate('product_category')->getError());

            if (db('product_category')->insert(['name' => input('post.name'), 'code' => input('post.code'), 'pid' => input('post.pid')])) {
                $this->success('', 'product_category');
            } else {
                $this->error('添加失败');
            }
        } else {
            builder('form')
                    ->addItem('pid', 'select', '产品分类', model('product_category')->lists_select_tree(), '')
                    ->addItem('name', 'input', '分类名称<font color="red">*</font>')
                    ->addItem('code', 'input', '分类编码<font color="red">*</font>')
                    ->build();
            return view();
        }
    }

    /**
     * @title 产品分类删除
     */
    public function product_category_delete($id) {

        empty($id) && $this->error('ID不能为空');

        if (db('product')->where('c_id', $id)->find()) {
            model('operate')->failure('删除产品分类');
            $this->error('请先转移分类下的产品');
        } elseif (db('product_category')->where('pid', $id)->find()) {
            model('operate')->failure('删除产品分类');
            $this->error('请先删除子分类');
        } elseif (db('product_category')->where('id', $id)->delete()) {
            model('operate')->success('删除产品分类');
            $this->success('');
        } else {
            model('operate')->failure('删除产品分类');
            $this->error('删除失败');
        }
    }

    /**
     * @title 产品分类修改
     */
    public function product_category_edit($id) {

        empty($id) && $this->error('ID不能为空');

        if (request()->isPost()) {
            $post = request()->post();
            
            if (!validate('product_category')->check($post))
                $this->error(validate('product_category')->getError());
            if(input('post.code') !== db('product_category')->where('id', $post['id'])->value('code') && db('product')->where('c_id', $post['id'])->find()){
                $this->error('请先转移分类下的产品，再修改分类编码');
            }
            if (db('product_category')->where('id', $post['id'])->update(['name' => input('post.name'), 'code' => input('post.code'), 'pid' => input('post.pid')]) !== FALSE) {
                $this->success('', 'product_category');
            } else {
                $this->error('修改失败');
            }
        } else {

            $one = db('product_category')->where('id', $id)->find();

            builder('form')
                ->addItem('pid', 'select', '产品分类', model('product_category')->lists_select_tree(['id' => ['neq', $id]]), '')
                ->addItem('name', 'input', '分类名称<font color="red">*</font>')
                ->addItem('code', 'input', '分类编码<font color="red">*</font>')
                ->build($one);
            return view();
        }
    }

    /**
     * @title 仓库管理
     */
    public function warehouse() {

        $lists = model('product_warehouse')->model_where(true)->select();
        $this->assign('lists', $lists);

        builder('list')
                ->addItem('id', '#')
                ->addItem('name', '名称')
                ->addItem('address', '地址')
                ->addItem('nickname', '负责人')
                ->addItem('number', '库存')
                // ->addItem('default', '默认')
                ->addAction('编辑', 'warehouse_edit', '', 'btn btn-success btn-xs', 'data-toggle="modal" data-target="#modal"')
                ->addAction('删除', 'warehouse_delete', '', 'btn btn-danger btn-xs ajax-get confirm')
                ->build();
        return view();
    }

    /**
     * @title 仓库新增
     */
    public function warehouse_add() {

        if (request()->isPost()) {
            $post = request()->post();

            $data['default'] = input('post.default/a', [0]);
            $data['default'] = implode('', $data['default']);

            if (!validate('product_warehouse')->check($post))
                $this->error(validate('product_warehouse')->getError());

            $message = model('product_warehouse')->warehouse_add($post);
            if ($message) {
                model('operate')->failure('新增仓库');
                $this->error($message);
            } else {
                model('operate')->success('新增仓库');
                $this->success('', 'warehouse');
            }
        } else {
            builder('form')
                    ->addItem('name', 'input', '仓库名称<font color="red">*</font>', '', '')
                    ->addItem('address', 'input', '仓库地址')
                    ->addItem('remark', 'input', '备注')
                    // ->addItem('default', 'checkbox', '默认仓库', [1 => '默认'])
                    ->addItem('uids', 'checkbox', '管理员', db('system_user')->where('status', '1')->column('nickname', 'id'))
                    ->build();
            return view();
        }
    }

    /**
     * @title 仓库修改
     */
    public function warehouse_edit($id) {

        empty($id) && $this->error('ID参数不能为空');

        if (request()->isPost()) {
            $post = request()->post();

            $data['default'] = input('post.default/a', [0]);
            $data['default'] = implode('', $data['default']);

            if (!validate('product_warehouse')->check($post))
                $this->error(validate('product_warehouse')->getError());

            $message = model('product_warehouse')->warehouse_edit($post);
            if ($message) {
                model('operate')->failure('修改仓库');
                $this->error($message);
            } else {
                model('operate')->success('修改仓库');
                $this->success('', 'warehouse');
            }
        } else {

            $one = model('product_warehouse')->model_where(true)->where('a.id', $id)->find();
            $this->assign('one', $one);

            builder('form')
                    ->addItem('name', 'input', '仓库名称<font color="red">*</font>', '', '')
                    ->addItem('address', 'input', '仓库地址')
                    ->addItem('remark', 'input', '备注')
                    // ->addItem('default', 'checkbox', '默认仓库', [1 => '默认'])
                    ->addItem('uids', 'checkbox', '管理员', db('system_user')->where('status', '1')->column('nickname', 'id'))
                    ->build($one);

            return view();
        }
    }

    /**
     * @title 仓库删除
     */
    public function warehouse_delete($id) {

        empty($id) && $this->error('ID参数不能为空');

        $message = model('product_warehouse')->warehouse_delete($id);
        if ($message) {
            model('operate')->failure('删除仓库');
            $this->error($message);
        } else {
            model('operate')->success('删除仓库');
            $this->success('');
        }
    }

    /**
     * @title 供应商列表
     */
    public function supplier() {

        $this->assign('lists', model('product_supplier')->model_where()->select());

        builder('list')
                ->addItem('id', '#')
                ->addItem('company', '名称')
                ->addItem('name', '联系人')
                ->addItem('tel', '电话')
                ->addItem('address', '地址')
                ->addItem('update_time', '更新日期')
                ->addItem('nickname_replace', '更新人')
                ->addAction('查看', 'supplier_look', '', 'btn btn-primary btn-xs', 'data-toggle="modal" data-target="#modal"')
                ->addAction('编辑', 'supplier_edit', '', 'btn btn-success btn-xs', 'data-toggle="modal" data-target="#modal"')
                ->addAction('删除', 'supplier_delete', '', 'btn btn-danger btn-xs ajax-get confirm')
                ->build();
        return view();
    }

    /**
     * @title 供应商新增
     */
    public function supplier_add() {

        if (request()->isPost()) {
            $post = request()->post();

            if (!validate('product_supplier')->check($post))
                $this->error(validate('product_supplier')->getError());

            $post['u_id'] = UID;
            $post['replace_uid'] = UID;
            $post['create_time'] = time();
            $post['update_time'] = time();

            if (db('product_supplier')->insertGetId($post)) {
                model('operate')->success('新增供应商');
                $this->success('', 'supplier');
            } else {
                model('operate')->failure('新增供应商');
                $this->error('数据库更新出错');
            }
        } else {
            builder('form')
                    ->addItem('company', 'input', '名称<font color="red">*</font>', '', '')
                    ->addItem('name', 'input', '联系人')
                    ->addItem('tel', 'input', '电话')
                    ->addItem('fax', 'input', '传真')
                    ->addItem('mobile', 'input', '手机')
                    ->addItem('site', 'input', '网址')
                    ->addItem('email', 'input', 'Email')
                    ->addItem('address', 'input', '地址')
                    ->addItem('remark', 'input', '备注')
                    ->build();
            return view();
        }
    }

    /**
     * @title 供应商修改
     */
    public function supplier_edit($id) {

        empty($id) && $this->error('ID参数不能为空');

        if (request()->isPost()) {
            $post = request()->post();

            if (!validate('product_supplier')->check($post))
                $this->error(validate('product_supplier')->getError());

            $post['replace_uid'] = UID;
            $post['update_time'] = time();

            if (db('product_supplier')->where('id', $id)->update($post) !== FALSE) {
                model('operate')->success('修改供应商');
                $this->success('', 'supplier');
            } else {
                model('operate')->failure('修改供应商');
                $this->error('数据库更新出错');
            }
        } else {

            $one = model('product_supplier')->model_where()->find($id);
            builder('form')
                    ->addItem('company', 'input', '名称<font color="red">*</font>', '', '')
                    ->addItem('name', 'input', '联系人')
                    ->addItem('tel', 'input', '电话')
                    ->addItem('fax', 'input', '传真')
                    ->addItem('mobile', 'input', '手机')
                    ->addItem('site', 'input', '网址')
                    ->addItem('email', 'input', 'Email')
                    ->addItem('address', 'input', '地址')
                    ->addItem('remark', 'input', '备注')
                    ->build($one);
            return view();
        }
    }

    /**
     * @title 供应商查看
     */
    public function supplier_look($id) {
        empty($id) && $this->error('ID参数不能为空');
        $this->assign('var', model('product_supplier')->model_where()->where('a.id', $id)->find());
        return view();
    }

    /**
     * @title 供应商删除
     */
    public function supplier_delete($id) {

        empty($id) && $this->error('ID参数不能为空');

        if (db('product_supplier')->where('id', $id)->delete()) {
            model('operate')->success('删除供应商名称');
            $this->success('');
        } else {
            model('operate')->failure('删除供应商名称');
            $this->error('删除失败');
        }
    }

}
