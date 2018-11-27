<?php
/**
 * Created by PhpStorm.
 * User: klinson <klinson@163.com>
 * Date: 18-11-9
 * Time: 上午9:52
 */

namespace App\Http\Controllers;
use Log;

class WechatController extends Controller
{
    /**
     * 处理微信的请求消息
     *
     * @return string
     */
    public function serve()
    {
        Log::info('[wechat][receive]'. json_encode(request(), true));

        $app = app('wechat.official_account');
        $app->server->push(function($message){
            Log::info('[wechat][receive][message]'. json_encode($message, true));
            return "欢迎关注！";
        });

        return $app->server->serve();
    }
}