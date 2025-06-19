<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    /**
     * 在删除用户的时候删除掉用户发布的话题和回复
     *
     * @param User $user
     * @return void
     */
    public function deleting(User $user): void
    {
        $user->topics()->delete();
        $user->replies()->delete();
    }

    /**
     * 在保存用户之前设置默认头像
     *
     * @param User $user
     * @return void
     */
    public function saving(User $user): void
    {
        $defaultAvatarNames = [200, 300, 400, 500, 600];
        if (empty($user->avatar)) {
            $user->avatar = env('APP_URL') . '/uploads/images/default-avatar/' . $defaultAvatarNames[array_rand($defaultAvatarNames)] . '.jpg';
        }
    }
}
