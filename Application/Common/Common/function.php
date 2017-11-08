<?php
/**
 * Created by PhpStorm.
 * User: lijianwu
 * Date: 2017/9/5
 * Time: 下午2:35
 */

function show($status,$message,$data = array()){
    $result = array(
        'status' => $status,
        'message'=>$message,
        'data'=> $data,
    );
    exit(json_encode($result));
}
function MD5Password($password) {
    return md5($password . C('MD5_PRE'));
}
function getAdminUsername()
{
    return isset($_SESSION['adminUser']['username']) ? $_SESSION['adminUser']['username'] : '';
}

function getAdminUrl($row)
{
    $url = './admin.php?c='.$row['c'].'&a='.$row['f'];
    return $url;
}


function getActive($conName)
{
//    CONTROLLER_NAME;//获取当前控制器的名称.
//    ACTION_NAME;//获取当前方法名.
//    将字符串字母全都转化为小写.
    $c=strtolower(CONTROLLER_NAME);

    if ($c==strtolower($conName))
    {
        return 'class="active"';
    }
    return '';
}
function getMenuType($type)
{
       return $type == 1 ? '后台模块' : ($type==0 ? '前端模块':'');
}
function status($num)
{
    return $num == 1 ? '正常':($num ==0 ? '关闭':'');
}
