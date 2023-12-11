<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialescritorioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materialescritorio', function (Blueprint $table) {
            $table->id();
            $table->string('num_mobilizado');
            $table->string('descricao');
            $table->double('valor_aquisicao')->nullable();;
            $table->double('custo_aquisicao_usd')->nullable();;
            $table->double('custo_aquisicao_euro')->nullable();;
            $table->string('finalidade');
            $table->string('tipo_aquisicao');
            $table->date('data_aquisicao');
            $table->string('estado');
            $table->string('cor');
            $table->string('marca');
            $table->string('tipo');
            $table->bigInteger('fornecedor_id')->unsigned();
            $table->bigInteger('departamento_id')->unsigned();
            $table->foreign('departamento_id')->references('id')->on('departamentos');
            $table->foreign('fornecedor_id')->references('id')->on('fornecedor');
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
        Schema::dropIfExists('materialescritorio');
    }
}
