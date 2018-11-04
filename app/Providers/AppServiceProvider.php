<?php

namespace App\Providers;

use Encore\Admin\Config\Config;
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
        Config::load();

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
    }

    protected function loadObserverConfig()
    {
        \App\Models\Message::observe(\App\Observers\MessageObserver::class);
    }
}
