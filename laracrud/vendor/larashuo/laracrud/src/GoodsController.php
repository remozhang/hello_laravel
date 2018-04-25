<?php

namespace LaraShuo\LaraCrud;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use LaraShuo\LaraCrud\Models\Goods;
use LaraShuo\LaraCrud\Models\GoodsGallery;
use Storage;
use File,Image;

class GoodsController extends Controller
{
    /*
	|--------------------------------------------------------------------------
	| 
	| 构造函数
	|
	|--------------------------------------------------------------------------
	*/
	public function __construct()
	{
		//表单数据验证
		$this->rules = [
			'goods_sn'=>'required',
			'goods_name'=>'required',
			'shop_price'=>'required',
			'imgs.*'=>'image',
			'captcha'=>'required|captcha',
		];
		//表单数据验证
		$this->updateRules = [
			'goods_sn'=>'required',
			'goods_name'=>'required',
			'shop_price'=>'required',
			'imgs.*'=>'image',
		];
		$this->messages = [
			'goods_sn.required'=>'商品货号必须',
			'goods_name.required'=>'名称必须',
			'shop_price.required'=>'价格必须',
			'imgs.*.image'=>'必须是图片格式',
			'captcha.required'=>'验证码必须',
			'captcha.captcha'=>'验证码错误',
		];
		$this->middleware('web');
	}
    

    /*
	|--------------------------------------------------------------------------
	| 
	| 显示商品列表
	|
	|--------------------------------------------------------------------------
	*/
    public function index(){
    	$goods_list 			= Goods::paginate(20);
    	$title 					= '商品列表';
    	return view('goods::index',compact('goods_list','title'));
    }


    /*
	|--------------------------------------------------------------------------
	| 
	| 显示添加商品数据的表单
	|
	|--------------------------------------------------------------------------
	*/
	public function create(){
		$title 					= '添加商品数据';
		return view('goods::create',compact('title'));
	}

	/*
	|--------------------------------------------------------------------------
	| 
	| 存储数据到数据库
	|
	|--------------------------------------------------------------------------
	*/
	public function store(){
		request()->validate($this->rules,$this->messages);
		Goods::createModel();
		return redirect('goods');
	}

	/*
	|--------------------------------------------------------------------------
	| 
	| 显示编辑商品数据的表单
	|
	|--------------------------------------------------------------------------
	*/
	public function edit($id){

		$model 			= Goods::find($id);
		$title 		= '编辑商品数据';
		if(empty($model)){
			return '模型不存在';
		}
		return view('goods::edit',compact('title','model'));

		
	}

	/*
	|--------------------------------------------------------------------------
	| 
	| 更新商品数据
	|
	|--------------------------------------------------------------------------
	*/
	public function update($id){

		$model 			= Goods::find($id);
		if(empty($model)){
			return false;
		}

		//表单验证
		request()->validate($this->updateRules,$this->messages);
		//处理更新数据
		$model->update(request()->all());
		//处理缩略图上传
		GoodsGallery::upload($model);
		return redirect('goods');

	}


	/*
	|--------------------------------------------------------------------------
	| 
	| ajax删除记录
	|
	|--------------------------------------------------------------------------
	*/
	public function destroy($id){

		$model 		= Goods::find($id);
		if(empty($model)){
			return json_encode([
					'tag'		=>'error',
					'message'	=>'模型为空',
			]);
		}
		//删除商品缩略图
		$model->deleteGoodsGallery();
		$model->delete();
		return json_encode([
				'tag'		=>'success',
				'message'	=>'成功删除',
		]);
	}


	/*
	|--------------------------------------------------------------------------
	|
	| 批量删除
	|
	|--------------------------------------------------------------------------
	*/
	public function batch(){
		$ids 		= request()->ids;
		if(empty($ids)){
			return '未选中任何项';
		}
		foreach($ids as $id){
			$model 		= Goods::find($id);
			//删除商品的缩略图
			$model->deleteGoodsGallery();
			//删除商品本身
			$model->delete();
		}
		return redirect('goods');	
	}

	/*
	|--------------------------------------------------------------------------
	| 
	| 获取验证码
	|
	|--------------------------------------------------------------------------
	*/
	public function getCaptcha()
	{
		return response()->json([
				'tag'=>'success',
				'captcha_src'=> captcha_src('flat'),
		]);
		
	}
}
