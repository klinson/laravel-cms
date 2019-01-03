<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('users', UsersController::class);
    $router->resource('categories', CategoriesController::class);
    $router->resource('articles', ArticlesController::class);

    // 发布微信群发
    $router->put('articles/{article}/publishWechat', 'ArticlesController@publish');

    $router->post('files/editor', 'FilesController@editor');
    $router->resource('messages', MessagesController::class);

//    $router->get('wechat/menus', 'WechatController@menus');
    $router->get('wechat/menus/publish', 'Wechat\MenusController@publish');
    $router->resource('wechat/menus', Wechat\MenusController::class);

    $router->put('wechat/articles/{article}/publish', 'Wechat\ArticlesController@publish');
    $router->resource('wechat/articles', Wechat\ArticlesController::class);

    $router->get('wechat/messages', 'Wechat\MessagesController@index');
    $router->get('wechat/messages/{message}', 'Wechat\MessagesController@reply');
    $router->post('wechat/messages/{message}', 'Wechat\MessagesController@storeReply')->name('wechat.message.reply.store');
    $router->delete('wechat/messages/{message}', 'Wechat\MessagesController@destroy');

    // 通用轮播路由
    $router->get('carouselAds/{ad}/items', 'CarouselAdsController@items')->where('ad', '[0-9]+');
    $router->post('carouselAds/{ad}/items', 'CarouselAdsController@storeItems')->where('ad', '[0-9]+');
    $router->get('carouselAds/{ad}/items/{item}/edit', 'CarouselAdsController@editItems')->where('ad', '[0-9]+')->where('item', '[0-9]+');
    $router->put('carouselAds/{ad}/items/{item}', 'CarouselAdsController@updateItems')->where('ad', '[0-9]+')->where('item', '[0-9]+');
    $router->delete('carouselAds/{ad}/items/{item}', 'CarouselAdsController@destroyItems')->where('ad', '[0-9]+')->where('item', '[0-9]+');
    $router->resource('carouselAds', CarouselAdsController::class);

    // 通用导航栏/推广友情链接路路由
    $router->get('links/{link}/items', 'LinksController@items')->where('link', '[0-9]+');
    $router->post('links/{link}/items', 'LinksController@storeItems')->where('link', '[0-9]+')->name('links.items.store');
    $router->get('links/{link}/items/{item}/edit', 'LinksController@editItems')->where('link', '[0-9]+')->where('item', '[0-9]+');
    $router->put('links/{link}/items/{item}', 'LinksController@updateItems')->where('link', '[0-9]+')->where('item', '[0-9]+');
    $router->delete('links/{link}/items/{item}', 'LinksController@destroyItems')->where('link', '[0-9]+')->where('item', '[0-9]+');
    $router->resource('links', LinksController::class);

});
