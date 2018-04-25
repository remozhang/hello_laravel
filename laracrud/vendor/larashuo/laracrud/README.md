## LaraCrud
<p>一个基于Laravel5.5的crud操作的package </p>
<p>
 网址：
 <a href="https://larashuo.com">larashuo.com</a>
 <p>

## 安装

````php
//安装
composer require larashuo/laracrudpro

//在config/app.php $providers中添加
LaraShuo\LaraCrud\LaraCrudServiceProvider::class,

// publish
php artisan vendor:publish 

//生成数据表
php artisan migrate

````

<p>最后可以通过 http://domain/goods 来访问</p>