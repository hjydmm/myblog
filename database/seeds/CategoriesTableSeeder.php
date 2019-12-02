<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories') -> insert([
            'aid'       =>     '9',
            'str_categories'     =>     '前端,Javascript,Bootstrap',
        ]);

        DB::table('categories') -> insert([
            'aid'       =>     '10',
            'str_categories'     =>     '后端,PHP,Laravel',
        ]);

        DB::table('categories') -> insert([
            'aid'       =>     '11',
            'str_categories'     =>     '后端,PHP,CakePHP',
        ]);

        DB::table('categories') -> insert([
            'aid'       =>     '12',
            'str_categories'     =>     '后端,Python',
        ]);

        DB::table('categories') -> insert([
            'aid'       =>     '21',
            'str_categories'     =>     '前端,Javascript,Jquery',
        ]);

        DB::table('categories') -> insert([
            'aid'       =>     '25',
            'str_categories'     =>     '数据库,Mysql',
        ]);

        DB::table('categories') -> insert([
            'aid'       =>     '28',
            'str_categories'     =>     '服务器,Apache',
        ]);

        DB::table('categories') -> insert([
            'aid'       =>     '29',
            'str_categories'     =>     '服务器,Nginx',
        ]);

        DB::table('categories') -> insert([
            'aid'       =>     '30',
            'str_categories'     =>     'Linux,CentOX',
        ]);

        DB::table('categories') -> insert([
            'aid'       =>     '31',
            'str_categories'     =>     'Linux,Ubuntu',
        ]);

        DB::table('categories') -> insert([
            'aid'       =>     '33',
            'str_categories'     =>     '前端,Javascript,Bootstrap',
        ]);

        DB::table('categories') -> insert([
            'aid'       =>     '34',
            'str_categories'     =>     '后端,PHP,Laravel',
        ]);

        DB::table('categories') -> insert([
            'aid'       =>     '35',
            'str_categories'     =>     '后端,PHP,CakePHP',
        ]);

        DB::table('categories') -> insert([
            'aid'       =>     '36',
            'str_categories'     =>     '前端,Javascript,Bootstrap',
        ]);

        DB::table('categories') -> insert([
            'aid'       =>     '37',
            'str_categories'     =>     '前端,Javascript,Bootstrap',
        ]);

        DB::table('categories') -> insert([
            'aid'       =>     '38',
            'str_categories'     =>     '前端,Javascript,Bootstrap',
        ]);
    }
}
