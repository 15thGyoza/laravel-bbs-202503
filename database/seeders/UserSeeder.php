<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Random\RandomException;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws RandomException
     */
    public function run(): void
    {
        User::factory()->count(random_int(25, 48))->create();

        // 单独处理第一个用户, 方便我们测试
        $user = User::find(1);
        $user->name = 'LiRundian';
        $user->email = 'lirundian2010@gmail.com';
        $user->avatar = config('app.url') . '/uploads/images/default-avatar/supermanager.jpg';
        $user->save();

        // 赋予站长角色
        $user->assignRole('Founder');

        // 赋予管理员权限
        $user = User::find(2);
        $user->assignRole('Maintainer');
    }
}
