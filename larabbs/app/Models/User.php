<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;

class User extends Authenticatable
{
    // 包含一个可以用来发通知的方法 notify
    use Notifiable {
//      修改了 内置方法notify的访问权限以及别名,原版方法notify的访问控制没有发生变化
        notify as protected laravelNotify;
    }

    // 这里是谁调用的 看observe中的replyObserve
    public function notify($instance)
    {
        // 如果通知的人是当前用户,就不必通知了
        if ($this->id == Auth::id()) {
            return;
        }
        $this->increment('notification_count');
        $this->laravelNotify($instance);
    }

    /**
     * The attributes that are mass assignable.
     * 只有在此属性定义的字段，才允许修改，否则忽略
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'introduction', 'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     *
     * 这里用户与话题是一对多关系，一个用户拥有多个主题，在Eloquent中使用hasMany()方法进行关联
     * 关联设置成功后,我们既可以使用$user->topics来获取用户发布的所有话题数据
     */
    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    public function isAuthorOf($model)
    {
        return $this->id == $model->user_id;
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function markAsRead()
    {
        $this->notification_count = 0;
        $this->save();
        $this->unreadNotifications->markAsRead();
    }
}
