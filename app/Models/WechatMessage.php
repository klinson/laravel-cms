<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class WechatMessage extends Model
{
    use SoftDeletes;

    const TYPE_TITLE = [
        'text' => '文本消息',
        'image' => '图片消息',
        'voice' => '语音消息',
        'video' => '视频消息',
        'location' => '位置消息',
    ];

    protected $fillable = [
        'wechat_message_id', 'type', 'content', 'full_content', 'from', 'to', 'received_at', 'from_info'
    ];

    public function getFromUserInfoAttribute()
    {
        return json_decode($this->getAttribute('from_info'));
    }

    public function getMessageAttribute()
    {
        return $this->getAttribute('content');
    }

    public function saveByWechatMessage($message)
    {
        $this->fill(static::formatWechatMessage($message));
        $this->save();
    }

    public static function formatWechatMessage($message)
    {
        $app = app('wechat.official_account');

        $data = [
            'wechat_message_id' => $message['MsgId'],
            'type' => $message['MsgType'],
            'content' => static::getContentByMessage($message),
            'full_content' => json_encode($message),
            'from' => $message['FromUserName'],
            'from_info' => json_encode($app->user->get($message['FromUserName'])),
            'to' => $message['ToUserName'],
            'received_at' => date('Y-m-d H:i:s', $message['CreateTime'])
        ];
        return $data;
    }

    public static function getContentByMessage($message)
    {
        switch ($message['MsgType']) {
            case 'text':
                //{"ToUserName":"gh_f00d12a6807f","FromUserName":"o3l5Twydfo3yGJMLtqCDZdmVKkW8","CreateTime":"1543482671","MsgType":"text","Content":"999","MsgId":"6629207594310057452"}
                return $message['Content'];
                break;
            case 'image':
                //{"ToUserName":"gh_f00d12a6807f","FromUserName":"o3l5Twydfo3yGJMLtqCDZdmVKkW8","CreateTime":"1543482762","MsgType":"image","PicUrl":"http:\/\/mmbiz.qpic.cn\/mmbiz_jpg\/FWEnHfswJqibTSA3zVGVgPkgPrvxvGbCkSiaOVC61V6ia7MT2EJ8WRP8CrYLiaBv0d3wbN0DMcxziaBvVwNCiadCOMOQ\/0","MsgId":"6629207985152081392","MediaId":"_le8aXg-eDTiKVQiWZEiU8442bSJekpm_K46Z4MjzlsvqMRz-5MxozTIlyzztUej"}
                return $message['PicUrl'];
                break;
            case 'voice':
                //{"ToUserName":"gh_f00d12a6807f","FromUserName":"o3l5Twydfo3yGJMLtqCDZdmVKkW8","CreateTime":"1543482833","MsgType":"voice","MediaId":"uoRbjmGcxRUZ2jH_WIUdFX1m_gtl92aoZmjrJdldBOHMDffW3OQH6T-LjI462oha","Format":"amr","MsgId":"6629208290094759410","Recognition":null}
                return $message['MediaId'];
                break;
            case 'video':
                //{"ToUserName":"gh_f00d12a6807f","FromUserName":"o3l5Twydfo3yGJMLtqCDZdmVKkW8","CreateTime":"1543483012","MsgType":"video","MediaId":"IoQz8qi9D4CUyMcvBrIkzRSSHd7-F-ujFQXu4YpaDH0WOASXHghafuVRcj4q-MJ5","ThumbMediaId":"H39obNMBH9tHuufYuMnlB_AeeX-cOr4pSwAl4njgqXDgChR7BWNPbj8ndfW9sq2t","MsgId":"6629209058893905397"}
                return $message['MediaId'];
                break;
            case 'location':
                //{"ToUserName":"gh_f00d12a6807f","FromUserName":"o3l5Twydfo3yGJMLtqCDZdmVKkW8","CreateTime":"1543483021","MsgType":"location","Location_X":"22.962814","Location_Y":"113.892606","Scale":"15","Label":"东莞市肯德基汽车穿梭餐厅(>松山湖DT店)","MsgId":"6629209097548611063"}
                return $message['Label'];
                break;

            default:
                return '';
                break;
        }
    }
}
