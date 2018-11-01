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

function list_to_tree($array, $root = 0, $id = 'id', $pid = 'pid', $child = 'child')
{
    $tree = [];
    foreach ($array as $k => $v) {
        if ($v[$pid] == $root) {
            $v[$child] = list_to_tree($array, $v[$id], $id, $pid, $child);
            $tree[] = $v;
            unset($array[$k]);
        }
    }
    return $tree;
}

function tree_to_list($tree, $id = 'id', $child = 'child')
{
    $array = array();
    foreach ($tree as $k => $val) {
        $array[] = $val;
        if (isset($val[$child])) {
            $children = tree_to_list($val[$child], $id, $child);
            if ($children) {
                $array = array_merge($array, $children);
            }
        }
    }
    foreach ($array as $item) {
        unset($item[$child]);
    }
    return $array;
}