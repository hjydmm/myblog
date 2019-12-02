<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auth', function (Blueprint $table) {
            $table -> increments('id');
            $table -> string('auth_name', 20) -> notNull();  //权限名称
            $table -> string('controller', 40) -> nullable();  //权限对应的控制器
            $table -> string('action', 30) -> nullable();   //权限对应的方法
            $table -> tinyInteger('pid');  //当前权限的父级id
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('auth');
    }
}
