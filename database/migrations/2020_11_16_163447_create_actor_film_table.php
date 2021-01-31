<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActorFilmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actor_film', function (Blueprint $table) {
          //no separate id for the pairs! 
            $table->integer('actor_id')->unsigned(); 
            $table->foreign('actor_id')->references('id')->on('actors'); 

            $table->integer('film_id')->unsigned();
            $table->foreign('film_id')->references('id')->on('films'); 
            //no timestamps 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actor_film');
    }
}
