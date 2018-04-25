<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
//    找到id为2的文章打印其标题
//    $article = Article::find(2);
//    echo $article->title

//    查找标题为 “我是标题"的文章， 并打印id
//    $article = Article::where('title', '我是标题')->first();
//    echo $article->id;

//    查询所有文章, 并循环打印标题
//    $articles  = Article::all(); // 这里返回的是对象，要化为数组，调用 toArray()
//    foreach ($articles as $article) {
//        echo $article->title;
//    }

//    查找id大于10 且小于20的文章
//    $article = Article::where('id','>', '10')->where('id', '<', '20')->orderBy('updated_at', 'desc')->get();

    // 建立一对多关系
    public function hasManyComments()
    {
        // hasMany第一个参数related指的是model名称
        return $this->hasMany('App\Comment', 'article_id', 'id');
        // 使用方法
//        $comments = User::find(10)->hsaManyComments()->get();
    }

    // 建立一对一关系
//    public function hasOneComment()
//    {
//        return $this->hasOne('App\Comment', 'article_id', 'id');
//    }

    // 建立多对多关系
//    public function belongsToManyComment()
//    {
//        return $this->belongstoMany('Comment', 'article_comment','article_id', 'comment_id');
//        // 使用方法
////        $articlewithComment = Article::take(10)->get()->belongsToMnyArticle()->get();
//
//    }

    // belongsToMany 自己
//    public function parent_video()
//    {
//        return $this->belongsToMany($this, 'video_hierarchy', 'video_id', "video_parent_id");
//    }
//
//    public function children_video()
//    {
//        return $this->belongsToMany($this, 'video_hierarchy', 'video_id', 'video_parent_id');
//    }
//


}
