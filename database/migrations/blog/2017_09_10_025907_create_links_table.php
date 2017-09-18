<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('links', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('title', 10)->comment('友情连接标题');
            $table->string('url', 100)->comment('连接长度');
            $table->tinyInteger('show')->comment('1:展示 2:隐藏')->default(1);
            $table->tinyInteger('weight')->comment('权重, 倒序排列')->dafault(1);
            $table->tinyInteger('type')->comment('1:友情链接 2:技术站点')->dafault(1);
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
        Schema::dropIfExists('links');
    }
}
