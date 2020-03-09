<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::namespace('Home')->group(function (){
    Route::get('/', 'IndexController@index')->name('index');
    Route::get('/articles', 'ArticlesController@index')->name('articles');
    Route::get('/articles/{article}', 'ArticlesController@show')->where('article', '[0-9]+')->name('articles.show');
    Route::get('/contactUs', 'SystemController@contactUs')->name('system.contactUs');
    Route::post('/contactUs', 'SystemController@storeContactUs')->name('system.contactUs.store');

    Route::get('login', 'AuthController@login')->name('login');
    Route::post('login', 'AuthController@storeLogin')->name('login.store');

    Route::get('register', 'AuthController@register')->name('register');
    Route::post('register', 'AuthController@storeRegister')->name('register.store');

    Route::group([
        'middleware' => 'auth'
    ], function (){
        Route::get('user', 'UserController@index')->name('user');
        Route::put('user', 'UserController@update')->name('user.update');
        Route::get('user/comments', 'UserController@comments')->name('user.comments');
        Route::get('user/collects', 'UserController@collects')->name('user.collects');
        Route::post('articles/{article}/collect', 'ArticlesController@collect')->where('article', '[0-9]+')->name('articles.collect');
        Route::delete('articles/{article}/collect', 'ArticlesController@collect')->where('article', '[0-9]+');
        Route::post('articles/{article}/comments', 'ArticlesController@comment')->where('article', '[0-9]+')->name('articles.comment');
    });
});
