<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class Policy
{
    use HandlesAuthorization;

    public function __construct()
    {
        //
    }

    // before 方法会在策略中其他所有方法之前执行

    /**
     * before 方法会在策略中其他所有方法之前执行
     *
     * @param $user
     * @param $ability
     * @return boolean | null
     */
    public function before($user, $ability)
	{
	    // 如果用户拥有管理内容的权限的话,即授权通过
        if ($user->can('manage_contents')) {
            return true;
        }
	}
}
