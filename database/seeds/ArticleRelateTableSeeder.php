<?php

use Illuminate\Database\Seeder;

class ArticleRelateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        for($i=0; $i<50; $i++){
            $data[] = [
                'aid'           =>      $i,
                'like_number'            =>      rand(10, 30),
                'store_number'               =>      rand(30, 50),
                'comment_number'           =>      rand(1, 10),
                'pv_number'              =>      rand(60, 100),
                'created_at'          =>      date('Y-m-d H:i:s', time())
            ];
        }

        DB::table('article_relate') -> insert($data);
    }
}
