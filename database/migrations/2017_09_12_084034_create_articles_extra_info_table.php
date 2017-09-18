<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesExtraInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles_extra_info', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('aid')->comment('文章ID');
            $table->integer('user_id')->comment('用户ID');
            $table->smallInteger('like_number')->comment('点赞数')->default(0);
            $table->smallInteger('store_number')->comment('收藏数')->default(0);
            $table->smallInteger('comment_number')->comment('评论数')->default(0);
            $table->smallInteger('pv_number')->comment('阅读数')->default(0);
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
        Schema::dropIfExists('articles_extra_info');
    }
}
