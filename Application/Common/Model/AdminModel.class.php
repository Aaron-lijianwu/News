<?php
/**
 * Created by PhpStorm.
 * User: lijianwu
 * Date: 2017/9/5
 * Time: 下午2:47
 */

namespace Common\Model;

use Think\Model;

class AdminModel extends Model{
    private $_db = '';
    public function __construct()
    {
        parent::__construct();
        $this->_db = M('admin');
    }
    public function getAdminUsername($username)
    {
        return $this->_db->where("username='$username'")->find();
    }
    public function getAdminPassword($username,$password)
    {
        return $this->_db->where("username='$username'AND password='$password'");
    }


    public function getAdminMenu()
    {
        $data['status'] = array('neq',-1);
        return $this->_db->where($data)->select();
    }
    public function getAdmins()
    {
        $data['status'] = array('neq',-1);
        return $this->_db->where($data)->select();
    }
    public function setStatusById($id,$status)
    {
        if(!is_numeric($id) || !is_numeric($status))
        {
            return 0;
        }
        $data['status'] = $status;
        return $this->_db->where('admin='.$id)->save($data);
    }
}