<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_menu', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('document_id')->comment('文档ID');
            $table->string('title', 20)->comment('菜单名称');
            $table->integer('pid')->comment('父级菜单id');
            $table->string('url')->comment('引用链接');
            $table->longText('content')->comment('文档内容');
            $table->string('type')->comment('1:生成url 2:引用链接');
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
        Schema::dropIfExists('document_menu');
    }
}
