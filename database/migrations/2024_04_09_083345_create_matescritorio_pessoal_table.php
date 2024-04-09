<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatescritorioPessoalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matescritorio_pessoal', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pessoal_id')->unsigned();
            $table->bigInteger('material_id')->unsigned();
            $table->string('estado')->nullable();
            $table->foreign('pessoal_id')->references('id')->on('pessoal');
            $table->foreign('material_id')->references('id')->on('materialescritorio');
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
        Schema::dropIfExists('matescritorio_pessoal');
    }
}
