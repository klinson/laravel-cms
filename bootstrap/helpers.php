<?php
/*
|--------------------------------------------------------------------------
| 自定义助手辅助函数
|--------------------------------------------------------------------------
*/

/**
 * 获取当前请求的控制器名和方法名
 * @author klinson <klinson@163.com>
 * @return array
 */
function getCurrentClassNameAndMethodName()
{
    $classMethod = request()->route()->getActionName();
    $tmp = explode('\\', $classMethod);
    $classMethod = array_pop($tmp);
    $tmp = explode('@', $classMethod);
    $tmp[0] = substr($tmp[0], 0, strlen($tmp[0])-10);

    return $tmp;
}