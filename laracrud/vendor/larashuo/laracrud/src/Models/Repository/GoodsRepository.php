<?php

namespace LaraShuo\LaraCrud\Models\Repository;

use Storage;
use Config;
use LaraShuo\LaraCrud\Models\GoodsGallery;
trait GoodsRepository{

	/*
	|--------------------------------------------------------------------------
	| 
	| 存储数据
	|
	|--------------------------------------------------------------------------
	*/
	public static function createModel(){

		$self 			= new static;
		$model 			= $self->create(request()->all());
		GoodsGallery::upload($model);
		return $model;
	}

	/*
	|--------------------------------------------------------------------------
	| 
	| 删除商品相册
	|
	|--------------------------------------------------------------------------
	*/
	public function deleteGoodsGallery(){

		if(count($this->gallery()->get())){
			foreach($this->gallery()->get() as $gallery){
				//删除详情图片
				(new static)->imgDel($gallery->goods_img);
				//删除缩略图
				(new static)->imgDel($gallery->goods_thumb);
				//删除原始图片
				(new static)->imgDel($gallery->goods_original);
				//删除相册记录
				$gallery->delete();
			}
		}
	}

	/*
	|--------------------------------------------------------------------------
	| 
	| 删除图片
	|
	|--------------------------------------------------------------------------
	*/
	public static function imgDel($path)
	{
		if(Storage::exists($path)){
			Storage::delete($path);
		}
	}

	/*
	|--------------------------------------------------------------------------
	| 
	| 获取商品的缩略图
	|
	|--------------------------------------------------------------------------
	*/
	public function getThumb()
	{
		return (Config::get('filesystems.default') == 'oss') ? 
				env('ALIOSS_BASEURL').$this->thumb() : url($this->thumb());
	}


	/*
	|--------------------------------------------------------------------------
	| 
	| 获取商品的缩略图
	|
	|--------------------------------------------------------------------------
	*/
	public function thumb()
	{
		return (count($this->gallery()->get())) ?
		       ($this->gallery()->first()->goods_thumb) : '';
	}


	

}