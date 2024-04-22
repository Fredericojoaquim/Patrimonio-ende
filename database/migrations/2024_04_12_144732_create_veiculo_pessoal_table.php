<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVeiculoPessoalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('veiculo_pessoal', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pessoal_id')->unsigned();
            $table->bigInteger('veiculo_id')->unsigned();
            $table->string('estado')->nullable();
            $table->foreign('pessoal_id')->references('id')->on('pessoal');
            $table->foreign('veiculo_id')->references('id')->on('veiculos');
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
        Schema::dropIfExists('veiculo_pessoal');
    }
}
