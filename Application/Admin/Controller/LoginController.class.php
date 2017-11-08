<?php
/**
 * Created by PhpStorm.
 * User: lijianwu
 * Date: 2017/9/5
 * Time: 下午2:27
 */

namespace Admin\Controller;

use Think\Controller;

class LoginController extends Controller
{
    public function index()
    {
       if(session('adminUser'))
       {
           $this->redirect('/admin.php?c=index');
       }
       $this->display();
    }
    public function check()
    {
        $username = I('username');
        $password = I('password');

//        dump($username);exit();

//        判断用户名和密码是否为空
       if(!trim($username))
       {
           show(0,'用户名不能为空');
       }
       if(!trim($password))
       {
           show(0,'密码不能为空');
       }
       $res = D('Admin')->getAdminUsername($username);

//       dump($res);exit();

       if(!$res)
       {
           show(0,'user is not exit');
       }
       if ($res['password'] == MD5Password($password))
       {
           show(0,'密码错误');
       }
       session('adminUser',$res);
       show(1,'登陆成功');

    }
    public function loginout()
    {
        session('adminUser',null);
        $this->redirect('./admin.php?c=login');
    }
}