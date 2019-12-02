<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //建表
        Schema::create('admin', function (Blueprint $table) {
            $table -> increments('id');
            $table -> string('username',20) -> notNull();
            $table -> string('password') -> notNull();
            $table -> enum('gender',[1,2,3]) -> notNull()->default('1'); //1男2女3保密
            $table -> string('mobile',50);
            $table -> string('email',50);
            $table -> tinyInteger('position_id'); //角色表中的主键id
            $table -> rememberToken(); //实现记住登陆状态字段，用于存储token
            $table -> enum('status',[1,2]) -> notNull()->default('2'); //1表示禁用
            $table -> timestamps(); //created_at和updated_at时间字段（系统自己创建）
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //删表
        Schema::dropIfExists('admin');
    }
}
