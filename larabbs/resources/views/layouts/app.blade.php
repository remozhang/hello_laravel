<!doctype html>
<html lang="{{app()->getLocale()}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{--CSRF Token--}}
    {{--csrf-token 标签是为了方便前端的javascript脚本获取CSRF令牌--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{--@yield('title', 'LaraBBS')继承此模版的页面，如果没有定制title区域的话，使用第二个参数作为标题--}}
    <title>@yield('title', 'laraBBS') - laravel 进阶教程</title>

    {{--style--}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('style')
</head>
<body>
    {{--route_class()是自定义辅助方法， 还需要在helpers.php中添加方法--}}
    {{--等于用“-”替换掉当前路由名称中的"."--}}
    {{--作用是允许我们针对某个页面做页面样式定制，而不是从一而终--}}
    <div id="app" class="{{route_class()}}-page">
        @include('layouts._header')
        <div class="container">
            @include('layouts._message')
            {{--加载顶部导航的子模块--}}
            @yield('content')
        </div>
        @include('layouts._footer')
    </div>

    {{--script--}}
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('script')
</body>
</html>