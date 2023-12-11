<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbateTerrenoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abate_terreno', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('terreno_id');
            $table->bigInteger('motivoAbate_id');
            $table->date('dataAbate');
            $table->foreign('terreno_id')->references('id')->on('terrenos');
            $table->foreign('motivoAbate_id')->references('id')->on('motivos_abate');
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
        Schema::dropIfExists('abate_terreno');
    }
}
