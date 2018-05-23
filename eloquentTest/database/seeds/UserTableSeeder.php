<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // manual build
        for ($i = 0; $i < 50; $i++) {
            DB::table('users')->insert([
                'name' => '张雷',
                'email' => str_random('9') . '@qq.com',
                'password' => str_random('10'),
                'vote' => str_random('15')
            ]);
        }

        // build by factory
//        factory(App\User::class, 50)->create()->each(function($u) {
//            $u->post()->save(factory(App\User::class, 50)->make());
//        });
    }


}
