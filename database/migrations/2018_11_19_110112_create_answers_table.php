<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('gist_id')->unsigned();
            $table->integer('expert_id')->unsigned();
            $table->text('answer');
            $table->timestamps();
        });

        Schema::table('answers', function (Blueprint $table) {
            $table->foreign('gist_id')->references('id')->on('gists')->onDelete('cascade');
            $table->foreign('expert_id')->references('id')->on('experts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answers');
    }
}
