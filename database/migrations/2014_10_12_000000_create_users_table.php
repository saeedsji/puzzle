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
            $table->id();
            $table->string('phone')->unique()->index();
            $table->string('name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->text('password')->nullable();
            $table->integer('type')->index();
            $table->integer('status')->index();
            $table->string('ip')->nullable();
            $table->timestamp('lastLogin')->nullable();
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
