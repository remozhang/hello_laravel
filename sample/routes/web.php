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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', 'StaticPagesController@home')->name('home');
Route::get('/about', 'StaticPagesController@about')->name('about');

// 这里可以为路由指定名称, 然后前台中的 a 标签可以直接请求路由,在里面添加参数
Route::get('/help', 'StaticPagesController@help')->name('help');
Route::get('/signup', 'UsersController@create')->name('signup');