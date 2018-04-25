<?php

use Illuminate\Database\Seeder;
use App\Article;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('articles')->delete();

        for ($i = 0; $i < 10; $i++) {
            Article::create([
                'title' => 'Title' . $i,
                'body' => 'Body' . $i,
                'user_id' => '1'
            ]);
        }
    }
}
