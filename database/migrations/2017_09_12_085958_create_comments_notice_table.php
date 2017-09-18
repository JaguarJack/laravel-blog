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
        Schema::create('comments_notice', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->comment('被回复者ID');
            $table->tinyInteger('aid')->comment('文章ID');
            $table->tinyInteger('comment_id')->comment('评论ID');
            $table->tinyInteger('is_read')->comment('1:未读 2:已读');
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
