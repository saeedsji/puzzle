<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertises', function (Blueprint $table)
        {
            $table->id();
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('region_id')->index();
            $table->unsignedBigInteger('category_id')->index();
            $table->string('title');
            $table->tinyInteger('status')->index();
            $table->tinyInteger('type')->index();
            $table->string('slug');
            $table->integer('view')->default(0);
            $table->timestamp('expire');
            $table->string('phone');
            $table->string('whatsapp')->nullable();
            $table->longText('description')->nullable();
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
        Schema::dropIfExists('advertises');
    }
}
