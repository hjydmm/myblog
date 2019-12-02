<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        for($i=0; $i<10; $i++){
            $data[] = [
                'username'    =>   'testname' . $i,
                'password'    =>   bcrypt('123456'), //框架内置bcrypt方法加密密码
                'gender'      =>   rand(1,3),
                'mobile'      =>   '080' . rand(1000, 9999) . rand(1000, 9999),
                'email'       =>   'hjy0000' . $i . '@gmail.com',
                'role_id'     =>   rand(1,6),
                'created_at'  =>   date('Y-m-d H:i:s', time()),
                'status'      =>   rand(1,2)
            ];
        }

        DB::table('admin') -> insert($data);

//        DB::table('admin') -> insert([
//            'username'    =>   'hjydmm',
//            'password'    =>   bcrypt('123456'), //框架内置bcrypt方法加密密码
//            'gender'      =>   '2',
//            'mobile'      =>   '08098231078',
//            'email'       =>   'hjydmm1112@gmail.com',
//            'role_id'     =>   '1',
//            'created_at'  =>   date('Y-m-d H:i:s', time()),
//            'status'      =>   '2'
//        ]);
    }
}
