<?php
Route::namespace('LaraShuo\LaraCrud')->group(function(){
	Route::resource('goods','GoodsController');
	//批量删除
	Route::post('goods/batch-del','GoodsController@batch');
	//ajax刷新验证码
	Route::post('get-captcha','GoodsController@getCaptcha');
});