<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

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

}
