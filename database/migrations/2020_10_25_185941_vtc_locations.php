<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VtcLocations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vtc_locations', function (Blueprint $table) {
            $table->id();
            $table->string('location');
            $table->string('country');
            $table->string('game');
            $table->string('dlc');
            $table->integer('depots');
            $table->integer('hasgarage');
            $table->integer('hasservice');
            $table->integer('hasrecruitment');
            $table->integer('hasdealership');
            $table->integer('hasfuel');
            $table->integer('hasport');
            $table->integer('hashotel');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vtc_locations');
    }
}
