<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\controller\Admin;
use utils\Date\Date;

/**
 * @title 统计报表
 */
class Statistics extends Admin {
    
    
    
    /**
     * @title 入库报表
     */
    public function storage() {
        //
        if (empty($_GET['timea']))
            $_GET['timea'] = date('Y-m-d', time() - 86400 * 30);
        if (empty($_GET['timeb']))
            $_GET['timeb'] = date('Y-m-d');


        $list = model('product_storage_order')->model_where()->chart((Date::date_diff('d', $_GET['timea'], $_GET['timeb']) + 1));
        $this->assign('list', $list);

        return view();
    }

    /**
     * @title 出库报表
     */
    public function sales() {
        //
        if (empty($_GET['timea']))
            $_GET['timea'] = date('Y-m-d', time() - 86400 * 30);
        if (empty($_GET['timeb']))
            $_GET['timeb'] = date('Y-m-d');



        $list = model('product_sales_order')->model_where()->chart((Date::date_diff('d', $_GET['timea'], $_GET['timeb']) + 1));

        $this->assign('list', $list);

        return view();
    }

    /**
     * @title 财务统计
     */
    public function finance() {

        
        if (empty($_GET['timea']))
            $_GET['timea'] = date('Y-m-d', time() - 86400 * 30);
        if (empty($_GET['timeb']))
            $_GET['timeb'] = date('Y-m-d');

        
        
        if (empty(request()->get('chart'))) {
            
            $lists = model('finance_accounts')->model_where()->chart((Date::date_diff('d', $_GET['timea'], $_GET['timeb']) + 1));
            
            $this->assign('lists', $lists);
        }
        
 
        
     
         $this->assign('expenditure', model('finance_accounts')->model_where()->where('a.type', 0)->sum('a.money'));
        $this->assign('revenue', model('finance_accounts')->model_where()->where('a.type', 1)->sum('a.money'));

        $this->assign('chart', request()->get('chart'));

       
        return view();
    }

}
