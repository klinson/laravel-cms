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
});
