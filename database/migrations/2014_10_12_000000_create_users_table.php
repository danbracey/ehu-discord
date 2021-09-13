<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->string('name');
            $table->integer('discriminator')->default('0000');;
            $table->string('locale')->nullable();
            $table->text('avatar')->nullable();
            $table->mediumText('about')->nullable();
            $table->longText('UserNotes')->nullable();
            $table->bigInteger('discord_private_channel_id')->default('0');
            $table->tinyInteger('enabled')->default('1');
            $table->string('password')->nullable();
            $table->integer('theme')->default('0');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
