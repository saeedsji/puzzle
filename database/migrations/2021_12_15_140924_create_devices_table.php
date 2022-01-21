<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table)
        {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->string('device_id')->index();
            $table->string('token');
            $table->string('osType')->nullable();
            $table->string('osVersion')->nullable();
            $table->string('deviceBrand')->nullable();
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
        Schema::dropIfExists('devices');
    }
}
