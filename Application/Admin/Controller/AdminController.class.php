<?php
/**
 * Created by PhpStorm.
 * User: lijianwu
 * Date: 2017/9/5
 * Time: 下午4:11
 */
namespace Common\Controller;

use Think\Controller;

class AdminController extends Controller
{
    public function index()
    {
       $res = D('Admin')->getAdmins();
       $this->assign('admins',$res);
       $this->display();
    }
    public function delete()
    {
        if($_POST)
        {
            $admin_id = $_POST['id'];
            $status = $_POST['status'];
            $res = D('Admin')->setStatusById(intval($admin_id),intval($status));
            if($res)
            {
                return show(1,'删除成功');
            }
            return show(0,'删除失败');
        }
    }

    public function add()
    {
        if ($_POST)
        {
            if(!$_POST['username'] || !isset($_POST['username']))
            {
                show(0,'用户不能为空');
        }
        }

    }

}