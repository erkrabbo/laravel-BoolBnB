<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHouseSponsorizationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('house_sponsorization', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('house_id');
            $table->unsignedBigInteger('sponsorization_id');
            $table->dateTime('created_at');
            $table->foreign('house_id')->references('id')->on('houses')->onDelete('cascade');
            
            $table->foreign('sponsorization_id')->references('id')->on('sponsorizations')->onDelete('cascade');

            // $table->primary(['house_id', 'sponsorization_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('house_sponsorization');
    }
}
