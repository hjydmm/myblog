<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_name', 15)->comment('用户名');          
            $table->string('password', 100)->comment('密码')->default('');
            $table->string('email', 100)->comment('邮箱')->default('');
            $table->string('real_name', 10)->comment('用户真实姓名')->default('');
            $table->string('remember_token')->default('');
            $table->char('api_token', 40)->unique()->comment('api认证token');
            $table->string('avatar', 255)->comment('头像')->default('');
            $table->string('github_name', 10)->comment('github 昵称')->default('');
            $table->string('github_homepage', 100)->comment('github 主页')->default('');
            $table->string('city', 10)->comment('用户所在城市')->default('');
            $table->string('website', 100)->comment('用户个人主页')->default('');
            $table->string('introduction', 255)->comment('个人签名')->default('');
            $table->tinyInteger('type')->comment('1:注册用户,2:github,3:其他')->default(1);
            $table->tinyInteger('gender')->comment('1:男 2:女')->default(1);
            $table->tinyInteger('activation')->comment('1:未激活 2:激活')->default(1);
            $table->tinyInteger('status')->comment('1:正常  2：删除')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
}
