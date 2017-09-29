<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->smallInteger('cid')->comment('分类ID');
            $table->smallInteger('fid')->comment('父分类ID');
            $table->integer('user_id')->comment('用户ID');
            $table->string('author', 10)->comment('作者');
            $table->string('category', 10)->comment('分类名称');
            $table->string('title', 100)->comment('文章标题');
            $table->string('thumb_img', 100)->comment('文章缩略图');
            $table->string('intro', 255)->comment('文章简介');
            $table->longText('content')->comment('文章内容');
            $table->longText('markdowm_content')->comment('markdown标签语法内容');
            $table->string('tags', 20)->comment('文章标签');
            $table->tinyInteger('status')->comment('1:草稿 2:待审核 3:审核通过')->default(1);
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
        Schema::dropIfExists('articles');
    }
}
