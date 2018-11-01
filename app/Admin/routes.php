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

    $router->post('files/editor', 'FilesController@editor');
});
