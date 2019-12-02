<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        for($i=0; $i<100; $i++){
            $temp = rand(1, 50) . rand(1, 50) . rand(1, 50);
            $data[] = [
                'user_name'           =>      'laravel_test' . $i,
                'password'            =>      bcrypt('123456'),
                'email'               =>      'hjy1000' . $i . '@gmail.com',
                'real_name'           =>      'hjydmm00' . $i,
                'avatar'              =>      '/assets/images/avatars/avatar_0' . rand(1, 8) . '.jpg',
                'github_name'         =>      'hjy' . $temp,
                'github_homepage'     =>      'https://github.com/hjy' . $temp . '?tab=repositories',
                'city'                =>      'Tokyo',
                'website'             =>      'https://hjydmm' . $temp . '.com',
                'introduction'        =>      'hello, my name is laravel_test' . $i,
                'type'                =>      rand(1,5),
                'gender'              =>      rand(1,2),
                'activation'          =>      rand(1,2),
                'status'              =>      rand(1,2),
                'created_at'          =>      date('Y-m-d H:i:s', time())
            ];
        }

        DB::table('users') -> insert($data);
    }
}
