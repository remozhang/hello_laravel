<?php

namespace App\Observers;

use App\Models\Topic;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored
// Eloquent 允许我们对定模型进行事件监控， 观察者类l里面的方法名对应监听的事件
// 每种方法接受model为唯一参数，

class TopicObserver
{
    public function creating(Topic $topic)
    {
        //
    }

    public function updating(Topic $topic)
    {
        //
    }

    public function saving(Topic $topic)
    {
        $topic->body = clean($topic->body, 'user_topic_body');
        // make_excerpt 是自身定义的方法
        $topic->excerpt = make_excerpt($topic->body);
    }
}