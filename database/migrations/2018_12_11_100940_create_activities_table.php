<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('expert_id');
            $table->unsignedInteger('subject_id');
            $table->string('subject_type',50);
            $table->string('type',50);
            $table->timestamps();
        });

        Schema::table('activities', function (Blueprint $table) {
            $table->foreign('expert_id')->references('id')->on('experts');          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activities');
    }
}
