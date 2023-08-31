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
            $table->string('departurePoint');
            $table->string('arrivalPoint');
            $table->datetime('dateTimeDeparture');
            $table->datetime('dateTimeArrival');
            $table->integer('placeNumberMax');
            $table->float('weightPackageMax');
            $table->float('price');
            $table->string('transport');
            $table->date('publishDate');
            $table->date('dateEndBooking');
            $table->foreignId('ville_id')->constrained();
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
