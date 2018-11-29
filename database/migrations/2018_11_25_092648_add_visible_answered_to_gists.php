<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVisibleAnsweredToGists extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('gists',function($table){
            $table->boolean('visible')->after('author_id')->default(1);
            $table->boolean('answered')->after('visible')->default(0);
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gists',function($table){
            $table->dropColumn('answered');
            $table->dropColumn('visible');
        });
    }
}
