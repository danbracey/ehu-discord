<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StatusIncidents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_incidents', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->integer('node_id');
            $table->string('description');
            $table->date('started_on');
            $table->date('resolved_on');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('status_incidents');
    }
}
