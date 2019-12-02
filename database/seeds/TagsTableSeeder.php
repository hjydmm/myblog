<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags') -> insert([
            'aid'       =>     '9',
            'str_tags'     =>     'Vagrant,VirtualBox,Git',
        ]);

        DB::table('tags') -> insert([
            'aid'       =>     '10',
            'str_tags'     =>     'API,GitHub,Migration,Route',
        ]);

        DB::table('tags') -> insert([
            'aid'       =>     '11',
            'str_tags'     =>     'Composer,Vagrant',
        ]);

        DB::table('tags') -> insert([
            'aid'       =>     '12',
            'str_tags'     =>     'Blade,View',
        ]);

        DB::table('tags') -> insert([
            'aid'       =>     '21',
            'str_tags'     =>     'JSON,Ajax,Path',
        ]);

        DB::table('tags') -> insert([
            'aid'       =>     '25',
            'str_tags'     =>     'Command,Vi,Vim',
        ]);

        DB::table('tags') -> insert([
            'aid'       =>     '28',
            'str_tags'     =>     'Vagrant,VirtualBox,Git',
        ]);

        DB::table('tags') -> insert([
            'aid'       =>     '29',
            'str_tags'     =>     'API,GitHub,Migration,Route',
        ]);

        DB::table('tags') -> insert([
            'aid'       =>     '30',
            'str_tags'     =>     'Vagrant,VirtualBox,Git',
        ]);

        DB::table('tags') -> insert([
            'aid'       =>     '31',
            'str_tags'     =>     'Blade,View',
        ]);

        DB::table('tags') -> insert([
            'aid'       =>     '33',
            'str_tags'     =>     '前端,Javascript,Bootstrap',
        ]);

        DB::table('tags') -> insert([
            'aid'       =>     '34',
            'str_tags'     =>     'Command,Vi,Vim',
        ]);

        DB::table('tags') -> insert([
            'aid'       =>     '35',
            'str_tags'     =>     'Vagrant,VirtualBox,Git',
        ]);

        DB::table('tags') -> insert([
            'aid'       =>     '36',
            'str_tags'     =>     'API,GitHub,Migration,Route',
        ]);

        DB::table('tags') -> insert([
            'aid'       =>     '37',
            'str_tags'     =>     'Blade,View',
        ]);

        DB::table('tags') -> insert([
            'aid'       =>     '38',
            'str_tags'     =>     'API,GitHub,Migration,Route',
        ]);
    }
}
