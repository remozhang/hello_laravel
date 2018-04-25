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

//Route::get('/', function () {
//    return view('welcome');
//});

//Route::get('/now', function() {
//    return date('Y-m-d H:i:s');
//});

// 请求model中的list action时候， 默认调用各个model的list action
//Route::get('{model}/lists', function($model) {
//    $className = 'App\Http\Controller\\' . ucfirst(strtolower($model)) . 'Controller';
//    $obj = $this->app->make($className);
//    return $obj->list();
//});

Auth::routes();

// 当请求到 '/home' 页面时, 调用HomeController中的index action
//Route::get('/home', 'HomeController@index')->name('home');

//Route::get('/', 'HomeController@index')->name('home');

// 使用路由组来将后台页面置于“需要登录才能访问”的中间件下
// 登录由middleware定义， /admin 由prefix定义， 'Admin' 由 'namespace'定义
Route::group(['middleware' => "auth", 'namespace' => 'Admin', 'prefix' => '/admin'], function(){
    Route::get('/', 'HomeController@index');
    Route::resource('articles', 'ArticleController');
});

// RESTful 资源控制器
//Route::resource('photo', 'PhotoController');

Route::get('article/{id}', 'ArticleController@show');
Route::post('comment', 'CommentController@store');

