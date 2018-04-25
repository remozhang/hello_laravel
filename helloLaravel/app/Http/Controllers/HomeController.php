<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // 读取的时候，默认实现了一个中间件，应该是判断是否登录以及权限
        // 准确的讲，这个函数会在控制器类生产对象后第一时间载入一个为auth的中间件，
//        $this->middleware('auth');
//        var_dump(\App\Article::all());
//        exit;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // laravel view 采用__call来handler对未定义function的调用
        // 作用：给视图系统注入一个名为$articles的变量
        // 等价于->with('articles', \App\Article::all());
        // 举例 ->withFooBar 等价于->with('foo_bar', 100); 驼峰会完全转出蛇形
        return view('home')->withArticles(\App\Article::all());
    }
}
