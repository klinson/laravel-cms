<?php

namespace App\Models;

use Carbon\Carbon;

class WechatArticle extends Model
{
    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id', 'id');
    }

    public function publish()
    {
        $app = app('wechat.official_account');
        try {
            $media_id = $this->wechat_media_id;

            if (app()->environment() == 'production') {
                $res = $app->broadcasting->sendNews($media_id);
            } else {
                $res = $app->broadcasting->previewNews($media_id, config('wechat.defaults.test_openid'));
            }

            if (isset($res['errcode']) && $res['errcode'] > 0) {
                throw new \Exception($res['errmsg'], $res['errcode']);
            }

            $this->published_at = Carbon::now()->toDateTimeString();
            $this->save();
            return true;
        } catch (\Exception $exception) {
            throw new \Exception('文章群发失败：'.$exception->getMessage().($exception->getCode() !== 0 ? "[{$exception->getCode()}]" : ''));
        }
    }

    /**
     * 获取微信资源信息
     * @author klinson <klinson@163.com>
     * @return mixed
        array:11 [▼
            "title" => "测试推文"
            "author" => "klinson"
            "digest" => "测试的。。。"
            "content" => "<p></p><h1><p style="text-align: center;">测试推文</p><p style="text-align: center;">测试推文</p><p style="text-align: center;">测试推文</p><p style="text-align: center;">< ▶"
            "content_source_url" => ""
            "thumb_media_id" => "xy3IonxQFIFwz-mvYRzLbo5uMx4ZJwkxAAbSTauJ5Xg"
            "show_cover_pic" => 0
            "url" => "http://mp.weixin.qq.com/s?__biz=MzI3NzAyMDg5NA==&mid=100000029&idx=1&sn=1a8258c4012e0f630f4d2398d5350fbf&chksm=6b6de8ac5c1a61bafefb41650f289d0661e4eaed3d7df8c13 ▶"
            "thumb_url" => "http://mmbiz.qpic.cn/mmbiz_jpg/jbdK5X8uiaatqaWsgGMnicDCWHj0TyUFYFuFIrIdicjBeJ4icjWDpYRh6xSQ53dvLIIt5DLn5wZOohpHzlkIiaPUVMA/0?wx_fmt=jpeg"
            "need_open_comment" => 0
            "only_fans_can_comment" => 0
        ]
     * @throws \Exception
     */
    public function getWechatMediaInfo()
    {
        $app = app('wechat.official_account');
        $res = $app->material->get($this->wechat_media_id);

        if (isset($res['errcode']) && $res['errcode'] > 0) {
            throw new \Exception($res['errmsg'], $res['errcode']);
        }

        return $res['news_item'][0];
    }
}
