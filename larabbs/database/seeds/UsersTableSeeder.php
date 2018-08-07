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
        // 获取faker实例
        $faker = app(Faker\Generator::class);

        // 头像假数据
        $avatars = [
            'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/s5ehp11z6s.png?imageView2/1/w/200/h/200',
            'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/Lhd1SHqu86.png?imageView2/1/w/200/h/200',
            'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/LOnMrqbHJn.png?imageView2/1/w/200/h/200',
            'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/xAuDMxteQy.png?imageView2/1/w/200/h/200',
            'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/ZqM7iaP4CR.png?imageView2/1/w/200/h/200',
            'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/NDnzMutoxX.png?imageView2/1/w/200/h/200',
        ];

        // 生成数据集合
        $users = factory(User::class)
            ->times(10)
            ->make()
            ->each(function ($user, $index)
                use ($faker, $avatars)
            {
                $user->avatar = $faker->randomElement($avatars);
            });

        // 让隐藏字段可见，并将数据集合转换为数组
        $user_array = $users->makeVisible(['password', 'remember_token'])->toArray();

        // 插入到数据库中
        User::insert($user_array);

        // 单独处理第一个用户的数据
        $user = User::find(1);
        $user->name = 'zhanglei';
        $user->email = '814895077@qq.com';
        $user->avatar = 'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/ZqM7iaP4CR.png?imageView2/1/w/200/h/200';
        $user->password = '$2y$10$8g4Jnun0wwpjm1S7u1VXzu.HC2X1/DWDcW3Fhh2EHqBVMkkY/rWPW';
        $user->remember_token = '6bC052FTlRF6QMn0XKVU09F9LSlsBIiwyzAXLiGUOm49digqVhXRCTcZCK3a';
        $user->save();

        // 初始化用户, 将 11 号用户当作站长
        $user->assignRole('Founder');

        // 将 12 号用户指派为管理员
        $user = User::find(2);
        $user->name = 'remo';
        $user->email = '799649731@qq.com';
        $user->avatar = 'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/ZqM7iaP4CR.png?imageView2/1/w/200/h/200';
        $user->password = '$2y$10$8g4Jnun0wwpjm1S7u1VXzu.HC2X1/DWDcW3Fhh2EHqBVMkkY/rWPW';
        $user->remember_token = '6bC052FTlRF6QMn0XKVU09F9LSlsBIiwyzAXLiGUOm49digqVhXRCTcZCK3a';
        $user->save();

        $user->assignRole('Maintainer');
    }
}
