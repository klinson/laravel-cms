<?php
/**
 * Created by PhpStorm.
 * User: klinson <klinson@163.com>
 * Date: 18-11-9
 * Time: 上午9:52
 */

namespace App\Http\Controllers;
use App\Handlers\LogHandler;
use App\Jobs\ReceiveWechatMessage;

class WechatController extends Controller
{
    /**
     * 处理微信的请求消息
     *
     * @return string
     */
    public function serve()
    {
        LogHandler::log('wechat', 'serve', request()->all());

        $app = app('wechat.official_account');
        $app->server->push(function($message){
            LogHandler::log('wechat', 'serve-message', $message);
            switch ($message['MsgType']) {
                case 'event':
                    // 点击事件
                    //{"ToUserName":"gh_f00d12a6807f","FromUserName":"o3l5Twydfo3yGJMLtqCDZdmVKkW8","CreateTime":"1543482755","MsgType":"event","Event":"CLICK","EventKey":"click_2"}
                    // 普通扫码
                    // {"ToUserName":"gh_f00d12a6807f","FromUserName":"o3l5Twydfo3yGJMLtqCDZdmVKkW8","CreateTime":"1543482854","MsgType":"event","Event":"scancode_push","EventKey":"click_4","ScanCodeInfo":{"ScanType":"qrcode","ScanResult":"萨达sda所大"}}
                    // 等待扫码
                    // {"ToUserName":"gh_f00d12a6807f","FromUserName":"o3l5Twydfo3yGJMLtqCDZdmVKkW8","CreateTime":"1543482863","MsgType":"event","Event":"scancode_waitmsg","EventKey":"click_5","ScanCodeInfo":{"ScanType":"qrcode","ScanResult":"萨达sda所大"}}
                    // 打开链接
                    // {"ToUserName":"gh_f00d12a6807f","FromUserName":"o3l5Twydfo3yGJMLtqCDZdmVKkW8","CreateTime":"1543483275","MsgType":"event","Event":"VIEW","EventKey":"https:\/\/www.klinson.com\/","MenuId":"422344901"}
                    return '收到事件消息';
                    break;
                case 'text':
                    //{"ToUserName":"gh_f00d12a6807f","FromUserName":"o3l5Twydfo3yGJMLtqCDZdmVKkW8","CreateTime":"1543482671","MsgType":"text","Content":"999","MsgId":"6629207594310057452"}
                    dispatch(new ReceiveWechatMessage($message));
                    return '收到文字消息';
                    break;
                case 'image':
                    //{"ToUserName":"gh_f00d12a6807f","FromUserName":"o3l5Twydfo3yGJMLtqCDZdmVKkW8","CreateTime":"1543482762","MsgType":"image","PicUrl":"http:\/\/mmbiz.qpic.cn\/mmbiz_jpg\/FWEnHfswJqibTSA3zVGVgPkgPrvxvGbCkSiaOVC61V6ia7MT2EJ8WRP8CrYLiaBv0d3wbN0DMcxziaBvVwNCiadCOMOQ\/0","MsgId":"6629207985152081392","MediaId":"_le8aXg-eDTiKVQiWZEiU8442bSJekpm_K46Z4MjzlsvqMRz-5MxozTIlyzztUej"}
                    dispatch(new ReceiveWechatMessage($message));
                    return '收到图片消息';
                    break;
                case 'voice':
                    //{"ToUserName":"gh_f00d12a6807f","FromUserName":"o3l5Twydfo3yGJMLtqCDZdmVKkW8","CreateTime":"1543482833","MsgType":"voice","MediaId":"uoRbjmGcxRUZ2jH_WIUdFX1m_gtl92aoZmjrJdldBOHMDffW3OQH6T-LjI462oha","Format":"amr","MsgId":"6629208290094759410","Recognition":null}
                    dispatch(new ReceiveWechatMessage($message));
                    return '收到语音消息';
                    break;
                case 'video':
                    //{"ToUserName":"gh_f00d12a6807f","FromUserName":"o3l5Twydfo3yGJMLtqCDZdmVKkW8","CreateTime":"1543483012","MsgType":"video","MediaId":"IoQz8qi9D4CUyMcvBrIkzRSSHd7-F-ujFQXu4YpaDH0WOASXHghafuVRcj4q-MJ5","ThumbMediaId":"H39obNMBH9tHuufYuMnlB_AeeX-cOr4pSwAl4njgqXDgChR7BWNPbj8ndfW9sq2t","MsgId":"6629209058893905397"}
                    dispatch(new ReceiveWechatMessage($message));
                    return '收到视频消息';
                    break;
                case 'location':
                    //{"ToUserName":"gh_f00d12a6807f","FromUserName":"o3l5Twydfo3yGJMLtqCDZdmVKkW8","CreateTime":"1543483021","MsgType":"location","Location_X":"22.962814","Location_Y":"113.892606","Scale":"15","Label":"东莞市肯德基汽车穿梭餐厅(>松山湖DT店)","MsgId":"6629209097548611063"}
                    dispatch(new ReceiveWechatMessage($message));
                    return '收到坐标消息';
                    break;

                default:
                    return '收到其它消息';
                    break;
            }
        });

        return $app->server->serve();
    }
}