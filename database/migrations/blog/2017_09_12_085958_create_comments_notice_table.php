<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsNoticeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notice', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->comment('被回复者ID');
            $table->string('from_user_name',20)->comment('消息来源用户昵称');
            $table->tinyInteger('aid')->comment('文章ID');
            $table->tinyInteger('is_read')->comment('1:未读 2:已读')->default(1);
            $table->tinyInteger('type')->comment('1:评论消息 2:关注用户发布文章消息')->default(1);
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
        Schema::dropIfExists('comments_notice');
    }
}
