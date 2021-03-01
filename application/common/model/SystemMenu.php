<?php

namespace app\common\model;

use app\common\model\Base;
use utils\Auth\Auth;
use think\Db;

class SystemMenu extends Base {

    // 规则数量
    public function getRuleCountAttr($value, $data) {
        $rules = explode(',', $data['rules']);
        $rules = array_filter($rules);
        return $rules ? count($rules) : '';
    }

    /**
     * @title 返回主菜单
     * 非超级管理员适用此方法
     * 用于BUI框架的列表展示
     */
    public function getMenuList($uid) {

        // 查找用户所属的组
        $menu_ids_string = db('auth_group')
                ->where('id', 'IN', function($query) use($uid) {
                    $query->name('auth_group_access')->where('uid', $uid)->field('group_id');
                })
                ->value('menus');

        // 找出所有相应的菜单
        if (IS_SUPER_ADMIN) {
            $menu_lists = db('system_menu')->where('status', '>', 0)->order('sort asc')->select();
        } else {
            $menu_lists = db('system_menu')->where('id', 'in', $menu_ids_string)->where('status', '>', 0)->order('sort asc')->select();
        }

        $menu_result = NULL;
        foreach ($menu_lists as $key => $val) {
            $menu_result[] = $val;
        }
        $gen_tree_result = gen_tree($menu_result, 'id', 'pid', 'son');
        $m = [];
        $e = [];
        foreach ($gen_tree_result as $key => $val) {
            $id_arr = explode('/', $val['url']);
            $val['url'] = $id_arr[1] ?? $val['url'];
            $menu[$key]['id'] = $val['url'] ? $val['url'] : md5($val['id']);
            $menu[$key]['homePage'] = substr(strrchr($val['url'], '/'), 1);
            if (isset($val['son'])) {
                foreach ($val['son'] as $key2 => $val2) {
                    $menu[$key]['menu'][$key2]['text'] = $val2['name'];
                    if (isset($val2['son'])) {
                        foreach ($val2['son'] as $key3 => $val3) {
                            
                            // 默认打开第一个分组的第一个子菜单
                            if($key3 == 0 && $key2 == 0){
                                $menu[$key]['homePage'] = substr(strrchr($val3['url'], '/'), 1);
                            }
                            
                            $menu[$key]['menu'][$key2]['items'][$key3] = [
                                'id' => substr(strrchr($val3['url'], '/'), 1),
                                'text' => $val3['name'],
                                'href' => url($val3['url']),
                                'closeable' => true,
                            ];
                        }//end foreach
                        if (empty($menu[$key]['menu'][$key2]['items'])){
                            unset($menu[$key]['menu'][$key2]);
                        }
                    }
                }//end foreach
                if (empty($menu[$key]['menu'][$key2]))
                    unset($menu[$key]['menu'][$key2]);
                if (empty($menu[$key]['menu']))
                    unset($menu[$key]);
                else
                    $m[] = $val['id'];
            }else {
                //如果没有子类，把父类本身就删除
                unset($menu[$key]);
            }
        }
        foreach ($menu as $val2) {
            $e[] = $val2;
        }
        return array($m, $e);
    }

}
