<?php

namespace App\Models;

use App\Models\Traits\IntTimestampsHelper;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Article extends Model
{
    use IntTimestampsHelper, SoftDeletes;

    protected $fillable = [
        'title', 'description', 'author', 'publish_time', 'sort', 'has_enabled', 'is_top', 'pv'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_has_articles', 'article_id', 'category_id');
    }

    protected static function boot()
    {
        static::deleting(function ($model) {
            $model->categories()->detach();
        });
        parent::boot();
    }

    public static function recent($count = 3)
    {
        return self::with(['categories'])
            ->whereHas('categories', function ($query) {
                $query->where('is_page', 0);
                $query->where('has_enabled', 1);
            })
            ->orderBy('publish_time', 'desc')
            ->orderBy('created_at', 'desc')
            ->where('has_enabled', 1)
            ->limit($count)->get();
    }

    public function publishWechatNews()
    {
        $app = app('wechat.official_account');
        try {
            $media_id = $this->uploadToWechatServer();

            if (app()->environment() == 'production') {
                $res = $app->broadcasting->sendNews($media_id);
            } else {
                $res = $app->broadcasting->previewNews($media_id, config('wechat.defaults.test_openid'));
            }

            if (isset($res['errcode']) && $res['errcode'] > 0) {
                throw new \Exception($res['errmsg'], $res['errcode']);
            }

            return true;
        } catch (\Exception $exception) {
            throw new \Exception('文章群发失败：'.$exception->getMessage().($exception->getCode() !== 0 ? "[{$exception->getCode()}]" : ''));
        }
    }

    /**
     * 上传永久素材到微信服务器
     * @author klinson <klinson@163.com>
     * @return mixed
     * @throws \Exception
     */
    public function uploadToWechatServer()
    {
        // 验证必填项
        if (blank($this->title)) {
            throw new \Exception('文章没有标题');
        }

        $app = app('wechat.official_account');

        try {
            $article = new \EasyWeChat\Kernel\Messages\Article($this->getWechatPublishInfo());

            $res = $app->material->uploadArticle($article);

            if (isset($res['errcode']) && $res['errcode'] > 0) {
                throw new \Exception($res['errmsg'], $res['errcode']);
            }

            return $res['media_id'];
        } catch (\Exception $exception) {
            throw new \Exception('文章上传微信服务器失败：'.$exception->getMessage().($exception->getCode() !== 0 ? "[{$exception->getCode()}]" : ''));
        }
    }

    // 获取微信素材信息
    public function getWechatPublishInfo()
    {
        $info = [
            'title' => $this->title,
            'thumb_media_id' => $this->publish_wechat_thumb,
            'content' => $this->publish_wechat_content,
            'show_cover' => 0,
        ];

        ! blank($this->description) && $info['digest'] = $this->description;
        ! blank($this->author) && $info['author'] = $this->author;

        return $info;
    }

    /**
     * 根据封面获取微信封面素材资源id
     * @author klinson <klinson@163.com>
     * @return string
     * @throws \Exception
     */
    public function getPublishWechatThumbAttribute()
    {
        if (blank($this->thumbnail) || ! $realFilePath = Storage::disk('admin')->path($this->thumbnail)) {
            throw new \Exception('文章没有缩略图');
        }
        $app = app('wechat.official_account');

        try {
            $res = $app->material->uploadThumb($realFilePath);
            if (isset($res['errcode']) && $res['errcode'] > 0) {
                throw new \Exception($res['errmsg'], $res['errcode']);
            }

            return $res['media_id'];
        } catch (\Exception $exception) {
            throw new \Exception('文章缩略图上传微信服务器失败：'.$exception->getMessage().($exception->getCode() !== 0 ? "[{$exception->getCode()}]" : ''));
        }
    }

    /**
     * 处理富文本中图片资源，转换成微信素材资源
     * @author klinson <klinson@163.com>
     * @return mixed|string
     * @throws \Exception
     */
    public function getPublishWechatContentAttribute()
    {
        $content = $this->content;
        if (blank($content)) {
            throw new \Exception('文章没有内容');
        }

        $app = app('wechat.official_account');

        $preg =  '/<img.*?src=[\"|\']?(.*?)[\"|\']?\s.*?>/i';

        preg_match_all($preg, $content, $match);
        $images = $match[1];
        if (empty($images)) {
            return $content;
        }
        $replace_images = [];

        $date = date('Ymd/');
        foreach ($images as $image) {
            $saveFilePath = $date.md5($image).substr($image, strrpos($image, '.'));
            $res = Storage::disk('temp')->put($saveFilePath, @file_get_contents($image));
            if ($res) {
                $realFilePath = Storage::disk('temp')->path($saveFilePath);
            } else {
                throw new \Exception('文章图片另存本地失败');
            }
            try {
                $res = $app->material->uploadArticleImage($realFilePath);
                if (isset($res['errcode']) && $res['errcode'] > 0) {
                    throw new \Exception($res['errmsg'], $res['errcode']);
                }

                $replace_images[$image] = $res['url'];
            } catch (\Exception $exception) {
                throw new \Exception('文章图片上传微信服务器失败：'.$exception->getMessage().($exception->getCode() !== 0 ? "[{$exception->getCode()}]" : ''));
            }
        }

        $content = strtr($content, $replace_images);
        return $content;
    }

    public static function selectOptions()
    {
        $list = Article::all();
        $options = ['请选择'];
        foreach($list as $item) {
            $options[$item->id] = "No.{$item->id} {$item->title}";
        }

        return $options;
    }

    public function getWebUrlAttribute()
    {
        return route('articles.show', ['category' => $this->categories[0], 'article' => $this]);
    }
}
