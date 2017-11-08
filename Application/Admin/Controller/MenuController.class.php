<?php
/**
 * Created by PhpStorm.
 * User: lijianwu
 * Date: 2017/9/5
 * Time: 下午3:25
 */

namespace Admin\Controller;

use Think\Controller;

class MenuController extends Controller
{
    public function index()
    {
//        echo "<script> alert(1234) </script>";
        $data = array();
        if (isset($_REQUEST['type']) && in_array($_REQUEST['type'], array(0, 1)))
        {
            $data['type'] = intval($_REQUEST['type']);
            $this->assign('type', $_REQUEST['type']);

        } else {
            $this->assign('type', -1);
        }


        $menu = D('Menu')->getMenuCount($data);

//        dump($menu);exit();

        $this->assign('menus',$menu);

        $this->display();

    }

//添加

    public function add()
    {


        if($_POST)
        {

            if (!$_POST['name'] || !isset($_POST['name']))
            {
               return show(0,'菜单名不能为空');
            }
            if (!$_POST['m'] || !isset($_POST['m']))
            {
                return show(0,'模块名不能为空');
            }
            if(!isset($_POST['type']))
            {
                return show(0,'前端栏目不能为空');
            }
            if (!$_POST['c'] || !isset($_POST['c']))
            {
                return show(0,'控制名不能为空');
            }
            if (!$_POST['f'] || !isset($_POST['f']))
            {
                return show(0,'方法名不能为空');
            }
            if (!$_POST['status'] || !isset($_POST['status']))
            {
                return show(0,'状态值不能为空');
            }
            $res = D('Menu')->insert($_POST);


            if($res)
            {
                show(1,'添加成功');
            }
            show(0,'添加失败');
        }

        $this->display();
    }


//    删除
    public function delete()
    {
        if($_POST)
        {
            $res = D('Menu')->update($_POST);

            if($res)
            {
                show(1,'删除成功');
            }
            show(0,'删除失败');
        }
    }


//    更新修改后的数据
   public function edit()
   {
       if($_GET)
       {
           $menu_id = $_GET['id'];
           $res = D('Menu')->getMenuById($menu_id);
//           dump($res);exit();

           $this->assign('menu',$res);
           $this->display();
       }
   }

   public function update()
   {
       if ($_POST)
       {
            $menu_id=$_POST['menu_id'];
            unset($menu_id);
            $res = D('Menu')->updateMenuById($_POST);
            if($res)
            {
                return show(1,'更新成功');
            }
            return show(0,'更新失败');
       }
   }
}