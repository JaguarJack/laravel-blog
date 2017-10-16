<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('title', 100);
            $table->longText('subject');
            $table->integer('pv')->default(1)->comment('pv');
            $table->integer('comment_number')->default(1)->comment('评论数');
            $table->tinyInteger('status')->default(1)->comment('1:未接帖 2:结帖');
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
        Schema::dropIfExists('questions');
    }
}
