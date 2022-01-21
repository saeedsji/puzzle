<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table)
        {
            $table->id();
            $table->string('title')->index();
            $table->text('body');
            $table->string('type')->index();
            $table->text('link')->nullable();
            $table->unsignedBigInteger('advertise_id')->nullable();
            $table->string('screen')->nullable();
            $table->text('image')->nullable();
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
        Schema::dropIfExists('notifications');
    }
}
