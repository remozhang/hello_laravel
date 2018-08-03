<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReplyRequest;
use Auth;

class RepliesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    // 这里传入的应该是model reply
	public function store(ReplyRequest $request, Reply $reply)
	{
	    $reply->content = $request->content;
        $reply->topic_id = $request->topic_id;
        $reply->user_id = Auth::id();
        $reply->save();

        return redirect()->to($reply->topic->link())->with('success', '创建成功!');
	}

	public function destroy(Reply $reply)
	{
		$this->authorize('destroy', $reply);
		$reply->delete();

		return redirect()->route('replies.index')->with('success', '删除成功!');
	}
}