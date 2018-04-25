<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Article;

class ArticleController extends Controller
{
    //
    public function index()
    {
        // 更加规范写法->with('Articles'. Article::all())
        return view('admin/article/index')->withArticles(Article::all());
    }

    public function create()
    {
        return view('admin/article/create');
    }

    public function store(Request $request)
    {
        // 这里的unique：articles 是指的从articles表中查找是否存在相同的article
        $this->validate($request, [
            'title' => 'required|unique:articles|max:255',
            'body' => 'required'
        ]);

        $article = new Article;
        $article->title = $request->get('title');
        $article->body = $request->get('body');
        $article->user_id = $request->user()->id; // 获取当前 Auth 系统中注册的用户，并将id赋值给article

        if ($article->save()) {
            return redirect('admin/articles');
        } else {
            return redirect()->back()->withInput()->withErrors('保存失败！');
        }
    }

    public function edit($id)
    {
        // todo 这里应该是从数据库中读出数据
        return view('admin/article/edit')->with('article', Article::find($id));
    }

    public function update(Request $request, $id)
    {
        // 这里更新判重的时候应该忽略本身ID
        // unique部分，这里传的参数应该是3个参数
        $this->validate($request, [
            'title' => 'required|unique:articles,title,' . $id .'|max:255',
            'body' => 'required'
        ]);


        $article = Article::find($id);
        $article->title = $request->get('title');
        $article->body = $request->get('body');

        if ($article->save()) {
            return redirect('admin/articles');
        } else {
            return redirect()->back()->withInput()->withErrors('修改失败！');
        }
    }

    public function destroy($id)
    {
        Article::find($id)->delete();
        return redirect()->back()->withInput()->withErrors('删除成功！');
    }
}
