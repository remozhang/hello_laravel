<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $fillable = ['nickname', 'email', 'website', 'content', 'article_id'];

    protected $table = "comments";

    public function post()
    {
        return $this->belongsTo('App\Article', 'article_id', 'id');
    }

    public function getComments()
    {
        $comments = \DB::table('comments')
            ->leftJoin('articles', 'comments.article_id', '=', 'articles.id')
            ->select('comments.*', 'articles.title')
            ->paginate(2);

        return $comments;
    }
}
