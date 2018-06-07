<?php

namespace App\Models;

class Topic extends Model
{
    // 这里是允许这些数据填充
    protected $fillable = ['title', 'body', 'user_id', 'category_id', 'reply_count', 'view_count', 'last_reply_user_id', 'order', 'excerpt', 'slug'];
}
