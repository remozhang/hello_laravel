<?php

use Illuminate\Database\Seeder;
use App\Models\Reply;
use App\Models\User;
use App\Models\Topic;

class ReplysTableSeeder extends Seeder
{
    public function run()
    {
//        $replys = factory(Reply::class)->times(50)->make()->each(function ($reply, $index) {
//            if ($index == 0) {
//                // $reply->field = 'value';
//            }
//        });

//        Reply::insert($replys->toArray());

        $user_ids = User::all()->pluck('id')->toArray();

        $topic_ids = Topic::all()->pluck('id')->toArray();

        // 获取 faker 实例
        $faker = app(Faker\Generator::class);

        // 工厂模式, 生成数据
        $replys = factory(Reply::class)
                    ->times(1000)
                    ->make()
                    ->each(function ($reply, $index)
                        use ($user_ids, $topic_ids, $faker)
        {
            // 从用户 ID 数组中随机取出一个并赋值
            $reply->user_id = $faker->randomElement($user_ids);

            // 同上
            $reply->topic_id = $faker->randomElement($topic_ids);
        });

        Reply::insert($replys->toArray());
    }

}

