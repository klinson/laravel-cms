<?php

namespace App\Providers;

use App\Handlers\ConfigHandler;
use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Carbon 是 PHP DateTime 的一个简单扩展, 调整汉语
        Carbon::setLocale('zh');
        ConfigHandler::load();
        // dingo登录token有效期设置
        \Auth::guard('api')->factory()->setTTL(config('api.ttl'));

        $this->loadObserverConfig();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // 模型绑定失败报错404
        \API::error(function (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
            abort(404, '数据资源不存在');
        });

        // 操作无权限报错403
        \API::error(function (\Illuminate\Auth\Access\AuthorizationException $exception) {
            abort(403, $exception->getMessage());
        });

        // 未登录时用user时报错
        \API::error(function (\Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException $exception) {
            abort(401, '用户未登录');
        });

        // jwt-token 过期或已失效
        \API::error(function (\Tymon\JWTAuth\Exceptions\TokenBlacklistedException $exception) {
            abort(401, '用户未登录');
        });

        // 默认auth失败
        \API::error(function (\Illuminate\Auth\AuthenticationException $exception) {
            abort(401, '用户未登录');
        });
        // jwt-token不合法
        \API::error(function (\Tymon\JWTAuth\Exceptions\TokenInvalidException $exception) {
            abort(401, '用户未登录');
        });
    }

    protected function loadObserverConfig()
    {
        \App\Models\Message::observe(\App\Observers\MessageObserver::class);
        // 轮播广告的缓存观察器
        \App\Models\CarouselAd::observe(\App\Observers\CarouselAdObserver::class);
        \App\Models\CarouselAdItem::observe(\App\Observers\CarouselAdItemObserver::class);
        // 超链接的缓存观察器
        \App\Models\Link::observe(\App\Observers\LinkObserver::class);
        \App\Models\LinkItem::observe(\App\Observers\LinkItemObserver::class);
    }
}
