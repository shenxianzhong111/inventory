<?php

namespace app\common\model;

use app\common\model\Base;
use Exception;
use think\Db;

class ProductSalesOrder extends Base {

    public function getShipTimeAttr($value) {
        return date('Y-m-d H:i', $value);
    }

    public function getStatusTextAttr($value, $data) {
        $status = [-1 => '<span class="label label-warning">有退货</span>', 1 => '<span class="label label-success">已完成</span>', -2 => '<span class="label label-important">已退货</span>'];
        return $status[$data['status']];
    }

    public function getTypeAttr($value) {
        return config_value('_dict_sales', $value);
    }

    public function sales_submit($post, $products) {
        // 启动事务
        Db::startTrans();
        try {
            $member_id = $post['member_id'];
            $order['u_id'] = UID;
            $order['m_id'] = $member_id;
            $order['create_time'] = time();
            $order['remark'] = $post['remark'];
            $order['express_id'] = $post['express_id']; //快递
            $order['express_num'] = $post['express_num']; //单号
            $order['express_addr'] = $post['express_addr']; //地址
            $order['type'] = $post['sales_type']; //出库类型
            $order['ship_time'] = strtotime($post['ship_time']); //出货日期
            $order['amount'] = $post['amount'];
            $order['cost'] = $post['cost'];
            $order['order_number'] = date('YmdtHis') . rand(100, 999) . UID;
            $insert_id = db('product_sales_order')->insertGetId($order);
            if ($insert_id) {

                $points_total = 0;

                foreach ($products as $key => $value) {
                    $order_data['o_id'] = $insert_id;
                    $order_data['group_price'] = $value['group_price']; //最终卖出的价格                
                    $order_data['quantity'] = $value['product_quantity']; //最终卖出的数量
                    $order_data['amount'] = sprintf("%.2f", ($value['group_price'] * $value['product_quantity']));
                    $order_data['cost'] = sprintf("%.2f", ($value['purchase'] * $value['product_quantity']));
                    $order_data['p_id'] = $value['id'];
                    $order_data['w_id'] = $value['product_warehouse'];

                    // 产品快照
                    $product_data = db('product')
                            ->alias('p')
                            ->join('product_category pc', 'pc.id=p.c_id', 'LEFT')
                            ->where('p.id', $value['id'])
                            ->field('p.*,pc.name as category')
                            ->find();
                    $product_data['product_type'] = db('product_type')->where('id', $product_data['type'])->value('title');
                    $order_data['product_data'] = serialize($product_data);
                    db('product_sales_order_data')->insert($order_data);

                    $flag = model('product_inventory')->reduce($value['id'], $value['product_warehouse'], $value['product_quantity']);
                    if (!$flag)
                        throw new Exception('库存减少的时时候出现问题');

                    $points_total += $value['group_price'] * $value['product_quantity'];
                }

                // 会员积分
                $points_total = floor($points_total);
                db('member_points')->insert([
                    'u_id' => UID,
                    'm_id' => $member_id,
                    'type' => 1,
                    'create_time' => time(),
                    'value' => $points_total,
                    'title' => '出库积分'
                ]);
                
                db('member')->where('id', $member_id)->setInc('points', $points_total);
                
            } else {
                throw new Exception('订单生成失败');
            }
            // 提交事务
            Db::commit();
        } catch (Exception $e) {
            // 回滚事务
            Db::rollback();
            return $e->getMessage();
        }
    }

    public function sales_undo($id) {
        // 启动事务
        Db::startTrans();
        try {
            $orders = db('product_sales_order')->where('id', '=', $id)->find();
            // print_r($orders['member']);exit;
            $order_data = db('product_sales_order_data')->where('o_id', $id)->select();
            foreach ($order_data as $key => $value) {
                //把库存加上去，但要减去退货的数量 
                model('product_inventory')->increase($value['p_id'], $value['w_id'], ($value['quantity'] - $value['returns']));
            }
            //删除order_data的所有数据
            db('product_sales_order_data')->where('o_id', '=', $id)->delete();
            //删除order下面的数据，单条
            db('product_sales_order')->where('id', '=', $id)->delete();
            // 提交事务
            Db::commit();
        } catch (Exception $e) {
            // 回滚事务
            Db::rollback();
            return $e->getMessage();
        }
    }

    /**
     * @title 数量
     * @param type $listss
     * @param type $datea
     * @param type $dateb
     * @return type
     */
    private function get_count($listss, $datea, $dateb) {
        $vars = 0;
        foreach ($listss as $var) {
            $create_time = strtotime($var['create_time']);
            if ($create_time >= $datea && $create_time <= $dateb)
                $vars += $var['quantity'];
        }
        return $vars;
    }

