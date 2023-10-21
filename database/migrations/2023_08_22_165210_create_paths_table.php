<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('paths', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('departure_city');
            $table->foreign('departure_city')->references('id')->on('villes');

            $table->unsignedBigInteger('arrival_city');
            $table->foreign('arrival_city')->references('id')->on('villes');


            $table->time('time_departure');
            $table->time('duration_path');

            $table->integer('place_number_max');

            $table->float('price');

            $table->date('dateEndBooking');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paths');
    }
};
