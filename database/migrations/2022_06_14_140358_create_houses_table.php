<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('houses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('Poster');
            $table->string('Title');
            $table->unsignedTinyInteger('N_of_rooms');
            $table->unsignedTinyInteger('N_of_beds');
            $table->unsignedTinyInteger('N_of_baths');
            $table->unsignedSmallInteger('Mq');
            $table->date('Available_from');
            $table->date('Available_to');
            $table->string('Address');
            $table->float('Lat', 7,4);
            $table->float('Lng', 7,4);
            $table->boolean('Visible')->default(1);
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
        Schema::dropIfExists('houses');
    }
}
