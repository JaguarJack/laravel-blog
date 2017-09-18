<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
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
            $table->string('account', 20)->comment('账号')->default('');
            $table->string('open_id', 20)->comment('第三方open_id')->default('');
            $table->string('user_name', 15)->comment('用户名');          
            $table->string('password', 100)->comment('密码')->default('');
            $table->string('email', 100)->comment('邮箱')->default('');
            $table->string('real_name', 10)->comment('用户真实姓名')->default('');
            $table->string('remember_token')->default('');
            $table->string('avatar', 255)->comment('头像')->default('');
            $table->string('github_name', 10)->comment('github 昵称')->default('');
            $table->string('github_homepage', 100)->comment('github 主页')->default('');
            $table->string('sina_name', 10)->comment('新浪微博昵称')->default('');
            $table->string('sina_homepage', 250)->comment('新浪微博主页地址')->default('');
            $table->string('come_from', 10)->comment('用户所在城市')->default('');
            $table->string('personal_website', 10)->comment('用户个人主页')->default('');
            $table->string('introduction', 255)->comment('个人签名')->default('');
            $table->string('signature', 255)->comment('个人署名')->default('');
            $table->tinyInteger('type')->comment('1:注册用户,2:qq用户,3:微博用户,4:github,5:其他')->default(1);
            $table->tinyInteger('gender')->comment('1:男 2:女')->default(1);
            $table->tinyInteger('activation')->comment('1:激活 2:未激活')->default(2);
            $table->tinyInteger('online')->comment('1:在线  2：未在线')->default(1);
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
