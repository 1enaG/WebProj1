<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableUserRights extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_rights', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('model', 20); // film OR actor OR genre (obj of which model it can(not) modify)
            $table->string('right', 10); 
            $table->unsignedBigInteger('user_id'); 
            $table->timestamps();

            $table->foreign('user_id')
                    ->references('id')
                    ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_rights');
    }
}
