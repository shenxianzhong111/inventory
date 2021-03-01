<?php

/**
 * 账务管理
 */

namespace app\common\model;

use think\Model;
use app\common\model\Base;
use think\Db;

class FinanceAccounts extends Base {

    public function query_delete($id) {


        Db::startTrans();
        try {


            // 是支出还是收入
            $one = db('finance_accounts')->where('id', $id)->find();

            //支出，把银行查出来，然后把钱还回银行+，然后把记录删除
            if ($one['type'] == 0) {
                db('finance_bank')->where('id', $one['bank_id'])->setInc('money', $one['money']);
            }
            //收入，把收入到银行的钱 给减去-，然后把记录删除
            if ($one['type'] == 1) {
                db('finance_bank')->where('id', $one['bank_id'])->setDec('money', $one['money']);
            }

            db('finance_accounts')->where('id', $id)->delete();


            // 提交事务
            Db::commit();
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
            return $e->getMessage();
        }
    }

    public function model_where() {
        // 初始化查询条件
        $this->where('a.u_id', UID);

        if (request()->get('timea'))
            $this->where('a.datetime', '>=', strtotime(request()->get('timea') . ' 00:00:00'));
        if (request()->get('timeb'))
            $this->where('a.datetime', '<=', strtotime(request()->get('timeb') . ' 23:59:59'));

        // 银行
        if (request()->get('b_id')) {
            $this->where('b.id', request()->get('b_id'));
        }




        // 收入or支出  
        if (NULL !== request()->get('type') && "" !== request()->get('type')) {
            $this->where('a.type', request()->get('type'));
        }


        // 分类
        if (request()->get('c_id')) {
            $this->where('a.c_id', request()->get('c_id'));
        }

        // 备注
        if (request()->get('remark')) {
            $this->where('a.remark', 'like', '%' . request()->get('remark') . '%');
        }

        $this->join('system_user m', 'a.u_id=m.id', 'LEFT');
        $this->join('system_user t', 'a.attn_id=t.id', 'LEFT');
        $this->join('finance_bank b', 'a.bank_id=b.id', 'LEFT');
        $this->join('finance_category c', 'a.c_id=c.id', 'LEFT');

        $this->field('a.*,'
                . 'b.name as bank,'
                . 'c.name as c_name,'
                . 'm.nickname,'
                . 't.nickname as nickname_attn');

        $this->order('a.id desc');
        $this->alias('a');
        return $this;
    }
    
    
    
    public function chart($day) {

        $lists = $this->select();
        
        
        
        $d = array();
        for ($index = 0; $index < $day; $index++) {
            
            $date = date('Y-m-d', strtotime($_GET['timea']) + ($index * 86400));
            
            $datea = strtotime($date . ' 00:00:00');
            $dateb = strtotime($date . ' 23:59:59');
            
            $d['expenditure'][$index + 1] = $this->get_charttime($lists, 0, $datea, $dateb);
            $d['revenue'][$index + 1] = $this->get_charttime($lists, 1, $datea, $dateb);
            $d['date'][$index + 1] = "'{$date}'";
        }
        
        

        return $d;
    }
    
    private function get_charttime($list, $type, $datea, $dateb) {
        
  
        
        $vars = 0;
        
        foreach ($list as $var) {
            
            $var = $var->toArray();
            
            if ($var['type'] == $type && $var['datetime'] >= $datea && $var['datetime'] <= $dateb)
                $vars+= $var['money'];
        }
        return $vars;
    }

}
