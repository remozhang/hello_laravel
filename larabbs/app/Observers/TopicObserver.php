<?php

namespace App\Observers;

use App\Models\Topic;
use App\Handlers\SlugTranslateHandler;

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
        // xss过滤
        $topic->body = clean($topic->body, 'user_topic_body');

        // make_excerpt 是自身定义的方法
        // 生成话题摘录
        $topic->excerpt = make_excerpt($topic->body);

        // 如 slug 字段无内容，即使用翻译器对 title 进行翻译
        if (!$topic->slug) {
            // app() 允许我们使用Laravel服务容器，此处我们用来生成SlugTranslateHandler实例
            $topic->slug = app(SlugTranslateHandler::class)->translate($topic->title);
        }
    }
}