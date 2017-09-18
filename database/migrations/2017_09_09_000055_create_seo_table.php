<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seo', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->smallInteger('cid')->commet('分类ID');
            $table->string('title', 100)->comment('页面标题');
            $table->string('keywords', 255)->comment('页面关键词');
            $table->string('description', 255)->comment('页面描述');
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
        Schema::dropIfExists('seo');
    }
}
