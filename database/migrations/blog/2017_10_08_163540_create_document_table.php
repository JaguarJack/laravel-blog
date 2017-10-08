<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->comment('发布者ID');
            $table->string('title', 100)->comment('文档标题');
            $table->string('mark', 20)->comment('文档唯一标识');
            $table->string('description')->comment('文档描述');
            $table->tinyInteger('type')->comment('1:私有 2:公开');
            $table->tinyInteger('status')->comment('1:发布 2:不发布');
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
        Schema::dropIfExists('document');
    }
}
