<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * 这个提供器是用来添加自定义的应用程序引导和服务内容绑定。
 * 对于大型应用程序来说，可以创建几个服务提供器，让每个服务提供器具有更精细的引导类型
 *
 * Class AppServiceProvider
 *
 * @package App\Providers
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
