<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VtcJobs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vtc_jobs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('driver');
            $table->integer('startinglocation');
            $table->integer('endinglocation');
            $table->string('evidence');
            $table->text('comments');
            $table->integer('moneyearnt');
            $table->integer('milesdriven');
            $table->integer('damage');
            $table->integer('status');
            $table->string('declinereason');
            $table->bigInteger('staff_uid');
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
        Schema::dropIfExists('vtc_jobs');
    }
}
