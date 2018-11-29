<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('title');
            $table->text('blog');
            $table->integer('author_id')->unsigned();           
            $table->timestamps();
        });

        Schema::table('blogs', function (Blueprint $table) {           
            $table->foreign('author_id')->references('id')->on('experts')->onDelete('cascade') ;         
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
