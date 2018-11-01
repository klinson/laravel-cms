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
    Route::get('categories/{category}', 'ArticlesController@categories')->where('category', '[0-9]+')->name('articles.categories');
    Route::get('categories/{category}/articles/{article}', 'ArticlesController@show')->where('category', '[0-9]+')->where('category', '[0-9]+')->name('articles.show');
});
