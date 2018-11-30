<?php

namespace App\Models;

use Carbon\Carbon;
use EasyWeChat\Kernel\Messages\Text;

class WechatMessageReply extends Model
{
    public $sendErrorMessage;

    protected $fillable = [
        'content', 'from', 'to', 'is_success', 'sent_at'
    ];

    public function send()
    {
        $app = app('wechat.official_account');
        $message = new Text($this->content);
        $res = $app->customer_service->message($message)->to($this->to)->send();
        if (isset($res['errcode']) && $res['errcode'] > 0) {
            $this->is_success = 0;
            $this->sendErrorMessage = $res['errmsg'];
            return false;
        } else {
            $this->is_success = 1;
            $this->sent_at = Carbon::now()->toDateTimeString();
            return true;
        }
    }
}
