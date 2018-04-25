<?php

namespace LaraShuo\LaraCrud;

use Illuminate\Support\ServiceProvider;

class LaraCrudServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {   
        //加载package的路由文件
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        //加载模板目录
        $this->loadViewsFrom(__DIR__.'/views', 'goods');
        //加载migration文件
        $this->loadMigrationsFrom(__DIR__.'/migrations');

        //发布css和js文件
        $this->publishes([
            __DIR__.'/front/crud' => public_path('vendor/crud'),
        ], 'public');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
