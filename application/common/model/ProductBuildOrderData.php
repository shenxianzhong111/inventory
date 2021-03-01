<?php

namespace app\common\model;

use app\common\model\Base;

class ProductBuildOrderData extends Base {
    
    public function model_where(){
        
        $this->join('product p', 'p.id=a.p_id_bc');
        $this->join('product_build_order pbo', 'pbo.id=a.o_id');
        $this->join('product p2', 'p2.id=pbo.p_id');
        $this->join('product_warehouse pw', 'pw.id=a.w_id');
        $this->join('system_user su', 'su.id=pbo.u_id');
        
        $this->field('a.*,'
                . 'p.name as product_title,'
                . 'p2.name as product_title2,pbo.quantity as quantity2,'
                . 'pbo.build_time as build_time,'
                . 'su.nickname,'
                . 'pw.name as warehouse_title');
        
        $this->order('a.id desc');
        
        $this->alias('a');        
        return $this;
    }
    
}