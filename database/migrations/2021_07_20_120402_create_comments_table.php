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
            $table->bigIncrements('id');
            $table->text('body');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->bigInteger('client_id')->unsigned()->nullable();
            $table->bigInteger('post_id')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')->on('id')->references('users')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('client_id')->on('id')->references('clients')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('post_id')->on('id')->references('posts')->onDelete('CASCADE')->onUpdate('CASCADE');
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
