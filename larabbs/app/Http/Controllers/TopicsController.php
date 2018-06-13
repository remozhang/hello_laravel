<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TopicRequest;
use App\Models\Category;
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

        return redirect()->route('topics.show', $topic->id)->with('message', 'Created successfully.');
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

		return redirect()->route('topics.show', $topic->id)->with('message', 'Updated successfully.');
	}

	public function destroy(Topic $topic)
	{
		$this->authorize('destroy', $topic);
		$topic->delete();

		return redirect()->route('topics.index')->with('message', 'Deleted successfully.');
	}


}