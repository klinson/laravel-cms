<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 生成数据集合
        $users = factory(User::class)
            ->times(100)
            ->make();

        // 让隐藏字段可见，并将数据集合转换为数组
        $user_array = $users->makeVisible(['password'])->toArray();

        // 插入到数据库中
        User::insert($user_array);

        // 单独处理几个用户的数据
        $user = User::find(1);
        $user->name = 'klinson';
        $user->nickname = 'klinson专用测试账号';
        $user->username = 'klinson';
        $user->email = 'klinson@zemcho.com';
        $user->password = bcrypt('klinson');
        $user->save();
    }
}