    /**
     * @title 销售价格
     * @param type $listss
     * @param type $datea
     * @param type $dateb
     * @return type
     */
    private function get_sales($listss, $datea, $dateb) {
        $vars = 0;
        foreach ($listss as $var) {
            $create_time = strtotime($var['create_time']);
            if ($create_time >= $datea && $create_time <= $dateb) {
                $vars += $var['amount'];
            }
        }
        return $vars;
    }

    /**
     * @title 实际收入(因为有退货)
     * @param type $listss
     * @param type $datea
     * @param type $dateb
     * @return type
     */
    private function get_actual($listss, $datea, $dateb) {
        $vars = 0;
        foreach ($listss as $var) {
            $create_time = strtotime($var['create_time']);
            if ($var['status'] > 0 && $create_time >= $datea && $create_time <= $dateb)
                $vars += $var['amount'];
        }
        return $vars;
    }

    /**
     * @title 利润
     * @param type $listss
     * @param type $datea
     * @param type $dateb
     * @return type
     */
    private function get_profit($listss, $datea, $dateb) {
        $vars = 0;
        foreach ($listss as $var) {
            $create_time = strtotime($var['create_time']);
            if ($var['status'] > 0 && $create_time >= $datea && $create_time <= $dateb)
                $vars += $var['amount'] - $var['cost'];
        }
        return $vars;
    }

    public function model_where() {

        $this->where('ws.u_id', UID);

        if (request()->get('timea'))
            $this->where('a.create_time', '>=', strtotime(request()->get('timea') . ' 00:00:00'));
        if (request()->get('timeb'))
            $this->where('a.create_time', '<=', strtotime(request()->get('timeb') . ' 23:59:59'));

        if (request()->get('keyword'))
            $this->where('a.order_number|p.code|p.name', 'like', '%' . request()->get('keyword') . '%');

        if (request()->get('express_num'))
            $this->where('a.express_num', 'like', '%' . request()->get('express_num') . '%');
        if (request()->get('nickname'))
            $this->where('m.nickname', 'like', '%' . request()->get('nickname') . '%');
        if (request()->get('tel'))
            $this->where('m.tel', 'like', '%' . request()->get('tel') . '%');

        if (request()->get('sales_type'))
            $this->where('a.type', request()->get('sales_type'));

        if (request()->get('warehouse'))
            $this->where('d.w_id', request()->get('warehouse'));
        if (request()->get('c_id'))
            $this->where('p.c_id', request()->get('c_id'));
        if (request()->get('type'))
            $this->where('p.type', request()->get('type'));
        if (request()->get('status'))
            $this->where('d.status', request()->get('status'));


        $this->join('member m', 'm.id=a.m_id', 'LEFT');
        $this->join('system_user s', 'a.u_id=s.id', 'LEFT');
        $this->join('product_sales_order_data d', 'd.o_id=a.id', 'LEFT');
        $this->join('product p', 'd.p_id=p.id', 'LEFT');
        $this->join('express ex', 'ex.id = a.express_id', 'LEFT');
        $this->join('product_warehouse_user ws', 'd.w_id=ws.w_id', 'LEFT');

        $this->field('a.*,'
                . 'm.nickname,'
                . 's.nickname as staff_nickname,'
                . 'COUNT(DISTINCT d.id) as count_data,'
                . 'ex.name as express_name');

        $this->order('a.id desc');
        $this->alias('a');
        return $this;
    }

    /**
     * @title 报表
     * @param type $day
     * @return type
     */
    public function chart($day) {

        $lists = $this->field('d.*,a.create_time')->group('d.id')->select();

        //销售 sales 
        //实际 actual
        //利润 profit

        $result = [];
        for ($index = 0; $index < $day; $index++) {

            $date = date('Y-m-d', strtotime($_GET['timea']) + ($index * 86400));
            $datea = strtotime($date . ' 00:00:00');
            $dateb = strtotime($date . ' 23:59:59');

            $result['sales'][$index + 1] = $this->get_sales($lists, $datea, $dateb);
            $result['actual'][$index + 1] = $this->get_actual($lists, $datea, $dateb);
            $result['profit'][$index + 1] = $this->get_profit($lists, $datea, $dateb);
            $result['quantity'][$index + 1] = $this->get_count($lists, $datea, $dateb);

            $date_short = date('d', strtotime($date));

            $result['date'][$index + 1] = "'{$date_short}'";
        }

        return $result;
    }

}
