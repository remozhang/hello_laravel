<?php

namespace App\Models;

class Reply extends Model
{
    // 这里只允许用户修改content
    protected $fillable = ['content'];

    // 这里应该是以字段为函数名,
    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function user()
    {
        return $this->belongsTo(Topic::class);
    }
}
