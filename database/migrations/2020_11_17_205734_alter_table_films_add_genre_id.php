<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableFilmsAddGenreId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('films', function (Blueprint $table) {
            $table->unsignedBigInteger('genre_id')->nullable(); 
            $table->foreign('genre_id')->references('id')->on('genres'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('films', function (Blueprint $table) { //undoing the migration
            $table->dropColumn('genre_id'); 
            //didn't have a genre string col before, so not adding it here
            
        });
    }
}
