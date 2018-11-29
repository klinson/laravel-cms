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
}
