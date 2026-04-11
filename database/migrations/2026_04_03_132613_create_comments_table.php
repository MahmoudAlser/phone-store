<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('com_id');
            $table->string('com_content');
            $table->bigInteger("com_user")->unsigned();
            $table->bigInteger("com_post")->unsigned();
            $table->foreign('com_user')->references('id')->on('users')->onDelete("cascade");
            $table->foreign('com_post')->references('post_id')->on('posts')->onDelete("cascade");
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
        Schema::dropIfExists('comments');
    }
}
