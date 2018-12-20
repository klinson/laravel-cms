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
    foreach ($array as $key => $item) {
        unset($array[$key][$child]);
    }
    return $array;
}

/**
 * 后台自动上传的文件获取url
 * @param $path
 * @param string $server
 * @return mixed
 */
function get_admin_file_url($path, $server = '', $default = '')
{
    if (is_null($path) || $path === '') {
        return $default;
    }
    if (url()->isValidUrl($path)) {
        $src = $path;
    } elseif ($server) {
        $src = $server.$path;
    } else {
        $src = \Illuminate\Support\Facades\Storage::disk(config('admin.upload.disk'))->url($path);
    }
    return $src;
}

/**
 * 自动判断数组还是单个，获取url
 * @param $paths
 * @param string $server
 * @author klinson <klinson@163.com>
 * @return array|mixed
 */
function get_admin_file_urls($paths, $server = '')
{
    if (is_array($paths)) {
        $return = [];
        foreach ($paths as $path) {
            $return[] = get_admin_file_url($path, $server);
        }
        return $return;
    } else {
        return get_admin_file_url($paths, $server);
    }
}


function show_images($show, $column, $label = '', $server = '', $width = 200, $height = 200)
{
    $show->$column($label)->unescape()->as(function ($paths) use ($server, $width, $height) {
        $urls = get_admin_file_urls($paths, $server);
        if (empty($urls)) {
            return '';
        }
        return implode("&nbsp;", array_map(function ($url) use ($width, $height) {
            return "<img src='$url' style='max-width:{$width}px;max-height:{$height}px' class='img img-thumbnail' />";
        }, $urls));
    });
}

/**
 * 下载微信临时资源
 * @param $media_id
 * @author klinson <klinson@163.com>
 * @return null
 */
function download_wechat_temp_media($media_id)
{
    $app = app('wechat.official_account');
    $stream = $app->media->get($media_id);

    if ($stream instanceof \EasyWeChat\Kernel\Http\StreamResponse) {
        // 以内容 md5 为文件名存到本地
//      $stream->save('abc');
        // 自定义文件名，不需要带后缀
//      $stream->saveAs('abc', 'aaa');

        // 获取文件名
        $h = $stream->getHeader('Content-disposition');
        $tmp = explode('=', $h[0]);
        $filename = trim($tmp[1], "\"'");

        if (! \Storage::disk('wechat')->exists($filename)) {
            \Storage::disk('wechat')->put($filename, $stream);
        }

        return \Storage::disk('wechat')->url($filename);
    }

    return null;
}

/**
 * 生成随机字符串
 * @param int $length 生成长度
 * @param int $type 字符串类型 0-7 8种模式
 * @author klinson <klinson@163.com>
 * @return string
 */
function random_string($length = 6, $type = 0): string
{
    $chars = [
        '0123456789',
        'abcdefghijklmnopqrstuvwxyz',
        'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
        '!@#$%^&*()-_ []{}<>~`+=,.;:/?|'
    ];
    $char_seeder = '';
    switch ($type) {
        case 1:
            $char_seeder = $chars[1];
            break;
        case 2:
            $char_seeder = $chars[2];
            break;
        case 3:
            $char_seeder = $chars[3];
            break;
        case 4:
            $char_seeder = $chars[0] . $chars[1];
            break;
        case 5:
            $char_seeder = $chars[1] . $chars[2];
            break;
        case 6:
            $char_seeder = $chars[0] . $chars[1] . $chars[2];
            break;
        case 7:
            $char_seeder = $chars[0] . $chars[1] . $chars[2] . $chars[3];
            break;
        case 0:
        default:
            $char_seeder = $chars[0];
            break;
    }
    $random_string = '';
    for ( $i = 0; $i < $length; $i++ )
    {
        // 这里提供两种字符获取方式
        // 第一种是使用 substr 截取$chars中的任意一位字符；
        // 第二种是取字符数组 $chars 的任意元素
        // $random_string .= substr($char_seeder, mt_rand(0, strlen($char_seeder) - 1), 1);
        $random_string .= $char_seeder[ mt_rand(0, strlen($char_seeder) - 1) ];
    }

    return $random_string;
}