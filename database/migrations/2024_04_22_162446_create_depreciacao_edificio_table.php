<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepreciacaoEdificioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('depreciacao_edificio', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('edificio_id')->unsigned();
            $table->double('dp_anual')->nullable();
            $table->foreign('edificio_id')->references('id')->on('edificio');
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
        Schema::dropIfExists('depreciacao_edificio');
    }
}
