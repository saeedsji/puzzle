<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table)
        {
            $table->id();
            $table->text('title');
            $table->tinyInteger('type')->index();
            $table->tinyInteger('status')->index();
            $table->bigInteger('price');
            $table->bigInteger('off')->nullable();
            $table->integer('sort')->default(1);
            $table->string('bazarId')->nullable();
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
        Schema::dropIfExists('plans');
    }
}
