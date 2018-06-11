<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Category;

class CategoriesController extends Controller
{
    //
    public function show(Category $category)
    {
        // 读取分类 ID 相关话题，并按每页 20 条分页
        $topics = Topic::where('category_id', $category->id)->paginate(20);

        // 传参变量话题和分类到模版
        return view('topics.index', compact('topics', 'category'));
    }
}
