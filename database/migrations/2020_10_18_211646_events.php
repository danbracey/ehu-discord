<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Events extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('location');
            $table->string('game');
            $table->string('link');
            $table->tinyInteger('status');
            $table->longText('description');
            $table->date('date');
            $table->time('time')->nullable(); //Nullable as we can't convert timezones yet
            $table->string('timezone');
            $table->bigInteger('submitted_by_uid');
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
        Schema::dropIfExists('events');
    }
}
