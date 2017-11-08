<?php
/**
 * Created by PhpStorm.
 * User: lijianwu
 * Date: 2017/9/5
 * Time: 下午3:34
 */
namespace Common\Model;

use function Sodium\add;
use Think\Model;

class MenuModel extends Model
{
    private $_db = '';
    public function __construct()
    {
        parent::__construct();
        $this->_db = M('menu');
    }
    public function getAdminMenu()
    {
        $data = array(
            'status'=>array('neq',-1),
            'type'=>1,
        );
        $res = $this->_db->where($data)->order('listorder desc,menu_id desc')->select();
//        dump($res);exit();
        return $res;
    }

//    根据前,后菜单分类
    public function getMenuCount($condition = array())
    {

        if(!is_array($condition))
        {
            return 0;
        }
        if(in_array(intval($condition['type'],array(0,1))) && $condition != null)
        {
            $dataCon['type'] = intval($condition['type']);
        }
        $dataCon['status'] = array('neq',-1);
        return $this->_db->where($dataCon)->order('listorder desc,menu_id desc')->select();

    }

//    添加

    public function insert($data)
    {
//        判断是否为空和是否是数组
       if(!$data || !is_array($data))
       {
           return 0;
       }
       return $this->_db->add($data);
    }

//    删除
    public function update($data)
    {
       if(!$data || !is_array($data))
       {
           return 0;
       }
       $dataCon=array('status'=>-1);
       $res = $this->_db->where('menu_id='.$data['id'])->save($dataCon);
       return $res;
    }
//更新修改后的数据

    public function getMenuById($menu_id)
    {
        if(!is_numeric($menu_id))
        {
            return 0;
        }
        return  $this->_db->where('menu_id='.$menu_id)->find();

    }

    public function updateMenuById($menu_id,$data=array())
    {
        if(!is_numeric($menu_id) || !is_array($data))
        {
            return 0;
        }
        return $this->_db->where('menu_id='.$menu_id)->save($data);
    }


}