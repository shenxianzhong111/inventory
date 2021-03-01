<?php

namespace app\common\model;

use app\common\model\Base;
use function request;
use think\Db;

class Product extends Base {

    public function getTypeAttr($value) {
        return db('product_type')->where('id', $value)->value('title');
    }

    public function json1($type = 0) {

        if (request()->get('keyword')) {
            $this->where('py.py|code|name', 'like', '%' . request()->get('keyword') . '%');
        }

        if (!empty($type))
            $this->where('type', '=', $type);

        $this->join('pinyin py', 'CONV(HEX(LEFT(CONVERT(name USING GBK),1)),16,10) BETWEEN py.begin AND py.end', 'LEFT');

//        $lists = $this->field('id,name as label,image,type')->order('type asc,code asc')->limit(10)->select();
        $lists = $this->field('id,name as label,type')->order('type asc,code asc')->limit(10)->select();//去除图片
        foreach ($lists as $key => $value) {
//            if ($value['image'])
//                $lists[$key]['image'] = APP_HOST . img_resize($value['image'], 50, 50);
//            else
                // $lists[$key]['image'] = APP_HOST . img_resize('/static/admin/images/noimage.jpg');        
            
            $lists[$key]['label'] = $lists[$key]['label'];//去除产品类型
            // $lists[$key]['label'] = $lists[$key]['label'].'【'.$lists[$key]['type'].'】';
        }
        return json_encode($lists);
    }
    
    public function json(){
        $list=$this->alias('p')->join('tb_product_category pc','pc.id=p.c_id','left')
            ->join('pinyin py', 'CONV(HEX(LEFT(CONVERT(p.name USING GBK),1)),16,10) BETWEEN py.begin AND py.end', 'LEFT')
            ->where('p.code|p.name|py.py', 'like', '%' . request()->get('keyword') . '%')
            ->field('p.id,p.name as label,pc.name category')
            ->order('pc.name asc,p.code asc')->limit(10)
            ->select();
        foreach ($list as $key => $value) {
        //            if ($value['image'])
        //                $lists[$key]['image'] = APP_HOST . img_resize($value['image'], 50, 50);
        //            else
        //                $lists[$key]['image'] = APP_HOST . img_resize('/static/admin/images/noimage.jpg');
        
            $list[$key]['label'] = $list[$key]['label'].'【'.$list[$key]['category'].'】';
        }
        return json_encode($list);
    }

    public function model_where() {


        if (request()->get('c_id'))
            $this->where('a.c_id', request()->get('c_id'));
        if (request()->get('type'))
            $this->where('a.type', request()->get('type'));
        if (request()->get('keyword'))
            $this->where('a.code|a.name', 'like', '%' . request()->get('keyword') . '%');


        $this->join('product_inventory i', 'a.id=i.p_id', 'LEFT');
        $this->join('product_warehouse pw', 'pw.id=i.w_id', 'LEFT');
        $this->join('product_unit pu', 'pu.id=a.unit', 'LEFT');
        $this->join('product_category pc', 'a.c_id=pc.id', 'LEFT');
        $this->join('system_user b', 'a.u_id=b.id', 'LEFT');
        $this->join('system_user c', 'a.update_uid=c.id', 'LEFT');

        $this->field('a.*,'
                . 'pc.name as category,'
                . 'SUM(i.quantity) as quantity,group_concat(pw.name) as warehouse,'
                . 'b.nickname,'
                . 'pu.name as unit,'
                . 'c.nickname as replace_nickname');

        $this->order('a.id desc');
        $this->alias('a');

        return $this;
    }

}
