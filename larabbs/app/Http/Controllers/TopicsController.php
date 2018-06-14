<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TopicRequest;
use App\Models\Category;
use App\Handlers\ImageUploadHandler;
use Auth;

class TopicsController extends Controller
{
    public function __construct()
    {
        // 对除了 index 以及 show 以外的方法使用auth中间件进行确认
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

	public function index(Request $request, Topic $topic)
	{
	    // 这里withOrder($order) 不能简写成with('order', $order)这种形式，因为这里不是view 而是model
		$topics = $topic->with('user', 'category')->withOrder($request->order)->paginate(30);
//        $topics = Topic::paginate(30);
		return view('topics.index', compact('topics'));
	}

	// 这里使用了laravel的隐形路由模型绑定，当请求http://larabbs.test/topics/1时， $topic变量自动解析为1的对象
    public function show(Topic $topic)
    {
        return view('topics.show', compact('topic'));
    }

	public function create(Topic $topic)
	{
	    $categories = Category::all();
		return view('topics.create_and_edit', compact('topic', 'categories'));
	}

	// store第二个参数会创建一个空白的$topic实例
	public function store(TopicRequest $request, Topic $topic)
	{
	    // 获取用户提交的请求中的数据数组， fill方法将传参的数组填充到模型属性中
	    $topic->fill($request->all());
	    $topic->user_id = Auth::id();
        $topic->save();
        //		$topic = Topic::create($request->all());

        return redirect()->route('topics.show', $topic->id)->with('message', '创建成功!.');
	}

	public function edit(Topic $topic)
	{
        $this->authorize('update', $topic);
		return view('topics.create_and_edit', compact('topic'));
	}

	public function update(TopicRequest $request, Topic $topic)
	{
		$this->authorize('update', $topic);
		$topic->update($request->all());

		return redirect()->route('topics.show', $topic->id)->with('message', '更新成功！');
	}

	public function destroy(Topic $topic)
	{
		$this->authorize('destroy', $topic);
		$topic->delete();

		return redirect()->route('topics.index')->with('message', '删除成功！');
	}

	// laravel 控制器中如果直接返回数组，将会被自动解析成JSON
	public function uploadImage(Request $request, ImageUploadHandler $uploader)
    {
        // 初始化返回数据，默认是失败的, 屌毛
        $data = [
            'success' => false,
            'msg' => '上传失败!',
            'file_path' => ''
        ];

        // 判断是否有上传文件，并赋值给$file
        if ($file = $request->upload_file) {

            // 保存图片到本地
            $result = $uploader->save($request->upload_file, 'topics',\Auth::id(), 1024);

            // 图片保存成功的话
            if ($request) {
                $data['file_path'] = $result['path'];
                $data['msg'] = "上传成功！";
                $data['success'] = true;
            }
        }

        return $data;

    }

}