<?php

namespace App\Models;

class Topic extends Model
{
    // 这里是允许这些数据填充
    // 这里fillable属性允许用户直接对数据进行修改
    protected $fillable = ['title', 'body', 'category_id', 'excerpt', 'slug'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    // 参数 $params 附带URL的参数设定
    public function link($params = [])
    {
        return route('topics.show', array_merge([$this->id, $this->slug], $params));
    }

    /* 这里我们定义了本地作用域，
     * 本地作用域允许我们定义通用的约束集合以便在应用中实现
     * 要定义这样的一个作用域，
     * 只需要简单地在对应的Eloquent模型方法加上一个scope前缀
     * 作用域总是返回查询构建器
     *
     */

    public function scopeWithOrder($query, $order)
    {
        // 不同的排序，使用不同的数据读取逻辑
        switch ($order) {
            case 'recent':
                $query->recent();
                break;
            default:
                $query->recentReplied();
                break;
        }

        // 预防n+1问题
        return $query->with('user', 'category');
    }

    public function scopeRecentReplied($query)
    {
        // 当话题有新回复时， 我们将编写逻辑来更新话题模型的reply_count属性
        // 此时会自动触发框架对数据模型 update_at 时间戳的更新
        return $query->orderBy('updated_at', 'desc');
    }

    public function scopeRecent($query)
    {
        // 按照创建时间排序
        return $query->orderBy('created_at', 'desc');
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

}
