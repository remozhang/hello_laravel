<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    //
    public function index()
    {
//        $comment = Comment::find(1);
//        echo $comment->post->title;
//        exit;
        $commentModel = new Comment;
        $comments = $commentModel->getComments();

        return view('comment/index')->with('comments', $comments);
    }


    public function store(Request $request)
    {
        if (Comment::create($request->all())) {
            return redirect()->back();
        } else {
            return redirect()->back()->withInput()->withErrors('发表评论失败！');
        }
    }
}
